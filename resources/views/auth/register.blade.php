@extends('layouts.auth')

@section('content')
    <p class="text-sm uppercase tracking-[0.35em] text-amber-300">Get started</p>
    <h2 class="mt-3 text-3xl font-semibold text-white">Create your account</h2>
    <p class="mt-3 text-sm leading-6 text-stone-400">
        Register once, then use the same credentials for the web session and API login.
    </p>

    <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5">
        @csrf

        <div>
            <label for="name" class="mb-2 block text-sm font-medium text-stone-200">Name</label>
            <input
                id="name"
                name="name"
                type="text"
                value="{{ old('name') }}"
                required
                autofocus
                class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-amber-400"
            >
            @error('name')
                <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-medium text-stone-200">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
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

        <div>
            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-stone-200">Confirm password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white outline-none transition focus:border-amber-400"
            >
        </div>

        <button
            type="submit"
            class="w-full rounded-2xl bg-amber-400 px-4 py-3 font-semibold text-stone-950 transition hover:bg-amber-300"
        >
            Create account
        </button>
    </form>

    <p class="mt-6 text-sm text-stone-400">
        Already registered?
        <a href="{{ route('login') }}" class="font-semibold text-amber-300 hover:text-amber-200">Log in</a>
    </p>
@endsection
