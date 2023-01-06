<?php

use App\Http\Livewire\Animals\Animals;
use App\Http\Livewire\Annonces\Annonces;

use App\Http\Livewire\Demandes;
use App\Http\Livewire\GardePage;

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\AnimalOwnedForm;
use App\Http\Controllers\ProposalController;


use App\Http\Livewire\Admin\AdminUserController;
use App\Http\Livewire\Admin\AdminAdController;
use App\Http\Livewire\Admin\AdminProposalController;
use App\Http\Livewire\Admin\AdminContactMessageController;
use App\Http\Livewire\Admin\AdminAnimalController;


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


Route::get('/welcome', function () { return view('welcome'); })->name('welcome');

/* Toutes les pages soumises à authentificate*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::resource('/annonces', Annonces::class)->except('index');

    Route::resource('/animals', Animals::class);   

    Route::resource('/demandes', Demandes::class)->except('create');

    Route::get('demandes/{annonce}/create', [Demandes::class, 'create'])->name('demandes.create');

    Route::get('/proposals', [GardePage::class, 'index'])->name('proposals.index');
    Route::resource('/proposals', GardePage::class)->except('index');

    Route::get('markAsRead', function() {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('markRead');
    

});

/* Page principale des Annonces */
Route::get('/', [Annonces::class, 'index'])->name('annonces.index');

/* Route Admin */
Route::middleware(['auth', 'role:Admin'])->group(function(){
    
    Route::get('/admin', function () { return view('admin.index'); })->name('admin/');

    /* Passe par livewire pour le crud */
    Route::get('/admin/ads', [AdminAdController::class, 'index'])->name('admin.ads.index');
    Route::get('/admin/proposals', [AdminProposalController::class, 'index'])->name('admin.proposals.index');
    Route::get('/admin/contacts', [AdminContactMessageController::class, 'index'])->name('admin.contacts.index');
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/animals', [AdminAnimalController::class, 'index'])->name('admin.animals.index');
});

