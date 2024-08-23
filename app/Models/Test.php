<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'time_limit',
        'certification_id',
    ];

    public function certification()
    {
        return $this->belongsTo(Certification::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
