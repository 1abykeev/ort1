<!-- resources/views/user/profile.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            padding: 20px;
        }
        .toggle-section {
            margin-bottom: 20px;
        }
        .toggle-header {
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            margin: 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .toggle-content {
            display: none;
            padding: 10px;
            border-top: 1px solid #ccc;
            border-radius: 0 0 5px 5px;
            background-color: #fff;
        }
        .toggle-header:after {
            content: '\25BC';
            font-size: 12px;
            transition: transform 0.2s ease-in-out;
        }
        .toggle-header.active:after {
            transform: rotate(-180deg);
        }
        .info p, .course-content p {
            margin: 10px 0;
        }
        .info span, .course-content span {
            font-weight: bold;
        }
        .logout-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, {{ $user->name }}!</h1>

        <div class="toggle-section">
            <div class="toggle-header">User Information</div>
            <div class="toggle-content info">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Surname:</strong> {{ $user->surname }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Grade Level:</strong> {{ $user->grade_level }}</p>
                <p><strong>Number:</strong> {{ $user->number }}</p>
                <p><strong>School:</strong> {{ $user->school }}</p>
                <p><strong>Location:</strong> {{ $user->location }}</p>
                <a href="{{ url('edit/'.$user->id)}}" class="logout-btn">Edit</a>
            </div>
        </div>

        <div class="toggle-section">
            <div class="toggle-header">Course Content</div>
            <div class="toggle-content course-content">
                <p><span>1. Topic:</span> Fractions</p>
                <iframe src="https://drive.google.com/file/d/1EHSOmb2P_msMjckiKIJHSZrRBPO95Gn5/preview" width="600" height="480"></iframe>
                <p><span>2. Topic:</span> Powers and Exponents</p>
                <p><span>3. Topic:</span> Algebra Basics</p>
                <p><span>4. Topic:</span> Geometry Foundations</p>
                <p><span>5. Topic:</span> Probability and Statistics</p>
            </div>
        </div>

        <a href="/" class="logout-btn">Logout</a>
    </div>

    <script>
        // JavaScript to handle the toggle functionality
        document.querySelectorAll('.toggle-header').forEach(header => {
            header.addEventListener('click', () => {
                const content = header.nextElementSibling;
                header.classList.toggle('active');
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
</body>
</html>
