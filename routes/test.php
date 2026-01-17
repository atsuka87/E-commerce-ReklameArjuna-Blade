<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-admin', function () {
    if (auth()->guard('admin')->check()) {
        return 'Admin is logged in: ' . auth()->guard('admin')->user()->name;
    } else {
        return 'Admin not logged in';
    }
});

Route::get('/test-all-users', function () {
    $users = \App\Models\User::all();
    $output = '';
    foreach ($users as $user) {
        $output .= "User: {$user->name} ({$user->email}) - Role: {$user->role}\n";
    }
    return $output;
});
