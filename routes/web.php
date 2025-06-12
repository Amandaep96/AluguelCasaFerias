<?php

use App\Http\Controllers\BensLocaveisController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationConfirmationMailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiltroController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ReservaUserController;
use Database\Seeders\ReservaSeeder;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('dashboard', [ReservationConfirmationMailController::class, 'sendReservationEmail'])
    ->middleware('auth')
    ->name('send.email');


Route::get('/disponiveis', [BensLocaveisController::class, 'all_avalible'])->name('disponiveis');


Route::get('/reserva/create/{id}', [ReservaUserController::class, 'create'])->name('reserva.create');


Route::post('/reserva/store/', [ReservaUserController::class, 'store'])->name('reserva.store');



Route::get('/pagamento/processar', [PagamentoController::class, 'processar'])->name('pagamento.processar');

Route::get('/dashboard', [ReservaUserController::class, 'minhasReservas'])
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__.'/auth.php';
