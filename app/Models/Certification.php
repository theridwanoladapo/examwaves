<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'code',
        'description',
        'image_path',
        'rating',
        'price',
        'exam_id',
    ];

    /**
     * Interact with the title attribute.
     *
     * return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function title(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => ucwords($value),
        );
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
