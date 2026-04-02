<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name', 'Task API') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-stone-950 text-stone-100">
        <div class="relative min-h-screen overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,rgba(245,158,11,0.24),transparent_30%),linear-gradient(135deg,#1c1917,#0c0a09_55%,#1f2937)]"></div>
            <div class="absolute inset-y-0 left-0 w-72 bg-[radial-gradient(circle,rgba(251,191,36,0.16),transparent_65%)] blur-3xl"></div>
            <div class="absolute right-0 top-20 h-72 w-72 rounded-full bg-orange-500/15 blur-3xl"></div>

            <main class="relative mx-auto flex min-h-screen max-w-6xl items-center justify-center px-6 py-10">
                <div class="grid w-full gap-8 lg:grid-cols-[1.1fr_0.9fr]">
                    <section class="hidden rounded-4xl border border-white/10 bg-white/5 p-10 shadow-2xl backdrop-blur lg:block">
                        <p class="text-sm uppercase tracking-[0.35em] text-amber-300">Task API</p>
                        <h1 class="mt-6 max-w-md text-5xl font-semibold leading-tight text-white">
                            Simple auth pages for your Laravel task app.
                        </h1>
                        <p class="mt-6 max-w-lg text-lg leading-8 text-stone-300">
                            This web flow uses Laravel sessions for browser login while your API can keep using Sanctum tokens.
                        </p>
                        <div class="mt-10 grid gap-4 text-sm text-stone-200">
                            <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
                                Register a user from the browser and get redirected into the app.
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
                                Sign in with email and password using Laravel's `auth` middleware.
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-black/20 p-4">
                                Keep API auth separate so mobile apps or Postman can still use Sanctum tokens.
                            </div>
                        </div>
                    </section>

                    <section class="rounded-4xl border border-white/10 bg-stone-900/85 p-6 shadow-2xl backdrop-blur sm:p-8">
                        @yield('content')
                    </section>
                </div>
            </main>
        </div>
    </body>
</html>
