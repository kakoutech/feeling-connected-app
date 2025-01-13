<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class=" dark:text-white/50">   
            <div class="flex justify-center">
                <div class="relative w-full px-6 lg:max-w-5xl">
                    <header class="!pt-5 h-20">
                        <div class="flex justify-center">
                            <div class="">
                                @if (Route::has('login')) 
                                             {{-- <livewire:welcome.navigation /> --}}
                                @endif
                            </div>
                        </div>
                    </header>

                    <main class="">
                        <div class="">    <livewire:servay-wizard/></div>
                    </main>
                </div>
            </div>
        </div>
    </body>
</html>
