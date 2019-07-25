<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_items', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('number')->nullable();
            $table->integer('order')->nullable();
            $table->text('name')->nullable();
            $table->boolean('public')->default(0);
            $table->text('result')->nullable();
            $table->text('resolution_text')->nullable();

            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();

            $table->string('meeting_id')->nullable();
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
        Schema::dropIfExists('agenda_items');
    }
}
