<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LoadSqlFixtures extends Command
{
    protected $signature = 'db:load-fixtures
        {--file= : Relative path to SQL file, default database/createscript/script.sql}
        {--force : Skip the confirmation prompt}';
    protected $description = 'Reset and seed the database from a raw SQL script, then recreate stored procedures';

    public function handle(): int
    {
        $file = $this->option('file') ?: 'database/createscript/script.sql';
        $path = base_path($file);

        if (!file_exists($path)) {
            $this->error("SQL file not found: {$path}");
            return self::FAILURE;
        }

        $this->warn('This will DROP and recreate tables from the SQL script.');
        if (!$this->option('force') && !$this->confirm('Proceed?', true)) {
            return self::INVALID;
        }

        $sql = file_get_contents($path);
        // Remove USE statements to rely on current connection's database
        $sql = preg_replace('/^\s*USE\s+`?[^`;]+`?;\s*$/mi', '', $sql);

        $this->info("Loading fixtures from {$file} ...");
        try {
            DB::unprepared($sql);
        } catch (\Throwable $e) {
            $this->error('Error executing SQL: ' . $e->getMessage());
            return self::FAILURE;
        }

        $this->info('Recreating stored procedures...');
        try {
            // Reuse the existing command to process SP files
            $this->call('db:run-sps');
        } catch (\Throwable $e) {
            $this->warn('Stored procedures step produced warnings: ' . $e->getMessage());
        }

        $this->info('Verifying key table counts:');
        $this->line('Categorie: ' . (DB::table('Categorie')->count() ?? 0));
        $this->line('Leverancier: ' . (DB::table('Leverancier')->count() ?? 0));
        $this->line('Product: ' . (DB::table('Product')->count() ?? 0));

        $this->info('Done.');
        return self::SUCCESS;
    }
}
