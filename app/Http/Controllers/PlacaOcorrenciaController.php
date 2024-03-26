<?php

namespace App\Http\Controllers;

use App\Models\PlacaOcorrencia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlacaOcorrenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('import');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $archiveName, string $occurrenceType, array $data)
    {
        //
        $arrayData = $data[0];

        for ($i = 0; $i < count($arrayData); $i++) {
            # code...

            $archive    = null;
            $occurrence = $occurrenceType;
            $plate      = null;
            $city       = null;
            $state      = null;
            $date       = null;

            for ($index = 0; $index < count($arrayData[$i]); $index++) {
                # code...
                $value = $arrayData[$i][$index];

                $cleanedValue = preg_replace('/[^a-zA-Z0-9]/', '', $value);

                echo $cleanedValue . "\n";

                $letters = str_split($cleanedValue);

                $firstLetter = $letters[0];

                if (count($letters) == 2) {
                    if (!is_numeric($firstLetter)) {
                        $state = $cleanedValue;
                        continue;
                    }
                }

                if (count($letters) == 7) {
                    if (!is_numeric($firstLetter)) {
                        $plate = $cleanedValue;
                        continue;
                    }
                }

                if (count($letters) >= 7 && count($letters) <= 8) {
                    $isString = false;

                    for ($index = 0; $index < count($letters); $index++) {
                        # code...
                        if (!is_numeric($letters[$index])) {
                            $isString = true;
                            break;
                        }
                    }

                    if ($isString == false) {
                        // // $formatedDate = Carbon::createFromFormat('d/m/Y', $value);

                        // $data_formatada = Carbon::createFromFormat('dmY', $value)->format('d-m-y');

                        // $date = $data_formatada;

                        // echo $date;

                        // continue;
                    }
                }
            }

            echo "\n";

            // 7 caracteres + (3 primeiros te de ser não numeros)
            // 10 caracteres + 2 barras (data)
            // 2 carateres é estado
            // cidade
            // nome do arquivo
            // ocorrencia (split “_”) pega o indice zero da strin (nome do arquivo)

            // $model = PlacaOcorrencia::firstOrCreate([
            //     'arquivo'    => $archiveName,
            //     'ocorrencia' => $occurrence,
            //     'placa'      => $plate,
            //     'cidade'     => $city,
            //     'estado'     => $state,
            //     'data'       => $date,
            // ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(array $data)
    {
        // if ($request->hasFile('xlsx_file')) {
        //     $file = $request->file('xlsx_file');

        //     $data = Excel::toArray([], $file);

        //     // $json = response()->json(['data' => $data, 'message' => 'A requisição chegou no controller.']);

        //     // $json = json_encode($data);

        //     $json = json_encode($data, JSON_PRETTY_PRINT);

        //     return redirect()->route('config')->with('data', $json);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(PlacaOcorrencia $placaOcorrencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlacaOcorrencia $placaOcorrencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlacaOcorrencia $placaOcorrencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlacaOcorrencia $placaOcorrencia)
    {
        //
    }
}
