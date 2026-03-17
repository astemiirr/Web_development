<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Car Shop') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot ?? '' }}
        </main>
    </div>

    {{-- Недавно просмотренные товары --}}
    @if(isset($recentProducts) && $recentProducts->count() > 0)
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            <hr class="mb-4">
            <h4 class="text-lg font-semibold mb-3">Недавно просмотренные</h4>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach($recentProducts as $recentProduct)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="{{ $recentProduct->image_url ?? 'https://via.placeholder.com/150' }}" 
                             class="w-full h-24 object-cover" alt="{{ $recentProduct->name }}">
                        <div class="p-2">
                            <h6 class="text-sm font-medium truncate">{{ $recentProduct->name }}</h6>
                            <p class="text-xs text-gray-600">{{ number_format($recentProduct->price, 0, ',', ' ') }} ₽</p>
                            <a href="{{ route('products.show', $recentProduct) }}" class="mt-1 inline-block text-xs text-blue-600 hover:text-blue-800">Смотреть</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</body>
</html>