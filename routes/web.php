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
Route::get('/ask/{invitation}', [App\Http\Controllers\Participants\InvitationController::class, 'show'])
    ->name('ask.show')
    ->missing(function (Request $request) {
        throw new App\Exceptions\InvitationNotFoundException;
    });
Route::post('/ask/{invitation}', [App\Http\Controllers\Participants\InvitationController::class, 'store'])->name('ask.store');

Route::view('/ask/status/invite-not-found', 'front-end.surveys.invite-not-valid')->name('surveys.inviteNotFound');
Route::view('/ask/status/survey-not-available', 'front-end.surveys.survey-not-available')->name('surveys.surveyNotFound');
Route::view('/ask/status/survey-completed', 'front-end.surveys.survey-completed')->name('surveys.surveyCompleted');
// Has to go last as it's the 'catchall'
// Route::get('/ask/{inviteHash}', [App\Http\Controllers\Participants\SurveyController::class, 'show'])->middleware('is_invited')->name('ask.show');
// Route::post('/ask/{inviteHash}', App\Http\Controllers\Participants\ResponseController::class)->middleware('is_authorised')->name('ask.store');



// Routes for doing a survey
Route::resource('/ask/section', App\Http\Controllers\Participants\SectionController::class)->middleware('is_authorised');





// maybe create group with prefix of 'ask' and as('participants.')








Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
