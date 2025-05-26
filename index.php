<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/LOGO for title.png">
  <title>Asian College EIS - Login</title>
</head>

<body>
  <div class="container">
    <header>
      <div class="logo">
        <img src="assets/logo.png" alt="Asian College Logo">
      </div>
      <div class="title">
        <h1>Asian College EIS</h1>
        <p>Employee Information System</p>
      </div>
    </header>

    <main class="login-section">
      <form action="login.php" method="post" class="login-form">
        <h2>Login</h2>

        <div class="form-group">
          <label for="role">Role</label>
          <select name="role" id="role" required>
            <option value="" disabled selected>Select your role</option>
            <option value="admin">Admin</option>
            <option value="employee">Employee</option>
          </select>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required placeholder="Enter your email">
        </div>

        <div class="form-group">
          <label for="id">Employee ID</label>
          <input type="text" name="id" id="id" required placeholder="Enter your ID" maxlength="20">
        </div>

        <div class="form-group">
          <button type="submit" name="login">🔐 Login</button>
        </div>
      </form>
    </main>
  </div>
</body>

</html>