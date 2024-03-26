<?php

namespace App\Imports;

use App\Models\PlacaOcorrencia;
use Maatwebsite\Excel\Concerns\ToModel;

class OccurrencePlateImport implements ToModel
{
    protected $fileName;
    protected $occurrence;

    public function __construct($fileName, $occurrence)
    {
        $this->fileName = $fileName;
        $this->occurrence = $occurrence;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $plate = null;
        $city = null;
        $state = null;
        $date = null;

        foreach ($row as $value) {
            $letters = str_split($value);

            if (count($letters) == 7) {
                if (!is_numeric($letters[0])) {
                    $plate = $value;
                    continue;
                }
            }

            if (count($letters) == 2) {
                if (!is_numeric($letters[0])) {
                    $state = $value;
                    continue;
                }
            }

            if (str_contains($value, '/')) {
                $date = $value;
                continue;
            }
        }

        if (empty($plate)) {
            return null;
        }

        // return new PlacaOcorrencia([
        //     'arquivo'    => $this->fileName,
        //     'ocorrencia' => $this->occurrence,
        //     'placa'      => $plate,
        //     'cidade'     => $row[1],
        //     'estado'     => $state,
        //     'data'       => $date,
        // ]);

        return PlacaOcorrencia::firstOrCreate([
            'arquivo'    => $this->fileName,
            'ocorrencia' => $this->occurrence,
            'placa'      => $plate,
            'cidade'     => $city,
            'estado'     => $state,
            'data'       => $date,
        ]);
    }
}
