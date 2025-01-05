<?php

use App\Models\User;

test('a user can be created', function () {
    $user = User::factory()->create();
    expect($user)->toBeClass(User::class);
});
