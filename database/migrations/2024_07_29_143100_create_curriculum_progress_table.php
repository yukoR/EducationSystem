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
        if (!Schema::hasTable('curriculum_progress')) {
            Schema::create('curriculum_progress', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable(false);
                $table->unsignedBigInteger('curriculums_id')->nullable(false);
                $table->tinyInteger('clear_flg')->default(0)->nullable(false);
                $table->timestamps();
    
                //外部キー制約
                $table->foreign('curriculums_id')->references('id')->on('curriculums')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('curriculum_progress', function (Blueprint $table) {
            $table->dropForeign(['curriculums_id']);
            $table->dropForeign(['users_id']);
        });
        Schema::dropIfExists('curriculum_progress');
    }
};
