<?php

Route::get('/test-avatar', function () {
    $users = \App\Models\User::all();
    
    return view('test-avatar', ['users' => $users]);
});
