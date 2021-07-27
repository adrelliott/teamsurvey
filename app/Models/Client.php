<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Participant;
use App\Models\Survey;
use App\Models\Team;
use App\Models\User;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'type', 'street_address', 'city', 'country', 'postcode'];


    // Get users for a client
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Get surveys for a client
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    // Get participants for a client
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    // Get teams for a client
    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
