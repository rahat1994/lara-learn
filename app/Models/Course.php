<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model
{
    use HasFactory, Sluggable;
    protected static ?string $recordTitleAttribute = 'title';
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image',
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
        'slug',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $casts = [
        'requirements' => 'array',
        'target_audience' => 'array',
        'key_features' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
