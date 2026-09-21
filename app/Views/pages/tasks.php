<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        nav {
            background: #1e3a5f;
            padding: 18px 8%;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 22px;
            font-weight: bold;
        }

        nav a:hover {
            color: #bfdbfe;
        }

        main {
            width: min(1000px, 90%);
            margin: 45px auto;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            color: #1e3a5f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dbe3ee;
        }

        th {
            background: #e8f0fe;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            background: #dbeafe;
            color: #1e40af;
            font-size: 14px;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <nav>
        <a href="/">Today</a>
        <a href="/tasks">Task List</a>
        <a href="/profile">Profile</a>
        <a href="/about">About</a>
    </nav>

    <main>
        <section class="card">
            <h1>All Tasks</h1>
            <p>Every task in the system, ordered by date.</p>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Task Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= esc($task['id']) ?></td>
                            <td><?= esc($task['title']) ?></td>
                            <td>
                                <span class="status">
                                    <?= esc($task['status']) ?>
                                </span>
                            </td>
                            <td>
                                <?= esc(date('F j, Y', strtotime($task['task_date']))) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>