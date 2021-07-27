<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/ask', [App\Http\Controllers\Participants\SurveyController::class, 'show'])->middleware('is_invited');
Route::view('/ask/invite-not-found', 'participants.invite-not-valid');
Route::view('/ask/survey-not-available', 'participants.survey-not-available');
// maybe create group with prefix of 'ask' and as('participants.')








Route::get('/', function () {
    $survey = App\Models\Survey::first();
    var_dump($survey->toArray());
    echo '<br><br>';
    $participants = App\Models\Participant::where('client_id', $survey->client_id)->take(3)->get();
    $participants->each(function ($participant) {
    });
    var_dump($participants->count());
    echo '<br>';
    $survey->invite($participants);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
