<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentListTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachment_list_to_dos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('list_to_do_id')->unsigned();
            $table->foreign('list_to_do_id')->references('id')->on('list_to_dos');
            $table->string('lampiran');
            $table->string('nama_asli_lampiran');
            $table->dateTime('waktu_pembuatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachment_list_to_dos');
    }
}
