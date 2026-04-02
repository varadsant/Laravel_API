@extends('layouts.auth')

<script>
    function toggleStatus(taskId, button){
        console.log('Toggling status for task ID:', taskId);
        fetch(`/tasks/${taskId}/toggle`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            button.textContent = data.status;
            if (data.status === 'Completed') {
                button.classList.remove('bg-red-500');
                button.classList.add('bg-green-500');
            } else {
                button.classList.remove('bg-green-500');
                button.classList.add('bg-red-500');
            }
        })
        .catch(error => {
            console.error('Error toggling task status:', error);
            alert('An error occurred while toggling task status. Please try again.');
        });
    }

</script>

@section('content')
    <div class="flex min-h-[60vh] flex-col">
        <h1 class="text-2xl font-semibold text-white">{{ Auth::user()->name }}'s Tasks</h1>

        <ul class="mt-6 space-y-2 text-stone-200">
            @if (!empty($tasks) && count($tasks) > 0)
                @foreach ($tasks as $task)
                    <li class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                        {{ $task->title }}
                        <button
                            class="ml-2 inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium text-white
                                {{ $task->is_completed ? 'bg-green-500' : 'bg-red-500' }}"
                            onclick="toggleStatus({{ $task->id }}, this)">
                            {{ $task->is_completed ? 'Completed' : 'Pending' }}
                        </button>
                    </li>
                @endforeach
            @else
                <li class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                    No tasks found for <span class="font-semibold text-white">{{ Auth::user()->name }}</span>.
                </li>
            @endif
        </ul>

        <a
            href="{{ route('dashboard') }}"
            class="mt-4 inline-flex w-fit rounded-2xl border border-white/10 bg-black/20 px-4 py-3 text-sm font-medium text-stone-100 transition hover:border-amber-300 hover:text-white"
        >
            Back to Dashboard
        </a>
    </div>
@endsection

