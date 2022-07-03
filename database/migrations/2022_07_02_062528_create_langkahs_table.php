<?php

use App\Models\ResepModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLangkahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('langkah', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->unsignedBigInteger('resep_id');
            $table->foreign('resep_id')->references('id')->on('resep')->onUpdate('cascade')
            ->onDelete('cascade');
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
        Schema::dropIfExists('langkah');
    }
}
