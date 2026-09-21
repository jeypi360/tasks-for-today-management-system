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

        main {
            width: min(700px, 90%);
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

        dt {
            font-weight: bold;
            margin-top: 18px;
            color: #475569;
        }

        dd {
            margin: 5px 0;
            font-size: 18px;
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
            <h1>Demo User Profile</h1>

            <?php if ($user): ?>
                <dl>
                    <dt>Username</dt>
                    <dd><?= esc($user['username']) ?></dd>

                    <dt>Full Name</dt>
                    <dd><?= esc($user['full_name']) ?></dd>

                    <dt>Email Address</dt>
                    <dd><?= esc($user['email']) ?></dd>

                    <dt>Created At</dt>
                    <dd><?= esc(date('F j, Y g:i A', strtotime($user['created_at']))) ?></dd>
                </dl>
            <?php else: ?>
                <p>No demo user record was found.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>