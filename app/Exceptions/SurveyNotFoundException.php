<?php

namespace App\Exceptions;

use Exception;

class SurveyNotFoundException extends Exception
{
    public function render()
    {
        return redirect()->route('surveys.surveyNotFound');
    }
}
