<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTickerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
			$table->string('name')->nullable();
			$table->string('typ', 120)->nullable();
			$table->dateTime('start',)->nullable();
			$table->string('ressort', 120)->nullable();
			$table->string('headline')->nullable();
			$table->text('headline')->nullable();
			$table->string('location', 120)->nullable();
			$table->text('post_ids')->nullable();
			$table->boolean('multiauthor')->nullable();
			$table->string('status', 60)->nullable();
			$table->integer('author_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickers');
    }
}
