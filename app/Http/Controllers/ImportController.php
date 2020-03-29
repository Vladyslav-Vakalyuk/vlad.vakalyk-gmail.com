<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\XlsxImport;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ImportController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function GetFile(\Illuminate\Http\Request $request)
    {
        $request->session()->flush();

        $validatedData = $request->validate([
            'file' => 'required|mimes:xlsx|max:' . XlsxImport::getMaxSizeUpload(),
        ]);

        Excel::import(new ProductExport, $validatedData['file']->path());

        return view('welcome');
    }
}
