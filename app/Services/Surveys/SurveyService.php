<?php

namespace App\Services\Surveys;

use App\Models\Survey;
use Illuminate\Support\Facades\Cache;

class SurveyService
{
    protected $survey;

    protected $finalSection = false;

    public function getSurvey($invitation)
    {
        // Get the surveyId and bail if it's not present
        $surveyId = $invitation->survey_id;
        throw_if(! $surveyId, SurveyNotFoundException::class);

        // Look in the cache for this survey model, and if it's not there, get it
        // (local cache for 3 seconds, production cache for 60 mins)
        $this->survey = Cache::remember('survey_.'.$surveyId, env('NO_OF_SECONDS_TO_CACHE_FOR', 3600), function () use ($surveyId) {
            return Survey::where('id', $surveyId)
                ->whereNotNull('published_at')
                ->whereNull('closed_at')
                ->with('sections') // See Section & Question model for sorting order and $with
                ->withCount('sections')
                ->first();
        });
        throw_if(! $this->survey, SurveyNotFoundException::class);

        $this->survey->current_section = $invitation->current_section_no ?: 0;
        // ddd($this->survey);
        return $this->survey;

        // $this->survey->sections = $this->survey->sections->sortBy('order');
        // $this->survey->total_sections = $this->survey->sections->count();
        // $this->survey->next_section = $this->getNextSection($this->survey->current_section);
        // $this->survey->last_section = $this->survey->sections->sortBy('order')->last();
        // // $this->setSectionsAttribute();

        // Get & set current section, total sections & flag for if this is the final section
        // $this->survey->total_sections = $this->survey->sections->count();
        // $this->survey->current_section = $this->getCurrentSection($invitation->current_section_id);
        // $this->survey->next_section = $this->getNextSection($this->survey->current_section);
        // $this->survey->last_section = $this->survey->sections->sortBy('order')->last();
    }

    // private function setSectionsAttribute()
    // {
    //     // current section, total sections
    //     $this->survey->sections = $this->survey->sections->sortBy('order');
    //     $this->survey->section_current =
    //     dd($this->survey);
    // }

    // private function getNextSection($currentSection)
    // {
    //     if ($currentSection->order === $this->survey->total_sections) {
    //         return null;
    //     }
    //     return $this->survey->sections->where('order', $currentSection->order + 1)->first();
    // }

    // private function getCurrentSection($currentSectionId)
    // {
    //     // If no id is passed, then return the first section
    //     if (! $currentSectionId) {
    //         return 1;
    //     // return $this->survey->sections->sortBy('order')->first();
    //     } else {
    //         return $this->survey->sections->firstWhere('id', $currentSectionId);
    //     }
    // }
}
