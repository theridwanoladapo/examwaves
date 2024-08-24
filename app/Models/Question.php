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
        'question', 'question_img', 'answer_type',
        'option_a', 'option_b', 'option_c',
        'option_d', 'option_e', 'option_f', 'option_g',
        'correct_options', 'explanation', 'test_id',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }
}
