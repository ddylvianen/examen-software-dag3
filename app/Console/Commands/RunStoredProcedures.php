<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RunStoredProcedures extends Command
{
    protected $signature = 'db:run-sps';
    protected $description = 'Run all stored procedures';

    public function handle()
    {
        $basePath = database_path('storedprocedures');

        $sps = [
            // Leveranciers
            'leveranciers/SP_GetAllLeverancierTypes.sql',
            'leveranciers/SP_Getleveranciers.sql',
            'leveranciers/SP_Getleverancierbyid.sql',
            'leveranciers/SP_GetProductById.sql',
            'leveranciers/SP_GetProductPerLeverancierById.sql',
            'leveranciers/SP_Updateproduct.sql',

            // Voedselpakketten
            'voedselpakket/SP_Voedselpakket_Eetwens_SelectAll.sql',
            'voedselpakket/SP_Voedselpakket_GetForEdit.sql',
            'voedselpakket/SP_Voedselpakket_GezinDetail.sql',
            'voedselpakket/SP_Voedselpakket_GezinnenOverzicht_FilterEetwens.sql',
            'voedselpakket/SP_Voedselpakket_GezinnenOverzicht.sql',
            'voedselpakket/SP_Voedselpakket_PakkettenPerGezin.sql',
            'voedselpakket/SP_Voedselpakket_UpdateStatus.sql',

            // Voorraad
            'voorraad/SP_GetAllCategorieen.sql',
            'voorraad/SP_GetAllMagazijnen.sql',
            'voorraad/SP_GetAllProducten.sql',
            'voorraad/SP_GetProductenPerCategorie.sql',
            'voorraad/SP_GetProductInfoById.sql',
            'voorraad/SP_UpdateVoorraad.sql',
        ];

        $this->info('Creating stored procedures...\n');

        foreach ($sps as $sp) {
            $path = $basePath . '/' . $sp;
            if (file_exists($path)) {
                $sql = file_get_contents($path);
                $this->line("Creating: <fg=blue>$sp</>");
                try {
                    // Split SQL by DELIMITER to handle multiple statements
                    $statements = $this->parseSQLStatements($sql);
                    foreach ($statements as $statement) {
                        if (trim($statement)) {
                            DB::statement($statement);
                        }
                    }
                    $this->line("<fg=green>✓ Created</>\n");
                } catch (\Exception $e) {
                    $this->line("<fg=red>✗ Error: " . substr($e->getMessage(), 0, 100) . "</>\n");
                }
            } else {
                $this->line("<fg=yellow>✗ File not found: $path</>\n");
            }
        }

        $this->info('Testing stored procedures...\n');

        try {
            $types = DB::select('CALL SP_GetAllLeverancierTypes()');
            $this->line("<fg=green>✓ SP_GetAllLeverancierTypes</> - Found " . count($types) . " types");
        } catch (\Exception $e) {
            $this->line("<fg=red>✗ Error: " . substr($e->getMessage(), 0, 80) . "</>");
        }

        try {
            $leveranciers = DB::select('CALL SP_Getleveranciers(?)', ['']);
            $this->line("<fg=green>✓ SP_Getleveranciers</> - Found " . count($leveranciers) . " leveranciers");
        } catch (\Exception $e) {
            $this->line("<fg=red>✗ Error: " . substr($e->getMessage(), 0, 80) . "</>");
        }

        try {
            $product = DB::select('CALL SP_GetProductById(?)', [1]);
            $this->line("<fg=green>✓ SP_GetProductById</> - Found " . count($product) . " product(s)");
        } catch (\Exception $e) {
            $this->line("<fg=red>✗ Error: " . substr($e->getMessage(), 0, 80) . "</>");
        }

        try {
            $products = DB::select('CALL SP_GetProductPerLeverancierById(?)', [1]);
            $this->line("<fg=green>✓ SP_GetProductPerLeverancierById</> - Found " . count($products) . " product(s)");
        } catch (\Exception $e) {
            $this->line("<fg=red>✗ Error: " . substr($e->getMessage(), 0, 80) . "</>");
        }

        try {
            $categorieen = DB::select('CALL SP_GetAllCategorieen()');
            $this->line("<fg=green>✓ SP_GetAllCategorieen</> - Found " . count($categorieen) . " categorieen");
        } catch (\Exception $e) {
            $this->line("<fg=yellow>⚠ Warning: " . substr($e->getMessage(), 0, 60) . "</>");
        }

        try {
            $magazijnen = DB::select('CALL SP_GetAllMagazijnen()');
            $this->line("<fg=green>✓ SP_GetAllMagazijnen</> - Found " . count($magazijnen) . " magazijnen");
        } catch (\Exception $e) {
            $this->line("<fg=yellow>⚠ Warning: " . substr($e->getMessage(), 0, 60) . "</>");
        }

        try {
            $producten = DB::select('CALL SP_GetAllProducten()');
            $this->line("<fg=green>✓ SP_GetAllProducten</> - Found " . count($producten) . " producten");
        } catch (\Exception $e) {
            $this->line("<fg=yellow>⚠ Warning: " . substr($e->getMessage(), 0, 60) . "</>");
        }

        $this->info('\n✓ All stored procedures executed successfully!');
    }

    private function parseSQLStatements($sql)
    {
        $statements = [];
        $current = '';
        $lines = explode("\n", $sql);

        foreach ($lines as $line) {
            // Skip USE statements and comments
            if (strpos(trim($line), 'USE ') === 0 || trim($line) === '' || strpos(trim($line), '--') === 0) {
                continue;
            }

            $current .= $line . "\n";

            // Check for DELIMITER $$
            if (strpos($line, 'DELIMITER $$') !== false) {
                continue;
            }

            // End of procedure definition
            if (trim($line) === 'DELIMITER ;') {
                if (trim($current)) {
                    $statements[] = str_replace(['DELIMITER $$', 'DELIMITER ;'], '', $current);
                    $current = '';
                }
            }
        }

        return $statements;
    }
}
