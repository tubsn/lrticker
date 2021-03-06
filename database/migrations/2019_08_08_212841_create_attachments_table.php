<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->timestamps();
			$table->string('name')->nullable();
	        $table->string('filename')->nullable();
	        $table->string('extension', 60)->nullable();
			$table->string('type', 120)->nullable();
	        $table->string('size', 60)->nullable();
	        $table->string('url');
			$table->string('thumb');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
