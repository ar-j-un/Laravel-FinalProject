<?php

use App\Models\User;

it('creates a new idea', function () {
    $this->actingAs(User::factory()->create());

    visit('/ideas')
        ->click('@modal-form-button')
        ->fill('title', 'Some Example Title')
        ->click('@create-status-completed-button')
        ->fill('description', 'An example description')
        ->debug();
});
