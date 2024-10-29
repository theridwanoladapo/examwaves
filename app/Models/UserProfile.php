<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'headline',
        'biography',
    ];

    public function firstname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? ucwords($value) : null,
            set: fn ($value) => $value ? strtolower($value) : null,
        );
    }

    public function lastname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? ucwords($value) : null,
            set: fn ($value) => $value ? strtolower($value) : null,
        );
    }

    public function headline(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? ucwords($value) : null,
            set: fn ($value) => $value ? strtolower($value) : null,
        );
    }

    public function biography(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? ucfirst($value) : null,
            set: fn ($value) => $value ? strtolower($value) : null,
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
