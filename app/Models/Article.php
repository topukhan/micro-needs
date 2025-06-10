<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'is_published',
        'published_at',
        'user_id',
        'category_id',
        'view_count',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'view_count' => 'integer',
    ];

    protected $attributes = [
        'is_published' => false,
        'view_count' => 0,
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'featured_image',
        'reading_time',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->slug = Str::slug($article->title);
        });
    }

    public function setFeaturedImageAttribute($file)
    {
        if (is_string($file)) {
            $this->attributes['featured_image'] = $file;
        } elseif ($file instanceof \Illuminate\Http\UploadedFile) {
            $this->addMedia($file)->toMediaCollection('image');
            $this->attributes['featured_image'] = $file->hashName();
        }
    }

    public function getFeaturedImageAttribute($file)
    {
        return $this->getFirstMediaUrl('image') ?: $file;
    }

    public function calculateReadingTime($wordsPerMinute = 200)
    {
        $wordCount = str_word_count(strip_tags($this->content ?? ''));
        $readingTime = ceil($wordCount / $wordsPerMinute);

        return $readingTime;
    }

    public function getReadingTimeAttribute()
    {
        return $this->calculateReadingTime();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
