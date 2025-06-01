<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "employee");
if (!$conn) die("DB connection failed: " . mysqli_connect_error());

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $employeeID = trim($_POST['id']);
    $role = $_POST['role'];

    if ($email === '' || $employeeID === '' || $role === '') {
        fail();
    }

    if ($role === 'admin') {
        $stmt = mysqli_prepare($conn, "SELECT firstName FROM admin_ WHERE email = ? AND employeeID = ?");
    } elseif ($role === 'employee') {
        $stmt = mysqli_prepare($conn, "SELECT firstName FROM employeeuser WHERE email = ? AND employeeID = ?");
    } else {
        fail();
    }

    mysqli_stmt_bind_param($stmt, "ss", $email, $employeeID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) === 1) {
        mysqli_stmt_bind_result($stmt, $firstName);
        mysqli_stmt_fetch($stmt);

        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['firstName'] = $firstName;

        // Redirect to common welcome page
        header("Location: welcome.php");
        exit();
    } else {
        fail();
    }
} else {
    echo "Invalid request.";
    exit();
}

function fail() {
    echo "<script>
        alert('Invalid email, ID, or role.');
        window.location.href = 'index.php';
    </script>";
    exit();
}
?>
