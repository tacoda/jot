@component('mail::message')
# New Post Created

## {{ $post->title }}

{{ $post->content }}

@component('mail::button', ['url' => url('/posts/' . $post->id)])
View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
