<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Edit</title>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        @auth
        
        <form method="POST" action='/edit-post/{{$post->id}}'>
            @csrf
            @method('PUT')
            <h1>Update Post</h1>
            <input type='text' name='post' placeholder="Post" value="{{$post->post}}"/>
            <textarea name='body' placeholder="Body">{{$post->body}}</textarea>
            <button type="submit">Save Changes</button>
        </form>

        @endauth
    </body>
</html>
