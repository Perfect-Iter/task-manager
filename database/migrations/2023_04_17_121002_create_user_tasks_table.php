<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->bigIncrements('user_task_id');
            $table->string('user_id');
            $table->bigInteger('task_id')->unsigned()->index();

            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();

            $table->text('remarks')->nullable();

            $table->foreign('task_id')
            ->references('task_id')
            ->on('tasks');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tasks');
    }
};
