<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
			$table->integer('ticker_id')->nullable();
			$table->string('headline')->nullable();
			$table->text('content')->nullable();
			$table->string('type', 120)->nullable();
			$table->integer('author_id')->nullable();
			$table->date('date')->nullable();
			$table->string('time', 120)->nullable();
			$table->index('ticker_id');
			//$table->foreign('ticker_id')->references('id')->on('tickers')->onDelete('cascade');
			//$table->foreign('author')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
