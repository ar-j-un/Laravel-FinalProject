<?php

use App\Models\User;

it('registers a user', function () {

    $response = $this->post('/register', [
        'name' => 'Sara',
        'email' => 'sara@example.com',
        'password' => 'Password',
    ]);

    $response->assertRedirect('/');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([
        'name' => 'Sara',
        'email' => 'sara@example.com'
    ]);
    
});




// it('registers a user', function () {
//     visit('/register')
//         ->fill('name', 'sara')
//         ->fill('email', 'sara@example.com')
//         ->fill('password', 'password')
//         ->click('Register')
//         ->assertPathIs('/');
//    $this->assertAuthenticated();
//  });



 // it('registers a user', function () {
//     visit('/register')
//         ->type('input[name=name]', 'sara')
//         ->type('input[name=email]', fake()->safeEmail())
//         ->type('input[name=password]', 'Password123!')
//         ->type('input[name=password_confirmation]', 'Password123!')
//         ->press('Register')
//         ->pause(5000)
//         ->assertPathIs('/');
//      expect(User::where('email', 'sara@example.com')->exists())
//      ->toBeTrue();
//      expect(auth()->check())->toBeTrue();
// });


// test('the application returns a successful response', function (): void {
//     $response = $this->get('/');

//     $response->assertStatus(200);
// });
