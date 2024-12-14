<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('phone', 15);
            $table->unsignedBigInteger('team_id')->nullable();
            $table->boolean('is_leader')->default(false);
        
            // Add foreign key later
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
