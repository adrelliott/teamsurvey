<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Vinkla\Hashids\Facades\Hashids;
use App\Casts\InvitationIdHashCast;

class Invitation extends Model
{
    use HasFactory;

    protected $table='participant_survey';

    protected $guarded = [''];

    protected $updateArray = ['current_section_no'];

    // protected $primaryKey = 'invite_hash';
    public function getRouteKeyName()
    {
        return 'invite_hash';
    }

    public function saveResponses($requestValues)
    {
        // Set current section no & default value for return value
        $this->updateArray['current_section_no'] = intval($requestValues['c']) + 1;
        $endOfSurvey = false;

        // If section is first, then add started_at
        if ($this->updateArray['current_section_no'] == 1) {
            $this->updateArray['started_at'] = now();
        }

        // If section is last then add completed_at
        if ($this->updateArray['current_section_no'] == intval($requestValues['t'])) {
            $this->updateArray['completed_at'] = now();
            $endOfSurvey = true;
        }

        // Update the row & return
        $this->update($this->updateArray);
        return $endOfSurvey;

        // $update = ['current_section_no' => intval($request->get('c', 0)) + 1];
        // if ($update['current_section_no'] == $request->get('t')) {
        //     $update['completed_at'] = now();
        //     $invitation->update($update);
        //     return redirect()->route('surveys.surveyCompleted');
        // }
        // if ($update['current_section_no'] == 1) {
        //     $update['started_at'] = now();
        // }
    }





    // public function __construct()
    // {
    //     dd($this->id);
    //     // $this->id = head(Hashids::decode($this->id));
    // }

    // public function getIdAttribute($value)
    // {
    //     dd('hashid');
    // }
    // public function getHashedIdAttribute()
    // {
    //     dd('hashid');
    // }

    // Unhash the passed string, get the first value from the resulting array & find
    // public static function findByHashedId($hashId)
    // {
    //     return Parent::find(head(Hashids::decode($hashId)));
    // }

    // public static function updateSectionNumber($currentSectionNumber, $totalNumberOfSections)
    // {
    //     if ($currentSectionNumber === $totalNumberOfSections) {
    //         $this->surveys()->sync(['current_section_no' => $currentSectionNumber, 'completed_at' => now()]);
    //     }
    //     $this->surveys()->sync(['current_section_no' => $currentSectionNumber]);
    // }

    // public static function updateByHashedId($hashId, $attributes)
    // {
    //     return Parent::update(head(Hashids::decode($hashId)));
    // }
}
