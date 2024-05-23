<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">

        @auth
        <p>Congrats! You are logged in</p>
        <form method="POST" action='/logout'>
            @csrf
            <button>Log Out</button>
        </form>

        <form method="POST" action='/create-post'>
            @csrf
            <h1>Create Post</h1>
            <input type='text' name='post' placeholder="Post" />
            <textarea name='body' placeholder="Body"></textarea>
            <button type="submit">Create Post</button>
        </form>


        <div class="flex justify-center items-center flex-col">
            <h2>All Posts</h2>
            @if (count($posts) > 0)
              @foreach ($posts as $post)
                 <div class="flex flex-col justify-center gap-2 bg-slate-600">
                    <p>{{$post['id']}}</p>
                    <p>{{$post['post']}}</p>
                    <p>{{$post['body']}}</p>
                    <p>
                        <a href="/edit-post/{{$post->id}}">Edit</a>
                    </p>
                    <form method="POST" action="/delete-post/{{$post->id}}">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                 </div>
              @endforeach
            @endif
        </div>
        @else
        <form method="POST" action='/register'>
            @csrf
            <h1>Register</h1>
            <input type='text' name='name' placeholder="Name" />
            <input type='email' name='email' placeholder="Email" />
            <input type='password' name='password' placeholder="Password" />
            <button type="submit">Register</button>
        </form>

        <form method="POST" action='/login'>
            @csrf
            <h1>Login</h1>
            <input type='text' name='name' placeholder="Name" />
            <input type='password' name='password' placeholder="Password" />
            <button type="submit">Login</button>
        </form>
            
        @endauth

        
    </body>
</html>
