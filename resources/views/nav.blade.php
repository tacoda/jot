<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <ul>
        @if(auth()->check())
            <i class="fas fa-user"></i>&nbsp;{{ auth()->user()->name }}
            <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <li><a href="/posts/create">Create Post</a></li>
        @else
            <i class="fas fa-user"></i>&nbsp;Guest
            <li><a href="/login">Log In</a></li>
            <li><a href="/register">Register</a></li>
        @endif
        <li><a href="/posts">All Posts</a></li>
    </ul>
</nav>