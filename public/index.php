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
    <title>Dashboard</title>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6 flex items-center justify-center">
                <div class="bg-gray-800 p-4 rounded">
                    <div class="text-xl font-bold flex text-center justify-center">30</div>
                    <div class="text-gray-400 flex text-center justify-center">Remaining Session</div>
                </div>
                <div class="bg-gray-800 p-4 rounded">
                    <div class="text-xl font-bold flex text-center justify-center">30</div>
                    <div class="text-gray-400 flex text-center justify-center">Remaining Session</div>
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-gray-800 p-4 rounded">
                    <div class="text-xl font-bold mb-4">Total Lab Usage</div>
                    <div class="flex justify-center mb-4">
                        <img alt="Pie chart showing transaction history" height="200" src="https://placehold.co/200x200" width="200"/>
                    </div>
                    <div class="bg-gray-700 p-4 rounded mb-4">
                        <div class="flex justify-between">
                            <div></div>
                            <div></div>
                        </div>
                        <div class="text-gray-400"></div>
                    </div>
                    <div class="bg-gray-700 p-4 rounded">
                        <div class="flex justify-between">
                            <div></div>
                            <div></div>
                        </div>
                        <div class="text-gray-400"></div>
                    </div>
                </div>
                <div class="bg-gray-800 p-4 rounded">
                    <div class="text-xl font-bold mb-4">Annoucements</div>
                    <div class="bg-gray-700 p-4 rounded mb-4">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-blue-500 mr-3"></i>
                                <div>
                                    <div>New Sit-In rules are set.</div>
                                </div>
                            </div>
                            <div class="text-gray-400">15 minutes ago</div>
                        </div>
                    </div>
                    <div class="bg-gray-700 p-4 rounded mb-4">
                        <div class="flex justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-file-alt text-green-500 mr-3"></i>
                                <div>
                                    <div>On March 10, 2025, we are not going to take in sit-ins.</div>
                                </div>
                            </div>
                            <div class="text-gray-400">1 hour ago</div>
                        </div>
                    </div>
                </div>
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