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
        main{width:min(700px,90%);margin:45px auto}
        .card{background:white;border-radius:12px;padding:30px;box-shadow:0 4px 14px rgba(0,0,0,.08)}
        h1{margin-top:0;color:#1e3a5f}
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
            <h1>About This System</h1>
            <p>Tasks for Today Management System helps display and organize daily task information.</p>
            <p>
                This system was developed by <strong>John Patrick Jacinto</strong>,
                a <strong>BSITWMA student</strong> currently taking
                <strong>IT0049: Web System Technologies</strong>.
            </p>
        </section>
    </main>
</body>
</html>