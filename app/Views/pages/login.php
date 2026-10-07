<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <style>
        body{margin:0;font-family:Arial,sans-serif;background:#f4f7fb;color:#1f2937}
        nav{background:#1e3a5f;padding:18px 8%}
        nav a{color:white;text-decoration:none;margin-right:22px;font-weight:bold}
        main{width:min(700px,90%);margin:45px auto}
        .card{background:white;border-radius:12px;padding:30px;box-shadow:0 4px 14px rgba(0,0,0,.08)}
        h1{margin-top:0;color:#1e3a5f}
        label{display:block;font-weight:bold;margin:18px 0 6px}
        input{box-sizing:border-box;width:100%;padding:11px;border:1px solid #cbd5e1;border-radius:6px;font-size:16px}
        button{margin-top:20px;padding:11px 18px;border:0;border-radius:6px;background:#1e3a5f;color:white;font-weight:bold;cursor:pointer}
        .notice{padding:12px;border-radius:6px;background:#fee2e2;color:#991b1b}
        .success{background:#dcfce7;color:#166534}
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
        <h1>Log In</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <p class="notice"><?= esc(session()->getFlashdata('error')) ?></p>
        <?php endif ?>

        <?php if (session()->getFlashdata('success')): ?>
            <p class="notice success"><?= esc(session()->getFlashdata('success')) ?></p>
        <?php endif ?>

        <p>Log in to create, edit, or delete tasks.</p>

        <form action="/login" method="post">
            <?= csrf_field() ?>
            <label for="username">Username</label>
            <input id="username" name="username" value="<?= esc(old('username')) ?>" required autocomplete="username">

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required autocomplete="current-password">

            <button type="submit">Log In</button>
        </form>
    </section>
</main>
</body>
</html>