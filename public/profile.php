<?php
// Prevent caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.

session_start();

// Check if the user is logged in
if (!isset($_SESSION['login_user'])) {
    header("Location: login.php");
    exit();
}

// Database connection
require __DIR__ . '/../config/db.php';

// Fetch user details
$username = $_SESSION['login_user']; // Assuming the username is stored in the session
$user_sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();
$stmt->close();

// Fetch courses from the courses table
$course_sql = "SELECT * FROM courses"; // Ensure this is the correct table name
$course_result = $conn->query($course_sql);
$courses = [];
if ($course_result->num_rows > 0) {
    while ($row = $course_result->fetch_assoc()) {
        $courses[] = $row; // Store each course in the $courses array
    }
}

// Initialize success message variable
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email');
    $username = filter_input(INPUT_POST, 'username');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $firstname = filter_input(INPUT_POST, 'firstname');
    $middlename = filter_input(INPUT_POST, 'middlename');
    $course = filter_input(INPUT_POST, 'course');
    $level = filter_input(INPUT_POST, 'level');

    // Update user details in the database
    $update_sql = "UPDATE users SET email = ?, username = ?, lastname = ?, firstname = ?, middlename = ?, course = ?, level = ? WHERE idno = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssssss", $email, $username, $lastname, $firstname, $middlename, $course, $level, $user['idno']);

    if ($stmt->execute()) {
        // Set success message
        $successMessage = "Profile updated successfully!";
    } else {
        echo "<script>alert('Error updating profile: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Profile Settings</title>
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
        #successDialog {
            border: none;
            border-radius: 8px;
            background: white;
            color: black;
            padding: 20px;
            width: 300px; 
            text-align: center;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.3);
            position: fixed;
            top: 13%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .modal-content {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        #closeDialog {
            align-self: center; 
            background: #7952b3;
            color: white;
            border: none;
            padding: 8px 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
            width:auto;
            height: auto;
        }
        #closeDialog:hover {
            background: #7952b3;
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
                    <img alt="User  profile picture" class="rounded-full mx-2" height="40" src="https://placehold.co/40x40" width="40"/>
                    <div><?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></div>
                </div>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md center">
                <form method="post">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="id-number">
                            ID Number
                        </label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="id-number" placeholder="ID Number" type="text" value="<?php echo htmlspecialchars($user['idno']); ?>" readonly/>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                            Last Name
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" name="lastname" placeholder="Last Name" type="text" value="<?php echo htmlspecialchars($user['lastname']); ?>"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                            First Name
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" name="firstname" placeholder="First Name" type="text" value="<?php echo htmlspecialchars($user['firstname']); ?>"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="middlename">
                            Middle Name
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="middlename" name="middlename" placeholder="Middle Name" type="text" value="<?php echo htmlspecialchars($user['middlename']); ?>"/>
                    </div>
                    <div class="flex space-x-4 mb-4">
                        <div class="w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="course">
                                Course
                            </label>
                            <div class="relative">
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="course" name="course">
                                    <option value="" disabled>Select Course</option>
                                    <?php foreach ($courses as $course): ?>
                                        <option value="<?php echo htmlspecialchars($course['id']); ?>" <?php echo $user['course'] == $course['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($course['course_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="level">
                                Year Level
                            </label>
                            <div class="relative">
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="level" name="level">
                                    <option value="" disabled>Select Year Level</option>
                                    <option value="1" <?php echo $user['level'] == '1' ? 'selected' : ''; ?>>1</option>
                                    <option value="2" <?php echo $user['level'] == '2' ? 'selected' : ''; ?>>2</option>
                                    <option value="3" <?php echo $user['level'] == '3' ? 'selected' : ''; ?>>3</option>
                                    <option value="4" <?php echo $user['level'] == '4' ? 'selected' : ''; ?>>4</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email Address
                        </label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" placeholder="Email Address" type="email" value="<?php echo htmlspecialchars($user['email']); ?>"/>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Username
                        </label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" name="username" placeholder="Username" type="text" value="<?php echo htmlspecialchars($user['username']); ?>"/>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <div class="relative">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" placeholder="Password" type="password"/>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Save
                        </button>
                        <button class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button" onclick="window.location.href='profile.php'">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success Dialog -->
    <dialog id="successDialog">
        <div class="modal-content">
            <p><?php echo htmlspecialchars($successMessage); ?></p>
            <button id="closeDialog">OK</button>
        </div>
    </dialog>

    <script>
        // Show success dialog if there is a success message
        document.addEventListener("DOMContentLoaded", function () {
            const successMessage = "<?php echo addslashes($successMessage); ?>";
            if (successMessage) {
                const dialog = document.getElementById("successDialog");
                dialog.showModal();
            }

            document.getElementById("closeDialog").addEventListener("click", function () {
                document.getElementById("successDialog").close();
            });
        });

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
        }
    </script>
</body>
</html>