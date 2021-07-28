<?php

namespace App\Services\Surveys;

use App\Models\Survey;
use Illuminate\Support\Facades\Cache;

class SurveyService
{
    protected $survey;

    public function findActiveSurveyById($surveyId)
    {
        // Cache gets flushed if changes are made to this survey
        $this->survey = Cache::rememberForever('survey_.'.$surveyId, function () use ($surveyId) {
            return $this->survey = Survey::where('id', $surveyId)
                ->whereNotNull('published_at')
                ->whereNull('closed_at')
                ->with('sections')
                ->with('sections.questions')
                ->first();
        });

        return $this->survey;
    }

    public function getCurrentSection($sectionId)
    {
        $sections = $this->survey->sections;

        if (! $sectionId) {
            return $sections->sortBy('order')->first();
        }
        return $sections->firstWhere('id', $sectionId);
    }

    public function totalNoOfSections()
    {
        return $this->survey->sections->count();
    }
}
