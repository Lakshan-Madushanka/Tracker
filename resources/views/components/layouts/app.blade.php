<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ $title ?? config('app.name') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        trix-editor pre strong{
            font-weight: bold;
            color: white !important;
        }
    </style>
</head>
<body class="bg-gray-200">
<header>
    <x-main-nav/>
</header>
<main class="bg-amber-20n0 max-w-5xl min-h-screen mx-auto prose p-4">
    {{ $slot }}
</main>
<script type="module">
    const highlightSyntax = () => {
        document.querySelectorAll('.code pre').forEach((el) => {
            el.removeAttribute('data-highlighted')
            hljs.highlightElement(el);
        });
    }

    document.addEventListener('livewire:init', () => {
        const events = [
            'error-edited',
            'error-created',
            'error-deleted',
            'solution-updated',
            'solution-created',
            'solution-deleted',

        ];

        events.forEach((event) => {
            Livewire.on(event, () => {
                setTimeout(() => {highlightSyntax()}, 2000)
            })
        })
    });

    document.addEventListener('DOMContentLoaded', (event) => {
        highlightSyntax()
    });

</script>
</body>
</html>
