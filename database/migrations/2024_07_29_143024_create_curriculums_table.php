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
    public function up() {
        if (!Schema::hasTable('curriculums')) {
            Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('thumbnail')->nullable();
            $table->longText('description')->nullable();
            $table->longText('video_url');
            $table->tinyInteger('alway_delivery_flg')->nullable(false);
            $table->unsignedBigInteger('grade_id')->nullable(false);
            $table->timestamps();

            //外部キー制約
            $table->foreign('grade_id')->references('id')->on('grades');
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('curriculums');
    }
};
