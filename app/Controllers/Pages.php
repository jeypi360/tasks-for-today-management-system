<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class Pages extends BaseController
{
    public function welcome()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $today = date('Y-m-d');

        $tasks = (new TaskModel())
            ->where('task_date', $today)
            ->where('is_archived', 0)
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('pages/welcome', [
            'title' => 'Tasks for Today',
            'today' => $today,
            'tasks' => $tasks,
        ]);
    }

    public function tasks()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $tasks = (new TaskModel())
            ->where('is_archived', 0)
            ->orderBy('task_date', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();

        return view('pages/tasks', [
            'title' => 'All Tasks',
            'tasks' => $tasks,
            'loggedIn' => true,
        ]);
    }

    public function profile()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        return view('pages/profile', [
            'title' => 'Profile',
            'user' => (new UserModel())->first(),
        ]);
    }

    public function about()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        return view('pages/about', [
            'title' => 'About',
        ]);
    }

    public function login()
    {
        if (session()->has('user_id')) {
            return redirect()->to('/tasks');
        }

        return view('pages/login', [
            'title' => 'Log In',
        ]);
    }

    public function authenticate()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $user = (new UserModel())
            ->where('username', $username)
            ->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'The username or password is incorrect.');
        }

        session()->regenerate(true);
        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'full_name' => $user['full_name'],
        ]);

        return redirect()->to('/tasks')
            ->with('success', 'You are now logged in.');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')
            ->with('success', 'You have been logged out.');
    }

    public function newTask()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        return view('pages/task_form', [
            'title' => 'New Task',
            'task' => null,
            'formAction' => '/tasks',
            'buttonText' => 'Create Task',
        ]);
    }

    public function createTask()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $rules = [
            'title' => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validate($rules)) {
            return view('pages/task_form', [
                'title' => 'New Task',
                'task' => $this->request->getPost(),
                'formAction' => '/tasks',
                'buttonText' => 'Create Task',
                'validation' => $this->validator,
            ]);
        }

        (new TaskModel())->insert([
            'title' => trim((string) $this->request->getPost('title')),
            'status' => $this->request->getPost('status') ?: 'pending',
            'task_date' => $this->request->getPost('task_date'),
            'created_at' => date('Y-m-d H:i:s'),
            'is_archived' => 0,
        ]);

        return redirect()->to('/tasks')
            ->with('success', 'Task created.');
    }

    public function editTask($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $task = (new TaskModel())
            ->where('is_archived', 0)
            ->find($id);

        if (!$task) {
            return redirect()->to('/tasks')
                ->with('error', 'Task not found.');
        }

        return view('pages/task_form', [
            'title' => 'Edit Task',
            'task' => $task,
            'formAction' => '/tasks/' . $id,
            'buttonText' => 'Save Changes',
        ]);
    }

    public function updateTask($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        $model = new TaskModel();

        $task = $model
            ->where('is_archived', 0)
            ->find($id);

        if (!$task) {
            return redirect()->to('/tasks')
                ->with('error', 'Task not found.');
        }

        $rules = [
            'title' => 'required|max_length[150]',
            'task_date' => 'required|valid_date[Y-m-d]',
        ];

        if (!$this->validate($rules)) {
            return view('pages/task_form', [
                'title' => 'Edit Task',
                'task' => array_merge($task, $this->request->getPost()),
                'formAction' => '/tasks/' . $id,
                'buttonText' => 'Save Changes',
                'validation' => $this->validator,
            ]);
        }

        $model->update($id, [
            'title' => trim((string) $this->request->getPost('title')),
            'status' => $this->request->getPost('status') ?: 'pending',
            'task_date' => $this->request->getPost('task_date'),
        ]);

        return redirect()->to('/tasks')
            ->with('success', 'Task updated.');
    }

    public function archiveTask($id)
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        (new TaskModel())
            ->where('is_archived', 0)
            ->update($id, ['is_archived' => 1]);

        return redirect()->to('/tasks')
            ->with('success', 'Task deleted.');
    }

    private function requireLogin()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login')
                ->with('error', 'Please log in to view or manage tasks.');
        }

        return null;
    }
}