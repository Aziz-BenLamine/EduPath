<?php
session_start(); // Start session to store CAPTCHA

require_once '../../config.php'; // Adjust the path as necessary
require_once '../../controllers/UserController.php';

// Generate CAPTCHA text
function generateCaptcha()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captchaText = substr(str_shuffle($characters), 0, 6); // Generate 6-character CAPTCHA
    $_SESSION['captcha'] = $captchaText; // Store CAPTCHA in session
    return $captchaText;
}

// Validate CAPTCHA
function validateCaptcha($inputCaptcha)
{
    return isset($_SESSION['captcha']) && strtolower($inputCaptcha) === strtolower($_SESSION['captcha']);
}

// Get the database connection
try {
    $database = config::getConnexion();
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

$userController = new UserController($database);
$message = '';
$showRegister = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_GET['action'] ?? '';
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($action === 'login') {
        // Existing login logic without CAPTCHA validation
        $user = $userController->findUserByUsernameAndPassword($username, $password);
        $admin = $userController->findAdminByUsernameAndPassword($username, $password);

        if ($user) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $userController->getUserByUsername($username)['id'];
            header("Location: http://localhost/EduPath/views/Frontoffice/welcomeuser/index.html?username=" . urlencode($username));
            exit;
        } elseif ($admin) {
            header("Location: http://localhost/EduPath/views/BackOffice/dashboard.php");
            exit;
        } else {
            echo "<script>alert('Invalid username or password.')</script>";
        }
    } elseif ($action === 'register') {
        $email = trim($_POST['email'] ?? '');
        $captchaInput = trim($_POST['captcha'] ?? '');

        // CAPTCHA validation for registration
        if (!validateCaptcha($captchaInput)) {
            echo "<script>alert('Invalid CAPTCHA. Please try again.');</script>";
        } elseif (empty($username) || empty($email) || empty($password)) {
            $message = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "Invalid email format.";
        } elseif (strlen($password) < 6) {
            $message = "Password must be at least 6 characters long.";
        } else {
            try {
                $userExists = $userController->userExists($username, $email);
                $adminExists = $userController->adminExists($username, $email);

                if ($userExists || $adminExists) {
                    $message = "A user or admin with this username or email already exists.";
                } else {
                    if (str_ends_with($username, '.admin')) {
                        $userController->createAdmin($username, $email, $password);
                        $message = "Admin registration successful.";
                    } else {
                        $userController->createUser($username, $email, $password);
                        $message = "User registration successful.";
                    }
                }
            } catch (PDOException $e) {
                $message = "Database error: " . $e->getMessage();
            }
        }

        echo "<script>console.log('" . addslashes($message) . "');</script>";
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container <?php echo $showRegister ? 'active' : ''; ?>">
        <div class="form-box login">
            <form action="?action=login" method="POST">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username">
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password">
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
                    <input type="text" name="username" placeholder="Username">
                    <i class='bx bx-user'></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email">
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <label>CAPTCHA: <strong><?php echo generateCaptcha(); ?></strong></label>
                    <input type="text" name="captcha" placeholder="Enter CAPTCHA">
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
        </div>
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn">Register</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
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
                form.addEventListener('submit', function(event) {
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