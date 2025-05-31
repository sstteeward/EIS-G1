<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

date_default_timezone_set('Asia/Manila');
$email = $_SESSION['email'];

$query = "SELECT firstName FROM admin_ WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($firstName);
$name = $stmt->fetch() ? $firstName : '';
$stmt->close();

$totalAdmins = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM admin_"))['total'];
$totalEmployees = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM employeeuser"))['total'];

$recentQuery = "
    SELECT firstName, lastName, registryDate, 'Admin' AS role FROM admin_
    UNION
    SELECT firstName, lastName, registryDate, 'Employee' AS role FROM employeeuser
    ORDER BY registryDate DESC
    LIMIT 5
";
$recentResult = mysqli_query($conn, $recentQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="home.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/LOGO for title.png">
  <title>Asian College EIS Admin</title>
</head>
<body>
  <nav class="top-nav">
    <h2>Asian College EIS Admin Home</h2>
    <img src="assets/logo2-removebg-preview.png" alt="Logo">
    <div class="menu">
      <img id="menuBtn" class="menuBtn" src="assets/menuIcon.png" alt="Menu Button" />
      <ul id="menuItems" class="menuItems">
        <li><a href="home.php">🏠 Home</a></li>
        <li><a href="notifications.php">🔔 Notifications</a></li>
        <li><a href="employee.php">🧑‍💼 Employee</a></li>
        <li><a href="addemployee.php">➕ Add New User</a></li>
        <li><a href="profile.php">👤 Profile</a></li>
      </ul>
    </div>
  </nav>

  <div class="dashboard">
    <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>

    <div class="stats">
      <div class="card">
        <h2><?php echo $totalAdmins; ?></h2>
        <p>Total Admins</p>
      </div>
      <div class="card">
        <h2><?php echo $totalEmployees; ?></h2>
        <p>Total Employees</p>
      </div>
    </div>

    <div class="quick-actions">
      <a href="addemployee.php">➕ Add New Employee</a>
      <a href="employee.php">👨‍💼 View Employees</a>
      <a href="notifications.php">🔔 View Notifications</a>
    </div>

    <div class="recent">
      <h3>🕒 Recent Activity</h3>
      <?php while($row = mysqli_fetch_assoc($recentResult)): ?>
        <div class="recent-item">
          <p><strong><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?></strong> added as <?php echo $row['role']; ?></p>
          <small><?php echo date('m/d/Y g:i A', strtotime($row['registryDate'])); ?></small>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <script>
    const menuBtn = document.getElementById('menuBtn');
    const menuItems = document.getElementById('menuItems');

    let menuOpen = false;

    menuBtn.addEventListener('click', () => {
      menuOpen = !menuOpen;
      if (menuOpen) {
        menuBtn.src = 'assets/closeIcon.png'; 
        menuItems.classList.add('menuOpen');
      } else {
        menuBtn.src = 'assets/menuIcon.png'; 
        menuItems.classList.remove('menuOpen');
      }
    });

    menuItems.addEventListener('click', () => {
      menuOpen = false;
      menuBtn.src = 'assets/menuIcon.png';
      menuItems.classList.remove('menuOpen');
    });

    function confirmLogout() {
      if (confirm("Are you sure you want to logout?")) {
        window.location.href = "logout.php";
      }
    }
  </script>
</body>
</html>