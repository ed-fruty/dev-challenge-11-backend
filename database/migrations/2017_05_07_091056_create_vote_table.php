<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('topic');
            $table->integer('number');
            $table->date('date');
            $table->integer('approved_amount');
            $table->integer('declined_amount');
            $table->integer('abstained_amount');
            $table->integer('not_voted_amount');
            $table->integer('missed_amount');
            $table->string('decision');
            $table->integer('council_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('document_id');
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
        Schema::dropIfExists('votes');
    }
}
