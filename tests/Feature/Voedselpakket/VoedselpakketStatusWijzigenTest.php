<?php

namespace Tests\Feature\Voedselpakket;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class VoedselpakketStatusWijzigenTest extends TestCase
{
    private function requireMySqlWithVoedselpakketSps(): void
    {
        if (config('database.default') !== 'mysql') {
            $this->markTestSkipped('MySQL is required for stored procedure tests.');
        }

        try {
            DB::select('SELECT 1');
        } catch (\Throwable $e) {
            $this->markTestSkipped('Database connection not available.');
        }

        $hasTable = DB::select("SHOW TABLES LIKE 'Voedselpakket'");
        if (count($hasTable) === 0) {
            $this->markTestSkipped("Required table 'Voedselpakket' not found. Run script.sql first.");
        }

        $hasProc = DB::select("SHOW PROCEDURE STATUS WHERE Db = DATABASE() AND Name = 'SP_Voedselpakket_UpdateStatus'");
        if (count($hasProc) === 0) {
            $this->markTestSkipped("Stored procedures not installed. Run database/storedprocedures/voedselpakket/*.sql.");
        }
    }

    private function actingAsVrijwilligerFromScript(): User
    {
        $user = User::where('email', 'herman@maaskantje.nl')->first();
        if (! $user) {
            $this->markTestSkipped('Vrijwilliger user (herman@maaskantje.nl) not found. Ensure script.sql testdata is loaded.');
        }

        $this->actingAs($user);

        return $user;
    }

    public function test_status_kan_worden_gewijzigd_en_datum_uitgifte_wordt_vandaag(): void
    {
        $this->requireMySqlWithVoedselpakketSps();
        $this->actingAsVrijwilligerFromScript();

        $voedselpakketId = 6; // BergkampGezin, pakketnummer 6 (script.sql)

        $response = $this->patch(route('voedselpakketten.pakketten.update', ['voedselpakketId' => $voedselpakketId]), [
            'status' => 'Uitgereikt',
        ]);

        $response->assertRedirect(route('voedselpakketten.pakketten.edit', ['voedselpakketId' => $voedselpakketId]));

        $row = DB::select('SELECT Status, DatumUitgifte FROM Voedselpakket WHERE Id = ?', [$voedselpakketId])[0] ?? null;
        $this->assertNotNull($row);
        $this->assertSame('Uitgereikt', $row->Status);

        $this->assertNotNull($row->DatumUitgifte);
        $this->assertSame(Carbon::today()->format('Y-m-d'), Carbon::parse($row->DatumUitgifte)->format('Y-m-d'));
    }

    public function test_status_kan_niet_worden_gewijzigd_bij_niet_meer_ingeschreven(): void
    {
        $this->requireMySqlWithVoedselpakketSps();
        $this->actingAsVrijwilligerFromScript();

        $voedselpakketId = 3; // ZevenhuizenGezin, pakketnummer 3 (NietMeerIngeschreven)

        $response = $this->get(route('voedselpakketten.pakketten.edit', ['voedselpakketId' => $voedselpakketId]));
        $response->assertOk();
        $response->assertSee('Dit gezin is niet meer ingeschreven bij de voedselbank en daarom kan er geen voedselpakket worden uitgereikt');

        $rowBefore = DB::select('SELECT Status, DatumUitgifte FROM Voedselpakket WHERE Id = ?', [$voedselpakketId])[0] ?? null;
        $this->assertNotNull($rowBefore);

        $response2 = $this->patch(route('voedselpakketten.pakketten.update', ['voedselpakketId' => $voedselpakketId]), [
            'status' => 'Uitgereikt',
        ]);
        $response2->assertRedirect(route('voedselpakketten.pakketten.edit', ['voedselpakketId' => $voedselpakketId]));

        $rowAfter = DB::select('SELECT Status, DatumUitgifte FROM Voedselpakket WHERE Id = ?', [$voedselpakketId])[0] ?? null;
        $this->assertNotNull($rowAfter);
        $this->assertSame($rowBefore->Status, $rowAfter->Status);
        $this->assertSame($rowBefore->DatumUitgifte, $rowAfter->DatumUitgifte);
    }
}

