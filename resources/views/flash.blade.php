@if(session('message'))
    <div class="container box info">
        <h3>{{ session('message') }}</h3>
    </div>
@endif