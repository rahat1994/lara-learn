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
        Schema::table('courses', function (Blueprint $table) {
            $table->string('duration')->after('title')->nullable();
            $table->enum('block_content', ['after_duration', 'after_finishing', 'forever_open'])->after('duration')->default('forever_open');
            $table->boolean('allow_repurchase')->after('block_content')->default(true);
            $table->string('course_level')->after('allow_repurchase')->default('All Levels');
            $table->string('language')->after('course_level')->default('English');
            $table->integer('fake_students_enrolled')->after('language')->default(0);
            $table->integer('max_students')->after('fake_students_enrolled')->default(0);
            $table->integer('retake_course')->after('max_students')->default(0);
            $table->boolean('featured_list')->after('retake_course')->default(false);
            $table->string('featured_review')->after('featured_list')->default(null)->nullable();
            $table->string('external_link')->after('featured_review')->default(null)->nullable();
            $table->decimal('regular_price', 10, 2)->after('external_link')->default(0);
            $table->decimal('sale_price', 10, 2)->after('regular_price')->default(0);
            $table->boolean('free_course')->after('sale_price')->default(false);
            $table->text('requirements')->after('free_course')->default(null)->nullable();
            $table->text('target_audience')->after('requirements')->default(null)->nullable();
            $table->text('key_features')->after('target_audience')->default(null)->nullable();
            $table->string('evaluation')->after('key_features')->default('evaluate_via_lessons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'duration',
                'block_content',
                'allow_repurchase',
                'course_level',
                'language',
                'fake_students_enrolled',
                'max_students',
                'retake_course',
                'featured_list',
                'featured_review',
                'external_link',
                'regular_price',
                'sale_price',
                'free_course',
                'requirements',
                'target_audience',
                'key_features',
                'evaluation',
            ]);
        });
    }
};

// General Tab

// Duration

// Block Content

// When the duration expires

// After the course is finished

// Allow repurchase

// Course level

// All levels

// Beginner

// Intermediate

// Expert

// Fake students enrolled

// Max Student (Set 0 for unlimited)

// Re-take Course (Set 0 for unlimited)

// Finish Button.

// Featured List

// Featured review

// External Link

// Pricing

// Regular price

// Sale price (Schedule)

// Free Course

// Extra Information

// Requirements (Repeater List)

// Target Audience (Repeater List)

// Key Features (Repeater List)

// FAQs (Repeater 1. title 2. coontent)

// Assignment tab

// Evaluation

// Evaluate via Lessons (lessons completed)

// Evaluate via Final Quiz

// Evaluate via passed quizzes

// Evaluate via questions

// Evaluate via mark

// Author Tab.

// Author Details.
