<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Add some basic styling for better visuals -->
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }
        h1 {
            margin-bottom: 20px;
        }
        p {
            margin-bottom: 30px;
            color: #333;
        }
        .buttons {
            display: flex;
            gap: 10px;
        }
        .buttons a {
            text-decoration: none;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .login-btn {
            background-color: #4CAF50;
        }
        .register-btn {
            background-color: #2196F3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Platform</h1>
        <p>Your journey to knowledge and excellence starts here. Join us today and explore endless possibilities.</p>
        <div class="buttons">
            <a href="/login" class="login-btn">Login</a>
            <a href="/register" class="register-btn">Register</a>
        </div>
    </div>
</body>
</html>
