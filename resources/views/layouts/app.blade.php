{{-- filepath: resources/views/components/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>F2R</title>
    <link rel="stylesheet" href="{{ asset('css/trivia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/resultados.css') }}">
    @livewireStyles
</head>

<body class="bg-gray-100">
    {{ $slot }}
    @livewireScripts
</body>

</html>
