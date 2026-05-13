<nav class="border-b border-border px-6">
    <div class="max-w-7x1 ma-auto h-16 flex items-center justify-between">
        <div>
            <a href="" class="inline-flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10 inline-block mr-2">
                <span class="relative top-0.5">Idea</span>
            </a>
        </div>
        <div class='flex items-center gap-4'>

            @auth
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="btn">Logout</button>
                </form>
            @endauth

            @guest
                <a href="/login">Sign In</a>
                <a href="/register" class="btn">Register</a>
            @endguest
        </div>
    </div>
</nav>