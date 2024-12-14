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
            $table->string('status', 20)->default('pending');
            $table->unsignedBigInteger('leader_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
