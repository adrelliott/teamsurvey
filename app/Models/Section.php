<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Survey;

class Section extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'published_at'];


    // Get questions for this model
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Get the survey that this belongs to
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
