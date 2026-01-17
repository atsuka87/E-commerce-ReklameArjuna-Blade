<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::post('/payments/midtrans/callback', [PaymentController::class, 'midtransCallback'])
    ->name('payments.midtrans.callback');
