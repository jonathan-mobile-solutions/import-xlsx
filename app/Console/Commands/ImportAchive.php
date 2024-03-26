<?php

namespace App\Console\Commands;

use App\Http\Controllers\PlacaOcorrenciaController;
use App\Imports\OccurrencePlateImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportAchive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-archive';

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
        $storagePath = storage_path();

        $occurrencesPath = $storagePath . '/app/public/ocorrencias/';

        if (is_dir($occurrencesPath)) {
            $directories = array_diff(scandir($occurrencesPath), array('..', '.'));

            $folders = array_filter($directories, function ($item) use ($occurrencesPath) {
                return is_dir($occurrencesPath . '/' . $item);
            });

            $folders = array_values($folders);

            foreach ($folders as $folder) {
                $folderPath = $occurrencesPath . $folder;

                if (is_dir($folderPath)) {
                    $files = array_diff(scandir($folderPath), array('..', '.'));

                    if (count($files) > 0) {
                        echo "Arquivos em $folder: \n";

                        foreach ($files as $file) {
                            try {
                                $filePath = $folderPath . '/' . $file;

                                if (is_file($filePath)) {
                                    $fileName = $file;
                                    $occurrenceType = strtoupper($folder);

                                    Excel::import(new OccurrencePlateImport($fileName, $occurrenceType), $filePath);

                                    // $data = Excel::toArray([], $filePath);

                                    // $controller = new PlacaOcorrenciaController();

                                    // $archiveName = $file;

                                    // $occurrenceType = strtoupper($folder);

                                    // $controller->create($archiveName, $occurrenceType, $data);
                                }
                            } catch (\Exception $e) {
                                //throw $th;
                                echo 'Deu erro -> ' . $e->getMessage();
                            }
                        }
                    } else {
                        echo "Não há arquivos na pasta $folder.\n";
                    }
                } else {
                    echo "O caminho $folderPath não é um diretório válido.\n";
                }
            }
        } else {
            echo "O diretório $occurrencesPath não existe.";
        }
    }
}
