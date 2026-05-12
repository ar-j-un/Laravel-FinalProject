<?php


use App\Models\User;

it('logs in a user', function () {

    $user = User::factory()->create([
            'password' => 'Password',
        ]);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'Password',
    ]);

    $response->assertRedirect('/');

    $this->assertAuthenticated();


});

it('logs out a user', function () {

   $user = User::factory()->create();

   $this->actingAs($user);

    $response = $this->post('/logout');

    $response->assertRedirect('/');

    expect(auth()->check())->toBeFalse();

    $this->assertGuest();
    
});



// it('logs in a user', function () {

//     $user = User::factory()->create([
//             'password' => 'Password',
//         ]);

//     visit('/login')
//         ->fill('email', $user->email)
//         ->fill('password', 'password')
//         ->click('@login-button')
//         ->assertPathIs('/');    

//     $this->assertAuthenticated();

// });