<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetPostgresSequences extends Command
{
    protected $signature = 'db:reset-pg-sequences';
    protected $description = 'Reset PostgreSQL sequences to the current maximum ID of each table';

    public function handle()
    {
        if (config('database.default') !== 'pgsql') {
            $this->error('This command only supports PostgreSQL.');
            return;
        }

        $tables = DB::select("
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_schema = 'public' 
            AND table_type = 'BASE TABLE'
        ");

        foreach ($tables as $table) {
            $tableName = $table->table_name;
            
            // Check if the table has an 'id' column and a sequence
            $hasId = DB::select("
                SELECT column_name 
                FROM information_schema.columns 
                WHERE table_name = ? AND column_name = 'id'
            ", [$tableName]);

            if (!$hasId) {
                continue;
            }

            $this->info("Resetting sequence for: $tableName");

            try {
                DB::statement("
                    SELECT setval(
                        pg_get_serial_sequence('$tableName', 'id'), 
                        COALESCE(MAX(id), 1), 
                        MAX(id) IS NOT NULL
                    ) FROM $tableName
                ");
            } catch (\Exception $e) {
                $this->warn("Could not reset sequence for $tableName: " . $e->getMessage());
            }
        }

        $this->info('PostgreSQL sequences reset successfully!');
    }
}
