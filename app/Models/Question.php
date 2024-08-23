<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'question_img', 'type',
        'option_0', 'option_1', 'option_2',
        'option_3', 'option_4', 'option_5', 'option_6',
        'correct_ans', 'explanation', 'test_id',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
