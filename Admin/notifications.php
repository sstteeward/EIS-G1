<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM admin_ ORDER BY employeeID ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="notifications.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/LOGO for title.png">
  <title>Asian College EIS - Notifications</title>
</head>
<body>
  <nav class="top-nav">
    <h2>Asian College EIS Dashboard</h2>
    <img src="assets/logo2-removebg-preview.png" alt="Logo">
    <div class="menu">
      <img id="menuBtn" class="menuBtn" src="assets/menuIcon.png" alt="Menu Button" />
      <ul id="menuItems" class="menuItems">
        <li><a href="home.php">🏠 Home</a></li>
        <li><a href="notifications.php">🔔 Notifications</a></li>
        <li><a href="employee.php">👨‍💼 Employee</a></li>
        <li><a href="addemployee.php">➕ Add New Employee</a></li>
        <li><a href="#" onclick="confirmLogout()">🚪 Logout</a></li>
      </ul>
    </div>
  </nav>

  <div class="notification-container">
    <h1>🔔 Notifications</h1>
    <div class="notification-list">
      <?php while($row = mysqli_fetch_assoc($result)): ?>
  <div class="notification-item">
    <p><strong>New Admin Added</strong></p>
    <p><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?> has been added as Admin.</p>
    <small>
      <?php 
        date_default_timezone_set('Asia/Manila');
        echo isset($row['employeeID']) 
          ? date('m/d/Y g:i:A', strtotime($row['registryDate'] ?? 'now'))
          : 'Date unknown'; 
      ?>
    </small>
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
      menuBtn.src = menuOpen ? 'assets/closeIcon.png' : 'assets/menuIcon.png';
      menuItems.classList.toggle('menuOpen', menuOpen);
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
