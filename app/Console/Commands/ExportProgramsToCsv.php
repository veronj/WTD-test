<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExportProgramsToCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-programs-to-csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //Retrieve all programs and export them to a csv file
        $programs = \App\Models\Program::all();
        $columns = ['id', 'external_id', 'name', 'market_status', 'city', 'address', 'zip_code', 'delivery_date', 'published_at', 'created_at', 'updated_at'];
        $file_name = 'programs.csv';
        $file_path = storage_path($file_name);
        $file = fopen($file_path, 'w');
        fputcsv($file, $columns);
        foreach ($programs as $program) {
            $row = [];
            foreach ($columns as $column) {
                $row[] = $program->$column;
            }
            fputcsv($file, $row);
        }
        fclose($file);
        $this->info('Programs exported to '.$file_path);
    }
}
