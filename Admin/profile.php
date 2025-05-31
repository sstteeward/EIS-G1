<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];
$role = $_SESSION['role'];

$allowed_roles = ['admin', 'employee'];
if (!in_array($role, $allowed_roles)) {
    header("Location: logout.php");
    exit();
}

$table = $role === 'admin' ? 'admin_' : 'employeeuser';

$query = "SELECT * FROM $table WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$fields = ['firstName', 'middleName', 'lastName', 'email', 'employeeID', 'role', 'position', 'registryDate', 'status', 'contactNumber', 'address', 'picture'];
$completed = 0;

foreach ($fields as $field) {
    $user[$field] = isset($user[$field]) ? trim($user[$field]) : '';

    if (in_array($field, ['firstName', 'middleName', 'lastName', 'address'])) {
        $user[$field] = ucwords(strtolower($user[$field]));
    }

    if (!empty($user[$field])) {
        $completed++;
    }
}

$completion = round(($completed / count($fields)) * 100);

$filename = !empty($user['picture']) ? $user['picture'] : 'default.png';
$profilePic = 'uploads/' . basename($filename);

$fullName = trim($user['firstName'] . ' ' . ($user['middleName'] ? $user['middleName'] . ' ' : '') . $user['lastName']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="profile.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="assets/LOGO for title.png" />
  <title>Asian College EIS Admin</title>
</head>
<body>
  <nav class="top-nav">
    <h2>Asian College EIS Admin Profile</h2>
    <img src="assets/logo2-removebg-preview.png" alt="Logo" />
    <div class="menu">
      <img id="menuBtn" class="menuBtn" src="assets/menuIcon.png" alt="Menu Button" role="button" aria-label="Toggle navigation menu" />
      <ul id="menuItems" class="menuItems">
        <li><a href="home.php">🏠 Home</a></li>
        <li><a href="notifications.php">🔔 Notifications</a></li>
        <li><a href="employee.php">🧑‍💼 Employee</a></li>
        <li><a href="addemployee.php">➕ Add New User</a></li>
        <li><a href="profile.php">👤 Profile</a></li>
      </ul>
    </div>
</nav>
<h1 style="margin-top: 6rem; text-align: center;">My Profile</h1>
  <div class="profile-container" style="margin: 2rem auto; max-width: 800px; padding: 20px; border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
  <div class="profile-box">
      <div class="profile-picture">
        <img src="<?php echo htmlspecialchars($profilePic); ?>" alt="Profile Picture" />
      </div>
      <div class="profile-details">
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($fullName); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Employee ID:</strong> <?php echo htmlspecialchars($user['employeeID']); ?></p>
        <p><strong>Role:</strong> <?php echo ucfirst(htmlspecialchars($role)); ?></p>
        <p><strong>Position:</strong> <?php echo htmlspecialchars($user['position']); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($user['status']); ?></p>
        <p><strong>Date Joined:</strong> <?php echo htmlspecialchars(date("F d, Y", strtotime($user['registryDate']))); ?></p>
        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($user['contactNumber']); ?></p>
        <p><strong>Address:</strong> <?php echo !empty($user['address']) ? htmlspecialchars($user['address']) : 'N/A'; ?></p>
      </div>
    </div>

    <div class="profile-actions">
      <a href="editProfile.php" class="btn">✏️ Edit Profile</a>
      <a href="logout.php" class="btn btn-logout">🚪 Logout</a>
    </div>

    <div class="profile-meter">
      <p>Profile Completion: <?php echo $completion; ?>%</p>
      <div class="meter">
        <div class="meter-fill" style="width: <?php echo $completion; ?>%;"></div>
      </div>
    </div>
  </div>

  <script>
    const menuBtn = document.getElementById('menuBtn');
    const menuItems = document.getElementById('menuItems');
    let menuOpen = false;

    menuBtn.addEventListener('click', () => {
      menuOpen = !menuOpen;
      menuBtn.src = menuOpen ? 'assets/closeIcon.png' : 'assets/menuIcon.png';
      menuItems.classList.toggle('menuOpen', menuOpen);
    });

    menuItems.addEventListener('click', () => {
      menuOpen = false;
      menuBtn.src = 'assets/menuIcon.png';
      menuItems.classList.remove('menuOpen');
    });

    // Animate meter-fill width smoothly
    window.addEventListener('DOMContentLoaded', () => {
      const meterFill = document.querySelector('.meter-fill');
      const width = meterFill.style.width;
      meterFill.style.width = '0%';
      setTimeout(() => {
        meterFill.style.width = width;
      }, 50);
    });
  </script>
</body>
</html>
