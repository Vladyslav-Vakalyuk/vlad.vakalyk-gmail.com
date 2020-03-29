<?php

namespace App\Exports;

use App\XlsxImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Facades\Validator;

class ProductExport implements ToModel, WithHeadingRow
{
    use Importable;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return XlsxImport::all();
    }

    public function model(array $row)
    {
        set_time_limit(10);

        HeadingRowFormatter::default('none');

        $row = array_values($row);

        $data = [
            'heading_category' => $row[0],
            'heading' => $row[1],
            'product_category' => $row[2],
            'manufacturer' => $row[3],
            'name' => $row[4],
            'model_code' => $row[5],
            'product_description' => $row[6],
            'price' => $row[7],
            'warranty' => $row[8],
            'availability' => $row[9],
        ];

        $valid = Validator::make($data, [
            'heading_category' => 'max:255|nullable',
            'heading' => 'max:255|nullable',
            'product_category' => 'max:255|nullable',
            'manufacturer' => 'max:255|nullable',
            'name' => 'string|max:255|unique:xlsx_import',
            'model_code' => 'max:255|nullable',
            'product_description' => 'nullable',
            'price' => 'integer|nullable',
            'warranty' => 'max:255|nullable',
            'availability' => 'max:255|nullable',
        ]);

        if ($valid->fails()) {
            session(['fail_export[fail_count]' => (session('fail_export[fail_count]', 0) + 1)]);
            session(['fail_export[fail_message]' => array_merge(session('fail_export[fail_message]', []), $valid->getMessageBag()->messages())]);
            return null;
        }

        session(['success_export[success_count]' => (session('success_export[success_count]', 0) + 1)]);
        return new XlsxImport(
            $valid->getData()
        );

    }

    public function batchSize(): int
    {
        return 2500;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

}
