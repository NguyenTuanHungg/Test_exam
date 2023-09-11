@if (Route::has('login'))
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        @auth
        <a href="{{ url('/home') }}" class="navbar-brand">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('history') }}" class="nav-link">History</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">Log out</a>
                </li>
            </ul>
        </div>
        @else
        <a href="{{ route('login') }}" class="navbar-brand">Log in</a>
        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="navbar-brand">Register</a>
        @endif
        @endauth
    </div>
</nav>
@endif