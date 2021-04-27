<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->date('reported_at')->nullable();
            $table->string('title')->nullable();
            $table->text('detail')->nullable();
            $table->integer('hours')->nullable();
            $table->bigInteger('request_id')->nullable();
            $table->bigInteger('reporter_id')->nullable();
            $table->bigInteger('assignee_id')->nullable();
            $table->enum('priority', ['low', 'mid', 'high'])->default('low');
            $table->enum('type', ['task', 'weekend', 'offday'])->default('task');
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
        Schema::dropIfExists('tasks');
    }
}
