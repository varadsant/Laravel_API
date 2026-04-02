@extends('layouts.auth')

@section('content')
    <p class="text-sm uppercase tracking-[0.35em] text-amber-300">Welcome back</p>
    <h2 class="mt-3 text-3xl font-semibold text-white">Log in to your account</h2>
    <p class="mt-3 text-sm leading-6 text-stone-400">
        Use your registered email and password to continue.
    </p>

    <form method="POST" action="{{ route('login.attempt') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-stone-200">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autofocus
                class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-amber-400"
            >
            @error('email')
                <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="mb-2 block text-sm font-medium text-stone-200">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                required
                class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-amber-400"
            >
            @error('password')
                <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <label class="flex items-center gap-3 text-sm text-stone-300">
            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-white/20 bg-white/5 text-amber-400">
            Remember me
        </label>

        <button
            type="submit"
            class="w-full rounded-2xl bg-amber-400 px-4 py-3 font-semibold text-stone-950 transition hover:bg-amber-300"
        >
            Log in
        </button>
    </form>

    <p class="mt-6 text-sm text-stone-400">
        Need an account?
        <a href="{{ route('register') }}" class="font-semibold text-amber-300 hover:text-amber-200">Create one</a>
    </p>
@endsection
