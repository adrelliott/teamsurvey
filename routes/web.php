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

// Routes for viewing a survey
Route::get('/ask', [App\Http\Controllers\Participants\SurveyController::class, 'show'])->middleware('is_invited');
Route::view('/ask/invite-not-found', 'participants.surveys.invite-not-valid');
Route::view('/ask/survey-not-available', 'participants.surveys.survey-not-available');
Route::view('/ask/survey-completed', 'participants.surveys.survey-completed');

// Routes for doing a survey
Route::resource('/ask/section', App\Http\Controllers\Participants\SectionController::class)->middleware('is_authorised');





// maybe create group with prefix of 'ask' and as('participants.')








Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
