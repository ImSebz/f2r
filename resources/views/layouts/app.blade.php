{{-- filepath: resources/views/components/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Trivia</title>
    <link rel="stylesheet" href="{{ asset('css/trivia.css') }}">
    @livewireStyles
</head>

<body class="bg-gray-100">
    {{ $slot }}
    @livewireScripts
</body>

</html>
