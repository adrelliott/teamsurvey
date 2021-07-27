<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Section;
use App\Models\Answer;

class Question extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['question', 'description', 'type', 'correct_answer', 'published_at'];


    // Get the answers that this belongs to
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Get the response that this belongs to
    public function response()
    {
        // Get the row from participant_question where question_id = this one
    }


    // Get the section that this belongs to
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // Get categories for this model
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
