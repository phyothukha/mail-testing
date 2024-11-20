<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Mail;
use \App\Mail\TestMail;

Route::get('/', function () {
    $postTitle= "Testing with Mail Trap".rand(1,100);
    $postDescription= "Email Delivery Platform that delivers just in time. Great for dev, and marketing teams.".rand(1,100);
    $mails= [
        "kyawkyawkhant789@gmail.com",'phyothukha2193@gmail.com',"phyrous2193@gmail.com","phyothukha@xsphere.co","arkarlin486@gmail.com","aunghtetminzin@gmail.com"];

    foreach ($mails as $mail){
    Mail::to($mail)
        ->later(now()->addMinutes(1), new TestMail($postTitle,$postDescription));
    }

    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
