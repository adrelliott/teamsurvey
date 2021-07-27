<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Survey;
use App\Models\Client;

class Participant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'cohort', 'active'];


    // Get surveys for this model
    public function surveys()
    {
        return $this->belongsToMany(Survey::class);
    }

    // Get the client that this belongs to
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
