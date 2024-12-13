<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('team_name', 100);
            $table->string('team_id', 50)->unique();
            $table->unsignedBigInteger('leader_id')->nullable();
            $table->timestamps();

            $table->foreign('leader_id')->references('id')->on('participants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
