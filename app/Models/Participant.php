<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use App\Models\Survey;
use App\Models\Client;

class Participant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'cohort', 'active'];

    // public static function findByInviteHash($inviteHash)
    // {
    //     return parent::where('invite_hash', $inviteHash)->first();
    // }

    public function saveResponses(array $responses)
    {
        $save = [];
        foreach ($responses as $question_id => $response) {
            $save[$question_id] = ['response' => $response];
        }
        return $this->questions()->attach($save);
    }

    // public function updateSectionNumber($currentSectionNumber, $totalNumberOfSections)
    // {
    //     // if ($currentSectionNumber === $totalNumberOfSections) {
    //     //     $this->surveys()->sync(['current_section_no' => $currentSectionNumber, 'completed_at' => now()]);
    //     // }
    //     // $this->surveys()->sync(['current_section_no' => $currentSectionNumber]);
    // }

    // Get surveys for this model
    public function surveys()
    {
        return $this->belongsToMany(Survey::class);
    }

    // Get questions for this model
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    // Get invites for this model
    public function invitations()
    {
        return $this->belongsToMany(Invitation::class);
    }

    // Get the client that this belongs to
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
