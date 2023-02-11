<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function(Blueprint $table)
        {
            $table->bigInteger('id', true)->unsigned();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->string('type')->nullable();
            $table->string('panel')->index()->nullable();
            $table->string('section')->index()->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings');
    }

}