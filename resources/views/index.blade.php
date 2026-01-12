<html>
    <head>
        <title>Submit</title>
        {{-- Tailwind --}}
        <script src="https://cdn.tailwindcss.com"></script>
        {{-- Alpine --}}
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body>
        <h1>Submit</h1>
        <form  action="/render" method="POST">
            <textarea name="content" id="" cols="30" rows="10"></textarea>
            <button>Submit</button>
            @csrf
        </form>
    </body>
</html>