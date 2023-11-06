<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Add Bootstrap CSS Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Custom CSS for the profile page */
        .cover-photo {
            background-image: url('https://via.placeholder.com/800x200'); /* Sample cover photo URL */
            background-size: cover;
            height: 200px;
        }

        .profile-photo {
            border: 4px solid #fff;
            border-radius: 50%;
            margin-top: -100px;
            width: 150px;
            height: 150px;
        }

        .profile-name {
            font-size: 24px;
            font-weight: bold;
        }

        .profile-description {
            font-size: 16px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="cover-photo"></div>
    <div class="container text-center mt-5">
        <img src="https://via.placeholder.com/150" alt="Profile Photo" class="profile-photo"> <!-- Sample profile photo URL -->
        <h1 class="profile-name">John Doe</h1>
        <p class="profile-description">Web Developer | OpenAI Enthusiast | Coding Enthusiast</p>
    </div>

    <!-- Add Bootstrap JS and jQuery Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
