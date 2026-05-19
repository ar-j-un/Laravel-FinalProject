<x-layout>

    <div>
        <header class="py-8 md:py-12">
                <h1 class="text-3xl font-bold text-center mb-8">All Ideas</h1>
                <p class="text-muted-foreground text-sm mt-2">Capture your thoughts. Make a plan.</p>

                <x-card
                    x-data
                    {{-- x-on:click="$dispatch('open-modal', { name: 'create-idea' })" --}}
                    @click="$dispatch('open-modal','create-idea')"
                    is="button"
                    type="button"
                    class="mt-10 cursor-pointer h-32 w-full text-left"
                    >
                    <p>What's the idea?</p>
                </x-card>
        </header>

        <div>
            <a href="/ideas" class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}">All
            <span class="text-xs pl-3">{{ $statusCounts->get('all') }}</span>
            </a>
            @foreach (App\IdeaStatus::cases() as $status)                
            <a
                href="/ideas?status={{ $status->value }}"
                class="btn {{ request('status') === $status->value ? 'btn-primary' : 'btn-outlined' }}"
            >
                {{ $status->label() }}<span class="text-xs pl-3">{{ $statusCounts->get($status->value) }}</span>
            </a>
            @endforeach
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

    {{-- <!-- modal -> --}}
        <x-modal name="create-idea" title="New Idea">
            <form method="POST" action="{{ route('idea.store') }}">
                @csrf

                <div class="space-y-6">
                    <x-form.field
                        label="Title"
                        name="title"
                        placeholder="Enter an idea for your title"
                        autofocus
                    />

                    <x-form.field
                        label="Description"
                        name="description"
                        type="textarea"
                        placeholder="Describe your idea..."
                    />
                </div>
            </form>
        </x-modal>

    </div>

</x-layout>



    {{-- <div>
            <a href="/ideas" class="btn {{ request('status') === null ? 'btn-primary' : 'btn-outlined' }}">All</a>
            <a href="/ideas?status=pending" class="btn {{ request('status') === 'pending' ? 'btn-primary' : 'btn-outlined' }}">Pending</a>
            <a href="/ideas?status=in_progress" class="btn {{ request('status') === 'in_progress' ? 'btn-primary' : 'btn-outlined' }}">In Progress</a>
            <a href="/ideas?status=completed" class="btn {{ request('status') === 'completed' ? 'btn-primary' : 'btn-outlined' }}">Completed</a>
        </div> --}}


        {{-- <!-- modal -->
        <div
        x-data="{ show: false }"
        x-show="show"
        x-on:keydown.escape.window="show = false"
        {{-- @open-modal.window="alert('heard that!')" --}}
        {{-- x-on:open-modal.window="if($event.detail === 'create-idea') show = true"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs"
        >
        <x-card @click.away="show = false">
        <p>I am a modal.</p>
        </x-card>
    </div> --}}