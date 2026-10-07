<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <style>
        body{margin:0;font-family:Arial,sans-serif;background:#f4f7fb;color:#1f2937}
        nav{background:#1e3a5f;padding:12px 8%;display:flex;align-items:center;gap:22px;flex-wrap:wrap}
        nav a{color:white;text-decoration:none;font-weight:bold}
        nav a:hover{color:#bfdbfe}
        nav form{margin-left:auto}
        .btn{box-sizing:border-box;display:inline-flex;align-items:center;justify-content:center;height:40px;padding:0 16px;border:0;border-radius:6px;background:#1e3a5f;color:white;text-decoration:none;font:700 14px Arial,sans-serif;cursor:pointer}
        .btn-secondary{background:#64748b}
        .btn-danger{background:#991b1b}
        main{width:min(1000px,90%);margin:45px auto}
        .card{background:white;border-radius:12px;padding:30px;box-shadow:0 4px 14px rgba(0,0,0,.08)}
        h1{margin-top:0;color:#1e3a5f}
        table{width:100%;border-collapse:collapse;margin-top:20px}
        th,td{padding:12px;text-align:left;border-bottom:1px solid #dbe3ee}
        th{background:#e8f0fe}
        .status{display:inline-block;padding:5px 10px;border-radius:20px;background:#dbeafe;color:#1e40af;font-size:14px;text-transform:capitalize}
        .actions{white-space:nowrap}
        .actions form{display:inline}
        .notice{padding:12px;border-radius:6px;background:#dcfce7;color:#166534}
        .error{background:#fee2e2;color:#991b1b}
    </style>
</head>
<body>
    <nav>
        <a href="/">Today</a>
        <a href="/tasks">Task List</a>
        <a href="/profile">Profile</a>
        <a href="/about">About</a>
        <form action="/logout" method="post">
            <?= csrf_field() ?>
            <button class="btn" type="submit">Log Out</button>
        </form>
    </nav>

    <main>
        <section class="card">
            <h1>All Tasks</h1>
            <p>Every active task in the system, ordered by date.</p>

            <?php if (session()->getFlashdata('success')): ?>
                <p class="notice"><?= esc(session()->getFlashdata('success')) ?></p>
            <?php endif ?>
            <?php if (session()->getFlashdata('error')): ?>
                <p class="notice error"><?= esc(session()->getFlashdata('error')) ?></p>
            <?php endif ?>

            <p><a class="btn" href="/tasks/new">+ New Task</a></p>

            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Task</th><th>Status</th><th>Task Date</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($tasks)): ?>
                        <tr><td colspan="5">No active tasks found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?= esc($task['id']) ?></td>
                                <td><?= esc($task['title']) ?></td>
                                <td><span class="status"><?= esc($task['status']) ?></span></td>
                                <td><?= esc(date('F j, Y', strtotime($task['task_date']))) ?></td>
                                <td class="actions">
                                    <a class="btn" href="/tasks/<?= esc($task['id']) ?>/edit">Edit</a>
                                    <form action="/tasks/<?= esc($task['id']) ?>/delete"
                                          method="post"
                                          onsubmit="return confirm('Delete this task?')">
                                        <?= csrf_field() ?>
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>