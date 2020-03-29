<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXlsxImportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xlsx_import', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('heading_category')->nullable();
            $table->string('heading')->nullable();
            $table->string('product_category')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('name');
            $table->string('model_code')->nullable();
            $table->text('product_description')->nullable();
            $table->integer('price')->nullable();
            $table->string('warranty')->nullable();
            $table->string('availability')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('xlsx_import');
    }
}
