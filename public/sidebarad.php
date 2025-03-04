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
body { font-family: "Poppins-Regular"; color: #333; font-size: 16px; margin: 0; }
.sidebar {
    width: 5rem;
    transition: all 0.3s ease-in-out;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto; /* Allows scrolling */
    scrollbar-width: none; /* Hides scrollbar in Firefox */
}

.sidebar::-webkit-scrollbar {
    display: none; /* Hides scrollbar in Chrome, Safari, and Edge */
}

    i.fas.fa-home.mr-3, i.fas.fa-bullhorn.mr-3, i.fas.fa-file-alt.mr-3, i.fas.fa-chair.mr-3, i.fas.fa-flask.mr-3, i.fas.fa-calendar-alt.mr-3, i.fas.fa-clock.mr-3 {
        font-size: 16px;
    }
    .sidebar:hover {
        width: 16rem; /* Expanded width */
    }
    .sidebar:hover .sidebar-text {
        display: inline;
    }
    .sidebar-text {
        display: none;
    }
    .sidebar a {
        display: flex;
        align-items: center;
        justify-content: center; /* Centers the icons */
        padding: 1rem;
    }
    .sidebar:hover a {
        justify-content: flex-start; /* Aligns text to the left on hover */
    }
    .sidebar i {
        font-size: 16px; /* Slightly larger icons */
    }
    .dropdown-content {
        display: none;
        margin-left: 2rem;
    }
    .dropdown:hover .dropdown-content {
        display: block;
    }

        .dropdown-hidden {
            display: none;
        }
        .sidebar {
    width: 5rem;
    transition: all 0.3s ease-in-out;
    height: 100vh;
    position: fixed; /* Fixed position */
    top: 0;
    left: 0;
    overflow-y: auto; /* Allows scrolling if content is longer */
}

    </style>
</head>
<body>
<!-- sidebar.php -->
<div class="sidebar bg-[#002044] text-white w-300 hover:w-100 flex flex-col items-center py-8 transition-all duration-300">
    <img alt="CCS Sit-In Monitoring System Logo" class="mb-4" height="70" src="inc/CCS_LOGO.png" width="70"/>
    <h1 class="text-center text-sm sidebar-text">CCS Sit-In Monitoring System</h1>
    <nav class="mt-10 w-full">
        <a class="flex items-center py-2 px-4 text-white hover:bg-blue-700 rounded w-full" href="adminIndex.php">
            <i class="fas fa-home mr-3"></i> <span class="sidebar-text">Home</span>
        </a>
        <a class="flex items-center py-2 px-4 text-white hover:bg-blue-700 rounded w-full" href="Csitin.php">
            <i class="fas fa-chair mr-3"></i> <span class="sidebar-text">Sit-In</span>
        </a>
        <a class="flex items-center py-2 px-4 text-white hover:bg-blue-700 rounded w-full" href="students.php">
            <i class="fas fa-users mr-3"></i> <span class="sidebar-text">Students</span>
        </a>
        <a class="flex items-center py-2 px-4 text-white hover:bg-blue-700 rounded w-full" href="records.php">
            <i class="fas fa-file-alt mr-3"></i> <span class="sidebar-text">Sit-In Records</span>
        </a>
        <a class="flex items-center py-2 px-4 text-white hover:bg-blue-700 rounded w-full" href="report.php">
            <i class="fas fa-clipboard-list mr-3"></i> <span class="sidebar-text">Sit-In Report</span>
        </a>
        <a class="flex items-center py-2 px-4 text-white hover:bg-blue-700 rounded mt-2 w-full" href="Cannouncement.php">
            <i class="fas fa-bullhorn mr-3"></i> <span class="sidebar-text">Announcements</span>
        </a>
        <a class="flex items-center py-2 px-4 text-white hover:bg-blue-700 rounded mt-2 w-full" href="feedback.php">
            <i class="fas fa-user-check mr-3"></i> <span class="sidebar-text">Feedback Report</span>
        </a>
        <a class="flex items-center py-2 px-4 text-white hover:bg-blue-700 rounded mt-2 w-full" href="reservation.php">
            <i class="fas fa-calendar-alt mr-3"></i> <span class="sidebar-text">Reservations</span>
        </a>
        <a class="flex items-center py-2 px-4 text-white hover:bg-blue-700 rounded mt-2 w-full" href="logs.php">
            <i class="fas fa-clock mr-3"></i> <span class="sidebar-text">Logs</span>
        </a>
    </nav>
</div>
</html>