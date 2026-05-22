<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class CreateIdea
{
    public function handle(array $attributes)
    {

        $idea = Auth::user()->ideas()->create(collect($attributes)->except(['steps', 'image'])->toArray());

        $idea->steps()->createMany(
            collect($attributes['steps'])->map(fn ($step) => ['description' => $step])
        );

        $imagePath = $attributes['image']->store('ideas', 'public');

        $idea->update(['image_path' => $imagePath]);

    }
}
