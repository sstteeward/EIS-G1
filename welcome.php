<?php
session_start();

if (!isset($_SESSION['email']) || !isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

$dashboard = $_SESSION['role'] === 'admin' ? 'Admin/home.php' : 'Employee/homeemployee.php';
$firstName = htmlspecialchars($_SESSION['firstName']);
?>

<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="welcome.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="assets/LOGO for title.png" />
  <title>Asian College EIS</title>
</head>
<body>

<div class="container">
    <img src="assets\LOGO for title.png" alt="Logo" class="logo" />
    <h1>Welcome, <?php echo $firstName; ?>!</h1>
    <p>You have successfully logged in to the <strong>Employee Information System</strong>.</p>
    <a href="<?php echo $dashboard; ?>" class="btn">Proceed</a>
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

  </script>
</body>
</html>
