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
            $table->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $table->bigInteger('book_cat')->unsigned();
            $table->foreign('book_cat')->references('id')->on('book_categories')->onDelete('cascade');
            $table->bigInteger('book_material_type')->unsigned();
            $table->foreign('book_material_type')->references('id')->on('book_materials')->onDelete('cascade');
            $table->bigInteger('book_country')->unsigned();
            $table->foreign('book_country')->references('id')->on('countries')->onDelete('cascade');
            $table->string('book_name');
            $table->boolean('is_admin')->default(false);
            $table->string('book_paid_free');
            $table->string('book_price');
            $table->string('book_tag');
            $table->longText('book_desc');
            $table->string('book_author');
            $table->string('book_cover_type');
            $table->string('book_material_pdf')->nullable();
            $table->string('citation')->nullable();
            $table->string('book_material_video')->nullable();
            $table->string('book_cover')->nullable();
            $table->string('video_cover')->nullable();
            $table->string('book_year');
            $table->integer('rating')->nullable();
            $table->string('sold')->nullable();
            $table->string('rent')->nullable();
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
