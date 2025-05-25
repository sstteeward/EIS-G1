<?php 
include 'db.php';

if (isset($_POST['submit'])) {
    $imagePath = null;

    if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $imgName = basename($_FILES['picture']['name']);
        $tmpName = $_FILES['picture']['tmp_name'];
        $uploadDir = "uploads/";
        $imagePath = $uploadDir . time() . "_" . $imgName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (!move_uploaded_file($tmpName, $imagePath)) {
            echo "Failed to upload the image.";
            exit();
        }
    }

    $employeeID = $_POST['id'];
    $firstName = ucfirst(strtolower($_POST['firstName']));
    $middleName = ucfirst(strtolower($_POST['middleName']));
    $lastName = ucfirst(strtolower($_POST['lastName']));
    $email = $_POST['email'];
    $position = ucfirst(strtolower($_POST['position']));
    $sex = $_POST['sex'];
    $role = $_POST['role'];

    if ($role == "Employee") {
        $insert = mysqli_query($conn, "INSERT INTO employeeuser (picture, employeeID, firstName, middleName, lastName, email, position, sex) 
                                       VALUES ('$imagePath', '$employeeID', '$firstName','$middleName','$lastName', '$email', '$position', '$sex')");
    } elseif ($role == "Admin") {
        $fullName = $firstName . ' ' . $middleName . ' ' . $lastName;
        $insert = mysqli_query($conn, "INSERT INTO admin_ (picture, employeeID, firstName, middleName, lastName, email, position, sex) 
                                       VALUES ('$imagePath', '$employeeID', '$firstName','$middleName','$lastName', '$email', '$position', '$sex')");
    } else {
        echo "Invalid role selected.";
        exit();
    }

    if ($insert) {
        header("Location: employee.php");
        exit();
    } else {
        echo "Error inserting: " . mysqli_error($conn);
    }
} else {
    echo "Invalid form submission.";
}
?>