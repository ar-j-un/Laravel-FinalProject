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
        ->fill('@new-link', 'https://examplelink.com')
        ->click('@add-new-link-button')
        ->fill('@new-link', 'https://example.com')
        ->click('@add-new-link-button')
        ->fill('@new-step', 'Stepp 1')
        ->click('@add-new-step-button')
        ->fill('@new-step', 'step2')
        ->click('@add-new-step-button')
        ->click('Create')
        // ->screenshot('after-submit')
        ->assertPathIs('/ideas');
    // dd(Idea::count(), $user->ideas()->first());

    expect($idea = $user->ideas()->first())->toMatchArray([
        'title' => 'Some Example Title',
        'status' => 'completed',
        'description' => 'An example description',
        'links' => ['https://examplelink.com', 'https://example.com'],
    ]);

    expect($idea->steps)->toHaveCount(2);
});

// ->debug();
// expect(Idea::count())->toBe(1);
