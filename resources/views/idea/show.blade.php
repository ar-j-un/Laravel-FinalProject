<x-layout>
    <div class="py-8 max-w-4x1 mx-auto">
        <div class="flex justify-between items-center">
            <a href="{{ route('idea.index') }}" class="flex items-center gap-x-2 text-sm font-medium">
                <x-icons.arrow-back />
                Back to Ideas
            </a>
            <div class="gap-x-3 flex items-center">
                <button class="btn btn-outlined">
                    <x-icons.external />
                    Edit Idea
                </button>
                <button class="btn btn-outlined text-red-500">Delete</button>
            </div>
        </div>
        <h1 class="font-bold text-4x1 py-12">{{ $idea->title }}</h1>
        <x-card class="mt-1">
            <div class="text-foreground max-w-none cursor-pointer">{{ $idea->description }}</div>
        </x-card>
    </div>
</x-layout>