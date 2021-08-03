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
        if (! $surveyId) {
            return false;
        }

        // Look in the cache for this survey model, and if it's not there, get it
        // (local cache for 3 seconds, production cache for 60 mins)
        $this->survey = Cache::remember('survey_.'.$surveyId, env('NO_OF_SECONDS_TO_CACHE_FOR', 3600), function () use ($surveyId) {
            return Survey::where('id', $surveyId)
                ->whereNotNull('published_at')
                ->whereNull('closed_at')
                ->with('sections')
                ->with('sections.questions')
                ->first();
        });

        // Get & set current section, total sections & flag for if this is the final section
        $this->survey->current_section = $this->getCurrentSection($invitation->current_section_id);
        $this->survey->total_sections =$this->survey->sections->count();
        $this->survey->finalSection = $this->finalSection;

        return $this->survey;
    }


    private function getCurrentSection($sectionId)
    {
        $sections = $this->survey->sections;

        // If no id is passed, then return the first section
        if (! $sectionId) {
            return $sections->sortBy('order')->first();
        }

        // Get current section and last section
        $currentSection = $sections->firstWhere('id', $sectionId);
        $lastSection = $sections->sortBy('order')->last();

        // if they're the same, then set the finalSection flag to true
        if ($currentSection->id == $lastSection->id) {
            $this->finalSection = true;
        }

        return $currentSection;
    }
}
