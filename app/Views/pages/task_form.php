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
        main{width:min(700px,90%);margin:45px auto}
        .card{background:white;border-radius:12px;padding:30px;box-shadow:0 4px 14px rgba(0,0,0,.08)}
        h1{margin-top:0;color:#1e3a5f}
        label{display:block;font-weight:bold;margin:18px 0 6px}
        input,select{box-sizing:border-box;width:100%;padding:11px;border:1px solid #cbd5e1;border-radius:6px;font-size:16px}
        .form-actions{display:flex;gap:8px;margin-top:20px}
        .error{color:#991b1b;margin-top:5px}
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
            <h1><?= esc($title) ?></h1>

            <?php if (isset($validation)): ?>
                <div class="error"><?= $validation->listErrors() ?></div>
            <?php endif ?>

            <form action="<?= esc($formAction) ?>" method="post">
                <?= csrf_field() ?>

                <label for="title">Task title</label>
                <input id="title" name="title" maxlength="150" required
                       value="<?= esc(old('title', $task['title'] ?? '')) ?>">

                <label for="task_date">Task date</label>
                <input id="task_date" name="task_date" type="date" required
                       value="<?= esc(old('task_date', $task['task_date'] ?? date('Y-m-d'))) ?>">

                <label for="status">Status</label>
                <?php $currentStatus = old('status', $task['status'] ?? 'pending'); ?>
                <select id="status" name="status">
                    <option value="pending" <?= $currentStatus === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="in progress" <?= $currentStatus === 'in progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="completed" <?= $currentStatus === 'completed' ? 'selected' : '' ?>>Completed</option>
                </select>

                <div class="form-actions">
                    <button class="btn" type="submit"><?= esc($buttonText) ?></button>
                    <a class="btn btn-secondary" href="/tasks">Cancel</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>