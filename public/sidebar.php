<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/index.css">
    <title>sidebar</title>
    <style>
        .dropdown-hidden {
            display: none;
        }

    </style>
</head>
<body>
<div id="sidebar" class="w-64 bg-gray-800 h-screen p-4 transition-transform duration-300">
    <div class="flex items-center mb-8">
        <div class="text-2xl font-bold">CCS SIT-IN</div>
    </div>
    <div class="flex items-center mb-8">
        <img alt="User profile picture" class="rounded-full mr-4" height="40" src="https://placehold.co/40x40" width="40"/>
        <div>
            <div class="font-bold">Henry Klein</div>
            <div class="text-sm text-gray-400">Student</div>
        </div>
    </div>
    <nav>
        <ul>
            <li class="mb-4">
                <a class="flex items-center text-gray-400 hover:text-white" href="index.php">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Home
                </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center text-gray-400 hover:text-white" href="announcement.php">
                    <i class="fas fa-table mr-3"></i>
                    Announcements
                </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center text-gray-400 hover:text-white cursor-pointer" id="rules-toggle">
                    <i class="fas fa-layer-group mr-3"></i>
                    Rules and Regulation
                </a>
                <ul class="dropdown-hidden ml-8 mt-2" id="rules-dropdown">
                    <li class="mb-2">
                        <a class="flex items-center text-gray-400 hover:text-white" href="sitin.php">
                            <i class="fas fa-circle mr-3 text-xs"></i>
                            SitIn
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="flex items-center text-gray-400 hover:text-white" href="laboratory.php">
                            <i class="fas fa-circle mr-3 text-xs"></i>
                            Laboratory
                        </a>
                    </li>
                </ul>
            </li>
            <li class="mb-4">
                <a class="flex items-center text-gray-400 hover:text-white" href="reservation.php">
                    <i class="fas fa-table mr-3"></i>
                    Reservation
                </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center text-gray-400 hover:text-white" href="history.php">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Sit-In History
                </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center text-gray-400 hover:text-white" href="profile.php">
                    <i class="fas fa-user mr-3"></i>
                    Profile Settings
                </a>
            </li>
            <li class="mb-4">
                <a class="flex items-center text-gray-400 hover:text-white" href="logout.php">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </a>
            </li>
        </ul>
    </nav>
</div>
<script>
    document.getElementById('rules-toggle').addEventListener('click', function () {
        document.getElementById('rules-dropdown').classList.toggle('dropdown-hidden');
    });
  </script>
</body>
</html>