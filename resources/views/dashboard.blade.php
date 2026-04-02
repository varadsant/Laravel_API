@extends('layouts.auth')

@section('content')
    <p class="text-sm uppercase tracking-[0.35em] text-amber-300">Dashboard</p>
    <h2 class="mt-3 text-3xl font-semibold text-white">Hello, {{ $user->name }}</h2>
    <p class="mt-3 text-sm leading-6 text-stone-400">
        You are signed in with Laravel's session-based web auth. Your API routes can still use Sanctum tokens separately.
    </p>

    <div class="mt-8 rounded-3xl border border-white/10 bg-white/5 p-5 text-sm text-stone-300">
        <p><span class="font-semibold text-white">Name:</span> {{ $user->name }}</p>
        <p class="mt-2"><span class="font-semibold text-white">Email:</span> {{ $user->email }}</p>
    </div>

    @if (! empty($apiToken))
        <div class="mt-6 rounded-3xl border border-white/10 bg-black/20 p-5">
            <p class="text-sm font-semibold text-white">API Token (Sanctum)</p>
            <p class="mt-2 break-all font-mono text-xs text-stone-300">{{ $apiToken }}</p>
            <p class="mt-3 text-xs text-stone-400">
                Send this as a Bearer token to call `auth:sanctum` routes like `GET /api/tasks`.
            </p>
        </div>
    @endif

    <div class="mt-8 flex flex-wrap gap-3">
        <a
            href="{{ url('/api/tasks') }}"
            class="rounded-2xl border border-white/10 px-4 py-3 text-sm font-medium text-stone-200 transition hover:border-amber-300 hover:text-white"
        >
            API Tasks Endpoint
        </a>

        <a
            href="{{ url('/tasks') }}"
            class="rounded-2xl border border-white/10 px-4 py-3 text-sm font-medium text-stone-200 transition hover:border-amber-300 hover:text-white"
        >
            Tasks Endpoint
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                type="submit"
                class="rounded-2xl bg-amber-400 px-4 py-3 text-sm font-semibold text-stone-950 transition hover:bg-amber-300"
            >
                Log out
            </button>
        </form>
    </div>
@endsection
