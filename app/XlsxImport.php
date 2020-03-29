<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XlsxImport extends Model
{

    protected $table = 'xlsx_import';

    protected $fillable = ['heading_category', 'heading', 'product_category', 'manufacturer', 'name', 'model_code', 'product_description', 'price', 'warranty', 'availability'];

    public static function getMaxSizeUpload()
    {
        return (int)ini_get("upload_max_filesize") * 1024;
    }
}
