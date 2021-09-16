<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QueueExportFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_export_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('processed_date');
            $table->string('file_url');
            $table->tinyInteger('status')->default(0);
            $table->string('csvlint_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queue_export_files');
    }
}
