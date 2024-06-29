<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email_id = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    

    // Fetch user from database
    $sql = "SELECT * FROM users WHERE email_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password']) && $user['role'] == $role) {
            // Password correct and role matches, start session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect to appropriate dashboard based on role
            switch ($role) {
                case 'passenger':
                    header("Location: dashboard.html");
                    break;
                    case 'staff':
                        header("Location: ../train-staff/index.php");
                        break;
                    
                case 'admin':
                    header("Location: administrator.php");
                    break;
                default:
                    die("Unknown role");
            }
            exit();
        }else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>
