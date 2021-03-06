<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['order', 'text', 'correct_answer', 'published_at'];


    // Get the question that this belongs to
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
