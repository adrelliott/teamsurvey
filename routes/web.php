<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Surveys
Route::view('/ask/invite-not-found', 'participants.surveys.invite-not-valid')->name('surveys.inviteNotFound');
Route::view('/ask/survey-not-available', 'participants.surveys.survey-not-available')->name('surveys.surveyNotFound');
Route::view('/ask/survey-completed', 'participants.surveys.survey-completed')->name('surveys.surveyCompleted');
// Has to go last as it's the 'catchall'
Route::get('/ask/{inviteHash}', [App\Http\Controllers\Participants\SurveyController::class, 'show'])->middleware('is_invited');


// Routes for doing a survey
Route::resource('/ask/section', App\Http\Controllers\Participants\SectionController::class)->middleware('is_authorised');





// maybe create group with prefix of 'ask' and as('participants.')








Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
