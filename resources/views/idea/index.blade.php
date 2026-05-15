<x-layout>

    <div>
        <header class="py-8 md:py-12">
                <h1 class="text-3xl font-bold text-center mb-8">All Ideas</h1>
                <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>
        </header>
        <div>
            <a href="/ideas" class="btn {{ request('status') === null || request('status') === 'all' ? 'btn-primary' : 'btn-outlined' }}">All</a>
            <a href="/ideas?status=pending" class="btn {{ request('status') === 'pending' ? 'btn-primary' : 'btn-outlined' }}">Pending</a>
            <a href="/ideas?status=in_progress" class="btn {{ request('status') === 'in_progress' ? 'btn-primary' : 'btn-outlined' }}">In Progress</a>
            <a href="/ideas?status=completed" class="btn {{ request('status') === 'completed' ? 'btn-primary' : 'btn-outlined' }}">Completed</a>
        </div>
        <div class="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse ($ideas as $idea)
                    <x-card href="{{ route('idea.show', $idea) }}">
                        <h3 class="text-foreground text-lg">{{ $idea->title }}</h3>
                        <div class="mt-1">
                            <x-idea.status-label status="{{ $idea->status }}">
                                {{ $idea->status->label() }}
                            </x-idea.status-label>
                        </div>
                        <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
                        <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
                    </x-card>
                @empty
                    <x-card>
                        <p>No ideas at this time.</p>
                    </x-card>
                @endforelse
            </div>
    </div>
    </div>

</x-layout>