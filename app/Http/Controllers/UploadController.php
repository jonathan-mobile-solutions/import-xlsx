<?php

namespace App\Http\Controllers;

use App\Imports\LeilaoImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// use Maatwebsite\Excel\Excel;

class UploadController extends Controller
{
    //
    public function uploadArchive(Request $request)
    {
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');

            if ($file->getError() > 0) {
                return response()->json(['data' => [], 'message' => 'Upload Error.']);
            } else {
                $extension = $file->getClientOriginalExtension();

                if ($extension != 'xlsx') {
                    return response()->json(['data' => [], 'message' => 'O arquivo deve ser do tipo XLSX.']);
                }

                try {
                    //code...
                    $data = Excel::import(new LeilaoImport, $file);

                    // $data = Excel::toArray([], $file);

                    return response()->json(['data' =>  $data, 'message' => 'O arquivo foi lido com sucesso.']);
                } catch (\Exception $e) {
                    return response()->json(['data' => [], 'message' => $e->getMessage()]);
                }
            }
        }

        return response()->json(['data' => [], 'message' => 'No has file']);
    }
}
