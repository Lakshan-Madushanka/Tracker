<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ $title ?? config('app.name') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
</head>
<body class="bg-gray-200">
<header>
    <x-main-nav/>
</header>
<main class="bg-amber-20n0 max-w-5xl min-h-screen mx-auto prose p-4">
    {{ $slot }}
</main>
<script type="module">
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelectorAll('.code').forEach((el) => {
            hljs.highlightElement(el);
        });
    });
</script>
</body>
</html>
