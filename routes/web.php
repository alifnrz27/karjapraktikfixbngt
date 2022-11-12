<?php

use App\Http\Controllers\AfterPresentationController;
use App\Http\Controllers\BeforePresentationController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluateController;
use App\Http\Controllers\HardcopyController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\JobTrainingController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MentoringController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/users', UserController::class)->except(['create', 'show', 'edit']);

    Route::resource('/calender', CalenderController::class)->except(['create', 'show', 'edit']);

    Route::resource('/job-training', JobTrainingController::class)->except(['index']);
    Route::post('/job-training/member-upload', [JobTrainingController::class, 'memberUpload']);
    Route::post('/job-training/cancel', [JobTrainingController::class, 'cancel']);
    Route::post('/job-training/accept/{user}/{submission}', [JobTrainingController::class, 'accept']);
    Route::post('/job-training/decline/{user}/{submission}', [JobTrainingController::class, 'decline']);

    Route::post('/job-training/submission-letter', [LetterController::class, 'upload']);
    Route::post('/job-training/submission-letter/accept/{user}/{team}', [LetterController::class, 'accept']);
    Route::post('/job-training/submission-letter/decline/{user}/{team}', [LetterController::class, 'decline']);

    Route::get('/student-register', [JobTrainingController::class, 'index']);

    Route::post('/invitation/accept', [InvitationController::class, 'accept']);
    Route::post('/invitation/decline', [InvitationController::class, 'decline']);

    Route::post('/logbook/add', [LogbookController::class, 'add']);

    Route::post('/mentor/add/{user}', [MentorController::class, 'add']);
    Route::post('/mentor/update/{user}/{update}', [MentorController::class, 'update']);

    Route::post('/mentoring/add', [MentoringController::class, 'add']);
    Route::post('/mentoring/accept/{studentID}', [MentoringController::class, 'accept']);
    Route::post('/mentoring/decline/{studentID}', [MentoringController::class, 'decline']);
    Route::post('/mentoring/finished/{studentID}', [MentoringController::class, 'finished']);
    Route::post('/mentoring/update/{studentID}', [MentoringController::class, 'update']);
    Route::post('/mentoring/cancel/{studentID}', [MentoringController::class, 'cancel']);

    Route::post('/title/add', [TitleController::class, 'add']);
    Route::post('/title/accept/{studentID}/{id}', [TitleController::class, 'accept']);
    Route::post('/title/decline/{studentID}/{id}', [TitleController::class, 'decline']);

    Route::post('/report/add', [ReportController::class, 'add']);
    Route::post('/report/accept/{id}', [ReportController::class, 'accept']);
    Route::post('/report/decline/{id}', [ReportController::class, 'decline']);

    Route::post('/evaluate/{studentID}/{id}', [EvaluateController::class, 'store']);

    Route::post('/before-presentation/add', [BeforePresentationController::class, 'add']);
    Route::post('/before-presentation/accept/{student}/{submission}', [BeforePresentationController::class, 'accept']);
    Route::post('/before-presentation/decline/{student}/{submission}', [BeforePresentationController::class, 'decline']);

    Route::post('/presentation/add', [PresentationController::class, 'add']);
    Route::post('/presentation/accept/{studentID}/{id}', [PresentationController::class, 'accept']);
    Route::post('/presentation/finished/{studentID}/{id}', [PresentationController::class, 'finished']);

    Route::post('/after-presentation/add', [AfterPresentationController::class, 'add']);
    Route::post('/after-presentation/accept/{student}/{submission}', [AfterPresentationController::class, 'accept']);
    Route::post('/after-presentation/decline/{student}/{submission}', [AfterPresentationController::class, 'decline']);

    Route::post('/hardcopy/accept/{student}/{submission}', [HardcopyController::class, 'accept']);

    Route::post('/status/accept/{student}/{submission}', [StatusController::class, 'accept']);
    Route::post('/status/decline/{student}/{submission}', [StatusController::class, 'decline']);
    Route::post('/status/update/accept/{student}/{submission}', [StatusController::class, 'updateAccept']);
    Route::post('/status/update/decline/{student}/{submission}', [StatusController::class, 'updateDecline']);
});
