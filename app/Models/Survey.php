<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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

    // Invite participants when given an array of IDs
    public function invite(Collection $participants)
    {
        // Sort the participants by client_id

        // Check that this user belongs to the same client as the survey does

        $this->setInviteValues($participants);
        return $this->participants()->sync($this->inviteValues);
    }

    // Set invite date and create unique hash for this invite
    private function setInviteValues($participants)
    {
        $participants->each(function ($participant) {
            $this->inviteValues[$participant->id] = [
                'invite_hash' => bcrypt($this->id . $participant->id),
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
