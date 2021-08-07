<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Survey;

class Section extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'published_at'];

    /**
     * Always load questions too.
     *
     * @var array
     */
    protected $with = ['questions'];

    /**
     * Always retutns the sections in order
     * NB: To get in any other order use
     * Section::withoutGlobalScope('sectionsInOrder')->get();.
     *
     * @var array
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sectionsInOrder', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

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
