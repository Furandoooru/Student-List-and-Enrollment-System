<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .decorative-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            z-index: 0;
        }

        .circle1 {
            width: 300px;
            height: 300px;
            top: -50px;
            left: -50px;
        }
        .circle2 {
            width: 200px;
            height: 200px;
            bottom: -30px;
            right: -30px;
        }

        .dashboard {
            background: white;
            padding: 60px;
            border-radius: 25px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeIn 1.2s ease;
        }
        h1 {
            font-weight: 700;
            margin-bottom: 40px;
            font-size: 36px;
            color: #1e88e5;
        }
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .btn-dashboard {
            font-size: 20px;
            padding: 18px;
            border-radius: 15px;
            background: linear-gradient(45deg, #42a5f5, #478ed1);
            color: white;
            font-weight: bold;
            text-decoration: none;
            transition: transform 0.3s, background 0.3s;
        }
        .btn-dashboard:hover {
            background: linear-gradient(45deg, #1e88e5, #1565c0);
            transform: translateY(-5px);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</head>
<body>

<div class="decorative-circle circle1"></div>
<div class="decorative-circle circle2"></div>

<div class="dashboard">
    <h1>🎓 Welcome to School Dashboard</h1>
    <div class="btn-group">
        <a href="students/index.php" class="btn-dashboard">👩‍🎓 Manage Students</a>
        <a href="courses/index.php" class="btn-dashboard">📚 Manage Courses</a>
        <a href="enrollments/index.php" class="btn-dashboard">📝 Manage Enrollments</a>
        <a href="grades/index.php" class="btn-dashboard">🏆 Manage Grades</a>
    </div>
</div>

</body>
</html>
