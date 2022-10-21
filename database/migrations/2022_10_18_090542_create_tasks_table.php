<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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

            $table->string("title")->nullable();
            $table->text("description");
            // $table->date("date_debut")->nullable();
            // $table->date("date_fin")->nullable();
            // $table->date("time_minute")->nullable();
            
            $table->unsignedBigInteger("parent_id")->nullable();

            $table->unsignedBigInteger("task_type_id")->nullable();
            $table->foreign("task_type_id")->references("id")->on("task_types");

            $table->unsignedBigInteger("task_status_id")->nullable();
            $table->foreign("task_status_id")->references("id")->on("task_statuses");

            
            $table->unsignedBigInteger("user_id")->nullable();
            $table->foreign("user_id")->references("id")->on("users");
            
            
            $table->timestamps();
            $table->softDeletes();
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
};
