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
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('task_id');
            $table->string('task_name');
            $table->string('description');
            $table->dateTime('due_date');
            $table->bigInteger('status_id')->unsigned()->index();

            $table->foreign('status_id')
            ->references('status_id')
            ->on('task_statuses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
