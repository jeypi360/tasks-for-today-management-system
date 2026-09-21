<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class Pages extends BaseController
{
    public function welcome()
    {
        $taskModel = new TaskModel();
        $today = date('Y-m-d');

        return view('pages/welcome', [
            'title' => 'Tasks for Today',
            'today' => $today,
            'tasks' => $taskModel
                ->where('task_date', $today)
                ->orderBy('id', 'ASC')
                ->findAll(),
        ]);
    }

    public function tasks()
    {
        $taskModel = new TaskModel();

        return view('pages/tasks', [
            'title' => 'All Tasks',
            'tasks' => $taskModel
                ->orderBy('task_date', 'ASC')
                ->orderBy('id', 'ASC')
                ->findAll(),
        ]);
    }

    public function profile()
    {
        $userModel = new UserModel();

        return view('pages/profile', [
            'title' => 'Profile',
            'user'  => $userModel->first(),
        ]);
    }

    public function about()
    {
        return view('pages/about', [
            'title' => 'About',
        ]);
    }
}