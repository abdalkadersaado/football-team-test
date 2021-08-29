<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team1_id')->nullable();
            $table->foreign('team1_id')->references('id')->on('teams')->onDelete('cascade');
            $table->unsignedBigInteger('team2_id')->nullable();
            $table->foreign('team2_id')->references('id')->on('teams')->onDelete('cascade');
            $table->string('start_time')->nullable();
            $table->integer('result1')->nullable();
            $table->integer('result2')->nullable();
            $table->string('type_match')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->index(['deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
