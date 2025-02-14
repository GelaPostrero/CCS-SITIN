<?php
// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.
?>
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit();
}
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sit-In</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/index.css">
    <style>
        .sidebar-hidden {
            transform: translateX(-100%);
        }
        .main-content-expanded {
            width: 100%;
        }
        .hidden {
            display: none;
        }

        .dropdown-hidden {
            display: none;
        }

    </style>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar-container"></div>
        <!-- Main Content -->
        <div id="main-content" class="flex-1 p-6 transition-all duration-300">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <button id="burger" class="text-gray-400 mr-4">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-bell text-gray-400 mx-2"></i>
                    <img alt="User profile picture" class="rounded-full mx-2" height="40" src="https://placehold.co/40x40" width="40"/>
                    <div>Henry Klein</div>
                </div>
            </div>
            <div>
            University of Cebu
COLLEGE OF INFORMATION & COMPUTER STUDIES


LABORATORY RULES AND REGULATIONS

To avoid embarrassment and maintain camaraderie with your friends and superiors at our laboratories, please observe the following:

1. Maintain silence, proper decorum, and discipline inside the laboratory. Mobile phones, walkmans and other personal pieces of equipment must be switched off.

2. Games are not allowed inside the lab. This includes computer-related games, card games and other games that may disturb the operation of the lab.

3. Surfing the Internet is allowed only with the permission of the instructor. Downloading and installing of software are strictly prohibited.

4. Getting access to other websites not related to the course (especially pornographic and illicit sites) is strictly prohibited.

5. Deleting computer files and changing the set-up of the computer is a major offense.

6. Observe computer time usage carefully. A fifteen-minute allowance is given for each use. Otherwise, the unit will be given to those who wish to "sit-in".

7. Observe proper decorum while inside the laboratory.

Do not get inside the lab unless the instructor is present.
All bags, knapsacks, and the likes must be deposited at the counter.
Follow the seating arrangement of your instructor.
At the end of class, all software programs must be closed.
Return all chairs to their proper places after using.
8. Chewing gum, eating, drinking, smoking, and other forms of vandalism are prohibited inside the lab.

9. Anyone causing a continual disturbance will be asked to leave the lab. Acts or gestures offensive to the members of the community, including public display of physical intimacy, are not tolerated.

10. Persons exhibiting hostile or threatening behavior such as yelling, swearing, or disregarding requests made by lab personnel will be asked to leave the lab.

11. For serious offense, the lab personnel may call the Civil Security Office (CSU) for assistance.

12. Any technical problem or difficulty must be addressed to the laboratory supervisor, student assistant or instructor immediately.


DISCIPLINARY ACTION

First Offense - The Head or the Dean or OIC recommends to the Guidance Center for a suspension from classes for each offender.
Second and Subsequent Offenses - A recommendation for a heavier sanction will be endorsed to the Guidance Center.
            </div>
        </div>
    </div>
    <script>
    fetch('sidebar.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('sidebar-container').innerHTML = data;
            addSidebarListeners();
        });

    function addSidebarListeners() {
        document.getElementById('burger').addEventListener('click', function () {
            let sidebar = document.getElementById('sidebar');
            let mainContent = document.getElementById('main-content');

            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden'); 
                mainContent.classList.remove('w-full'); 
            } else {
                sidebar.classList.add('hidden'); 
                mainContent.classList.add('w-full'); 
            }
        });

        // Ensure the dropdown script runs after sidebar is loaded
        setTimeout(() => {
            let rulesToggle = document.getElementById('rules-toggle');
            let rulesDropdown = document.getElementById('rules-dropdown');

            if (rulesToggle && rulesDropdown) {
                rulesToggle.addEventListener('click', function () {
                    rulesDropdown.classList.toggle('dropdown-hidden');
                });
            }
        }, 500); // Adding a slight delay to ensure elements are present
    }
</script>

</body>
</html>