<?php

namespace Tests\Feature\Voedselpakket;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class VoedselpakketOverzichtTest extends TestCase
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

        $hasProc = DB::select("SHOW PROCEDURE STATUS WHERE Db = DATABASE() AND Name = 'SP_Voedselpakket_GezinnenOverzicht'");
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

    public function test_vrijwilliger_can_view_gezinnen_overzicht(): void
    {
        $this->requireMySqlWithVoedselpakketSps();
        $this->actingAsVrijwilligerFromScript();

        $response = $this->get(route('voedselpakketten.gezinnen.index'));

        $response->assertOk();
        $response->assertSee('Overzicht gezinnen met voedselpakketten');
        $response->assertSee('ZevenhuizenGezin');
        $response->assertSee('BergkampGezin');
    }

    public function test_filter_op_geen_varken_toont_melding_als_geen_gezinnen_bestaan(): void
    {
        $this->requireMySqlWithVoedselpakketSps();
        $this->actingAsVrijwilligerFromScript();

        $response = $this->get(route('voedselpakketten.gezinnen.index', ['eetwensId' => 1]));

        $response->assertOk();
        $response->assertSee('Er zijn geen gezinnen bekent die de geselecteerde eetwens hebben');
    }
}

