<?php

use App\Models\Idea;
use App\Models\User;

it('creates a new idea', function () {
    $this->actingAs($user = User::factory()->create());

    visit('/ideas')
        ->click('@modal-form-button')
        ->fill('title', 'Some Example Title')
        ->click('@create-status-completed-button')
        ->fill('description', 'An example description')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'Some Example Title',
        'status' => 'completed',
        'description' => 'An example description',
    ]);

});

// ->debug();
// expect(Idea::count())->toBe(1);
