<?php
require_once '../../config.php'; // Adjust the path as necessary
require_once '../../controllers/ProfessorController.php';

// Enable error reporting (for debugging purposes during development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the database connection using the function from config.php
try {
    $database = getDatabaseConnection();
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

$professorController = new ProfessorController($database);
$message = '';
$showRegister = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_GET['action'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $email = trim(strtolower($_POST['email'] ?? '')); // Normalize email to lowercase
    $password = trim($_POST['password'] ?? '');
    $department = trim($_POST['courses'] ?? '');

    if ($action === 'login') {
        // Login logic
        try {
            $professor = $professorController->findProfessorByNameAndPassword($username, $password);

            if ($professor) {
                header("Location: welcomeuser\index.php?username=" . urlencode($username)); // Redirect to user page
                exit;
            } else {
                $message = "Invalid username or password.";
                echo "<script>alert('$message');</script>";
            }
        } catch (Exception $e) {
            $message = "Login error: " . $e->getMessage();
            echo "<script>alert('$message');</script>";
        }
    } elseif ($action === 'register') {
        // Registration logic
        if (empty($username) || empty($email) || empty($password) || empty($department)) {
            $message = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format.";
        } elseif (strlen($password) < 6) {
            $message = "Password must be at least 6 characters long.";
        } else {
            try {
                // Check if the professor already exists
                $professorExists = $professorController->professorExists($username, $email);

                if ($professorExists) {
                    $message = "A professor with this username or email already exists.";
                } else {
                    // Create the professor
                    $professorController->createProfessor($username, $email, $password, $department);
                    $message = "Professor registration successful.";
                }
            } catch (PDOException $e) {
                $message = "Database error: " . $e->getMessage();
            }
        }

        // Display the message as an alert
        echo "<script>alert('" . addslashes($message) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="container <?php echo $showRegister ? 'active' : ''; ?>">
        <div class="form-box login">
            <form action="?action=login" method="POST">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" >
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" >
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="forgot-link">
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
        <div class="form-box register">
            <form action="?action=register" method="POST">
                <h1>Registration</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Professor's name" >
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" >
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" >
                    <i class='bx bxs-lock-alt'></i>
                </div>
        <div class="input-box">
        <label for="courses">Select Course:</label>
        <div class="select-wrapper">
        <select name="courses" id="courses" required>
            <option value="" disabled selected>Select a course</option>
            <option value="mathematics">Mathematics</option>
            <option value="arabic">Arabic</option>
            <option value="french">French</option>
            <option value="experimental_science">Experimental Science</option>
            <option value="physiques">Physiques</option>
            <option value="philosophy">Philosophy</option>
            <option value="computer_science">Computer Science</option>
        </select>
        </div>
    </div>
                <button type="submit" class="btn">Register</button>
            </form>
        </div>
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Professor!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back</h1>
                <h1>Professor!</h1>
                <p>Already have an account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>
    <script>
   document.addEventListener('DOMContentLoaded', () => {
    const showRegister = <?php echo json_encode($showRegister); ?>;

    // Toggle forms
    const container = document.querySelector('.container');
    const registerBtn = document.querySelector('.register-btn');
    const loginBtn = document.querySelector('.login-btn');

    if (registerBtn && loginBtn) {
        registerBtn.addEventListener('click', () => {
            container.classList.add('active');
            console.log('Switched to registration form.');
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove('active');
            console.log('Switched to login form.');
        });
    }

    // Form validation
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (event) {
            const usernameField = form.querySelector('input[name="username"]');
            const emailField = form.querySelector('input[name="email"]');
            const passwordField = form.querySelector('input[name="password"]');

            const username = usernameField ? usernameField.value.trim() : '';
            const email = emailField ? emailField.value.trim() : '';
            const password = passwordField ? passwordField.value.trim() : '';

            let valid = true; // Flag to track if all inputs are valid

            // Validate username
            if (!username) {
                console.error('Error: Username is required.');
                alert('Username is required.');
                valid = false;
            }

            // Validate email (only for forms with email input)
            if (emailField && (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))) {
                console.error('Error: Please enter a valid email address.');
                alert('Please enter a valid email address.');
                valid = false;
            }

            // Validate password
            if (!password || password.length < 6) {
                console.error('Error: Password must be at least 6 characters long.');
                alert('Password must be at least 6 characters long.');
                valid = false;
            }

            // Prevent form submission if any validation failed
            if (!valid) {
                event.preventDefault();
            }
        });
    });

    // Show register form if flag is true
    if (showRegister) {
        container.classList.add('active');
        console.log('Showing registration form as default.');
    }
});
    </script>
</body>
</html>
