<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id')->unsigned()->references('id')->inTable('vendors');
            $table->integer('category_id')->unsigned()->references('id')->inTable('book_categories');
            $table->integer('material_id')->unsigned()->references('id')->inTable('book_materials');
            $table->string('book_name');
            $table->string('book_price');
            $table->string('book_rent');
            $table->longText('book_desc');
            $table->string('book_author');
            $table->string('book_pdf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
