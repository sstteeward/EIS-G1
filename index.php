<?php
session_start();
$showLogin = false;
$selectedRole = '';

if (isset($_SESSION['login_error'])) {
    $showLogin = true;
    if (isset($_SESSION['last_role'])) {
        $selectedRole = $_SESSION['last_role'];
    }
    unset($_SESSION['login_error']);
    unset($_SESSION['last_role']);
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-store" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asian College EIS</title>
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="assets/LOGO for title.png">
</head>
<body>

    <div>
        <header>
            <div class="logo">
                <img src="assets/logo.png" alt="Asian College Logo">
            </div>
            <div class="title">
                <h1>Asian College EIS</h1>
            </div>
        </header>

        <div class="role-selection">
            <h2>Select Your Role</h2>
            <select id="role-select">
                <option value="" disabled>Select Role</option>
                <option value="admin" <?php if ($selectedRole === 'admin') echo 'selected'; ?>>Admin</option>
                <option value="employee" <?php if ($selectedRole === 'employee') echo 'selected'; ?>>Employee</option>
            </select>
        </div>

        <div class="login <?php echo $showLogin ? '' : 'hidden'; ?>" id="login-form">
            <!-- Show error above email if login failed -->
            <?php if ($showLogin): ?>
                <div class="error-message">Invalid email, ID, or role.</div>
            <?php endif; ?>
            
            <form action="login.php" method="post" autocomplete="off">
                <input type="hidden" name="role" id="role-input" value="<?php echo htmlspecialchars($selectedRole); ?>">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="login-title">
                    <h2>Login</h2>
                </div>
                <div class="login-input">
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="login-input">
                    <input type="password" name="id" id="id" placeholder="ID" maxlength="20" required onpaste="return false;">
                    <label style="display:block; margin-top:5px;">
                        <input type="checkbox" id="show-id"> Show ID
                    </label>
                </div>
                <div class="login-button">
                    <button type="submit" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const roleSelect = document.getElementById('role-select');
            const loginForm = document.getElementById('login-form');
            const roleInput = document.getElementById('role-input');
            const showIDCheckbox = document.getElementById('show-id');
            const idInput = document.getElementById('id');

            // Show login form and set role if previously failed
            <?php if ($showLogin): ?>
                loginForm.classList.remove('hidden');
                roleSelect.value = "<?php echo $selectedRole; ?>";
                roleInput.value = "<?php echo $selectedRole; ?>";
            <?php endif; ?>

            roleSelect.addEventListener('change', function () {
                const selectedRole = this.value;
                if (selectedRole) {
                    roleInput.value = selectedRole;
                    loginForm.classList.remove('hidden');
                }
            });

            showIDCheckbox.addEventListener('change', function () {
                idInput.type = this.checked ? 'text' : 'password';
            });
        });
    </script>

</body>
</html>
