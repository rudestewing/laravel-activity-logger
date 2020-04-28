<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogsTable extends Migration
{
    public function up()
    {
        Schema::create('activity_logs', function(Blueprint $table) {
            $table->string('id')->primary();
            $table->string('action')->nullable();
            $table->text('description')->nullable();
            $table->string('subjectable_id')->nullable();
            $table->string('subjectable_type')->nullable();
            $table->string('causerable_id')->nullable();
            $table->string('causerable_type')->nullable();
            $table->text('before')->nullable();
            $table->text('after')->nullable();
            $table->text('properties')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('activity_logs');
    }

}