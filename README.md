# Task API

A simple Laravel task management application with API authentication and a Blade-based task dashboard.

## What this project does

- Manages users and tasks using Laravel.
- Supports user registration, login, and logout via API routes.
- Allows logged-in users to create tasks, toggle task status, and delete tasks.
- Uses Blade templates and plain JavaScript on the task page.

## Tech stack

- Laravel (PHP)
- Laravel Sanctum for API token authentication
- Blade templates for views
- Tailwind CSS for styling
- Vite for frontend asset bundling
- Plain JavaScript for task interactions

## React in this project

This project does not use React. The task page is built with Blade and vanilla JavaScript functions instead of React components.

## Key frontend functions

The task dashboard uses these JavaScript functions:

- `toggleStatus(taskId, button)`
    - Sends a POST request to toggle a task's completed status.
    - Updates the button text and CSS class based on the new status.

- `addTask()`
    - Reads the task title from the input field.
    - Sends a POST request to create a new task.
    - Adds the new task to the page without reloading.

- `deleteTask(taskId)`
    - Sends a DELETE request for the selected task.
    - Removes the task from the page when successful.

These functions use `fetch()` and include the CSRF token for security.

## API routes

Defined in `routes/api.php`:

- `POST /register` — register a new user
- `POST /login` — log in and receive an API token
- `POST /logout` — log out the authenticated user
- `apiResource('tasks', TaskController::class)` — task endpoints for authenticated users

The `tasks` resource includes:

- `GET /tasks` — list current user tasks
- `POST /tasks` — create a new task
- `DELETE /tasks/{task}` — delete a task

## Important files

- `app/Http/Controllers/Api/AuthController.php` — handles user registration, login, and logout
- `app/Http/Controllers/Api/TaskController.php` — handles task creation and listing
- `app/Models/User.php` — defines user-task relationship
- `app/Models/Task.php` — task model and fillable fields
- `resources/views/tasks/index.blade.php` — task dashboard and JavaScript functions
- `resources/js/app.js` — frontend entry point that imports `bootstrap.js`
- `resources/js/bootstrap.js` — handles client-side bootstrap logic

## Setup

1. Install PHP dependencies:

    ```bash
    composer install
    ```

2. Install JavaScript dependencies:

    ```bash
    npm install
    ```

3. Run database migrations:

    ```bash
    php artisan migrate
    ```

4. Start the development server:

    ```bash
    php artisan serve
    ```

5. Build frontend assets during development:

    ```bash
    npm run dev
    ```

## Notes

- The repository is currently an API-backed Laravel app with Blade views and vanilla JavaScript.
- There are no React components or React hooks in this codebase.
