<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Fayida Number Verification System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .landing {
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(120deg, #002244, #004488);
            color: white;
            min-height: 100vh;
        }
        .landing h1 {
            font-size: 2.8em;
            margin-bottom: 10px;
        }
        .landing p {
            font-size: 1.2em;
            max-width: 600px;
            margin: 0 auto 30px;
        }
        .landing a.button {
            display: inline-block;
            padding: 12px 25px;
            background: #ffffff;
            color: #002244;
            border-radius: 5px;
            font-weight: bold;
            text-decoration: none;
        }
        .landing a.button:hover {
            background: #ddd;
        }
    </style>
</head>
<body>
    <div class="landing">
        <h1>🔍 Fayida Verification System</h1>
        <p>
            A digital system designed for Ethiopian law enforcement to verify individuals using the national digital ID system and manage criminal records securely.
        </p>
        <a class="button" href="login.php">Login to System</a>
    </div>
</body>
</html>
