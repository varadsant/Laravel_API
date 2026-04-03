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

    function addTask(){
        const input = document.getElementById('addTaskInput');
        if (input.value.trim() === '') {
            alert('Please enter a task title.');
            return;
        }

        fetch('/tasks', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ title: input.value.trim() })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const taskList = document.querySelector('ul');
                const newTask = document.createElement('li');
                newTask.className = 'rounded-2xl border border-white/10 bg-white/5 px-4 py-3';
                newTask.innerHTML = `${data.task.title}
                    <button
                        class="ml-2 inline-flex items-center rounded-full cursor-pointer px-2 py-0.5 text-xs font-medium text-white bg-red-500"
                        onclick="toggleStatus(${data.task.id}, this)">
                        Pending
                    </button>`;
                taskList.appendChild(newTask);
                input.value = '';
            } else {
                alert('Failed to add task. Please try again.');
            } 
       })
       .catch(error => {
            console.log('Error adding task:', error);
            alert('An error occurred while adding the task. Please try again.', error);
        });

        console.log('Adding task with title:', input.value.trim());
    }

    function deleteTask(taskId){
        if (!confirm('Are you sure you want to delete this task?')) {
            return;
        }

        fetch(`/tasks/${taskId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const taskItem = document.querySelector(`.delete-btn[data-id="${taskId}"]`).closest('li');
                taskItem.remove();
            } else {
                alert('Failed to delete task. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error deleting task:', error);
            alert('An error occurred while deleting the task. Please try again.');
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
                            class="ml-2 inline-flex items-center rounded-full cursor-pointer px-2 py-0.5 text-xs font-medium text-white
                                {{ $task->is_completed ? 'bg-green-500' : 'bg-red-500' }}"
                            onclick="toggleStatus({{ $task->id }}, this)">
                            {{ $task->is_completed ? 'Completed' : 'Pending' }}
                        </button>

                        <button class="delete-btn cursor-pointer absolute right-2 
                        text-red-400 hover:text-red-600" data-id="{{ $task->id }}"
                        onclick="deleteTask({{ $task->id }})">
                            🗑️
                        </button>
                    </li>
                @endforeach
            @else
                <li class="rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                    No tasks found for <span class="font-semibold text-white">{{ Auth::user()->name }}</span>.
                </li>
            @endif
        </ul>

        <div class="relative mt-6">
            <input type="text" placeholder="Add a new task..."
            class="w-full pr-28 rounded-2xl border border-white/10 bg-white/5 
            px-4 py-3 text-sm text-stone-200 focus:outline-none 
            focus:ring-2 focus:ring-amber-300" id="addTaskInput" />

            <button id="addTaskButton" class="absolute right-2 top-1/2 -translate-y-1/2 rounded-xl
            border border-white/10 bg-black/20 px-3 py-1 text-sm text-stone-100 
            hover:border-amber-300"
            onclick="addTask()">
                Add Task
            </button>
        </div>

        <a
            href="{{ route('dashboard') }}"
            class="mt-4 inline-flex w-fit rounded-2xl border border-white/10 bg-black/20 px-4 py-3 text-sm font-medium text-stone-100 transition hover:border-amber-300 hover:text-white"
        >
            Back to Dashboard
        </a>
    </div>
@endsection

