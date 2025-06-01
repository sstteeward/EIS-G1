<?php 
session_start();
include 'db.php';

date_default_timezone_set('Asia/Manila');

$filter = $_GET['filter'] ?? 'all';
$whereClauses = [];

if ($filter === 'today') {
    $whereClauses[] = "DATE(registryDate) = CURDATE()";
} elseif ($filter === 'week') {
    $whereClauses[] = "YEARWEEK(registryDate, 1) = YEARWEEK(CURDATE(), 1)";
}

if ($filter === 'read') {
    $whereClauses[] = "readStatus = 1";
} elseif ($filter === 'unread') {
    $whereClauses[] = "readStatus = 0";
}

$whereClause = '';
if (!empty($whereClauses)) {
    $whereClause = 'WHERE ' . implode(' AND ', $whereClauses);
}

$adminQuery = "SELECT employeeID, firstName, lastName, registryDate, readStatus, 'Admin' AS role FROM admin_ $whereClause";
$employeeQuery = "SELECT employeeID, firstName, lastName, registryDate, readStatus, 'Employee' AS role FROM employeeuser $whereClause";

$sql = "$adminQuery UNION $employeeQuery ORDER BY registryDate DESC";
$result = mysqli_query($conn, $sql);

function activeClass($filterName, $currentFilter) {
    return $filterName === $currentFilter ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="notifEmp.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/LOGO for title.png">
  <title>Asian College EIS</title>
</head>
<body>
  <nav class="top-nav">
    <h2>Asian College EIS Notifications</h2>
    <img src="assets/logo2-removebg-preview.png" alt="Logo">
    <div class="menu">
      <img id="menuBtn" class="menuBtn" src="assets/menuIcon.png" alt="Menu Button" />
      <ul id="menuItems" class="menuItems">
        <li><a href="homeemployee.php">🏠 Home</a></li>
        <li><a href="notifications.php">🔔 Notifications</a></li>
        <li><a href="employee.php">🧑‍💼 Employee</a></li>
        <li><a href="profileEmp.php">👤 Profile</a></li>
      </ul>
    </div>
  </nav>

  <div class="notification-container">
    <h1>🔔 Notifications</h1>

    <div class="filter-options">
      <a class="<?php echo activeClass('all', $filter); ?>" href="notifications.php?filter=all">📅 All</a>
      <a class="<?php echo activeClass('today', $filter); ?>" href="notifications.php?filter=today">🟢 Today</a>
      <a class="<?php echo activeClass('week', $filter); ?>" href="notifications.php?filter=week">🔵 This Week</a>
      <a class="<?php echo activeClass('read', $filter); ?>" href="notifications.php?filter=read">✅ Read</a>
      <a class="<?php echo activeClass('unread', $filter); ?>" href="notifications.php?filter=unread">🔴 Unread</a>
    </div>

    <div class="notification-list">
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="notification-item <?php echo $row['readStatus'] ? 'read' : 'unread'; ?>">
          <p><strong>New <?php echo htmlspecialchars($row['role']); ?> Added</strong></p>
          <p><?php echo htmlspecialchars($row['firstName'] . ' ' . $row['lastName']); ?> has been added as <?php echo htmlspecialchars($row['role']); ?>.</p>
          <small><?php echo date('m/d/Y g:i A', strtotime($row['registryDate'])); ?></small>

          <form method="POST" action="markNotification.php?filter=<?php echo urlencode($filter); ?>" style="margin-top: 5px;">
            <input type="hidden" name="employeeID" value="<?php echo $row['employeeID']; ?>">
            <input type="hidden" name="role" value="<?php echo $row['role']; ?>">
            <button type="submit" name="toggleRead" class="read-toggle-btn">
              <?php echo $row['readStatus'] ? 'Mark as Unread' : 'Mark as Read'; ?>
            </button>
          </form>
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