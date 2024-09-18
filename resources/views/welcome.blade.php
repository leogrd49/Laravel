<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* Your existing styles here */
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-blue-50 text-blue-500 dark:bg-blue-900 dark:text-blue-500">
            {{-- <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" /> --}}
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-blue-600 selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <!-- Your existing logo here -->
                        </div>
                        <div class="flex lg:justify-center lg:col-start-2">
                            <a class="border-2 mr-2 border-blue-600 text-blue-600 px-4 py-2 inline-block rounded-lg hover:bg-blue-600 hover:text-white" href="{{ route('absence.index') }}">
                                Absences
                            </a>
                            <a class="border-2 mr-2 border-blue-600 text-blue-600 px-4 py-2 inline-block rounded-lg hover:bg-blue-600 hover:text-white" href="{{route('user.index')}}">
                                Utilisateurs
                            </a>
                            <a class="border-2 border-blue-600 text-blue-600 px-4 py-2 inline-block rounded-lg hover:bg-blue-600 hover:text-white" href="{{route('motif.index')}}">
                                Motif
                            </a>
                        </div>
                        <!-- Your existing navigation here -->
                    </header>

                    <!-- Your existing main content here -->

                    <footer class="py-16 text-center text-sm text-blue-500 dark:text-blue-500">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
