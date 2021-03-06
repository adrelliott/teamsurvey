<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Participant;
use App\Models\Question;
use App\Models\Section;
use App\Models\Client;

class Survey extends Model
{
    use HasFactory;
    use SoftDeletes;

    private $inviteValues;

    protected $fillable = ['name', 'type', 'description', 'published_at'];

    // Invite participants when given a collection of Participants
    public function invite($participants)
    {
        $this->setInviteValues($participants);
        return $this->participants()->sync($this->inviteValues);
    }

    // Set invite date and create unique hash for this invite
    private function setInviteValues(Collection $participants)
    {
        $participants->each(function ($participant) {
            $this->inviteValues[$participant] = [
                'invite_hash' => Hashids::encode($this->id . $participant),
                'invited_at' => now()
            ];
        });
    }

    // Get sections for this model
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    // Get questions for this model
    public function questions()
    {
        return $this->hasManyThrough(Question::class, Section::class);
    }

    // Get participants for this model
    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }

    // Get the client that this belongs to
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
