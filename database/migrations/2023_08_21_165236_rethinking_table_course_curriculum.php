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

        Schema::table('course_curriculum', function (Blueprint $table) {
            $table->foreignId('curriculum_id')->after('course_id')->references('id')->on('curriculums')->cascadeOnDelete();
            $table->dropColumn('module_id', 'order', 'type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_curriculum', function (Blueprint $table) {
            $table->dropForeign(['curriculum_id']);
            $table->foreignId('module_id')->cascadeOnDelete()->comment('this will be lesson or quiz id');
            $table->integer('order')->default(0);
            $table->enum('type', ['lesson', 'quiz'])->default('lesson');
        });
    }
};
