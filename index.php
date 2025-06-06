<?php
session_start();
session_destroy(); 

$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
                <option value="" disabled selected>Select Role</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
            </select>
        </div>

        <div class="login hidden" id="login-form">
            <form action="login.php" method="post" autocomplete="off">
                <input type="hidden" name="role" id="role-input">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="login-title">
                    <h2>Login</h2>
                </div>
                <div class="login-input">
                    <input type="text" name="email" placeholder="Email" required>
                </div>
                <div class="login-input">
                    <div class="login-input">
                    <input type="password" name="id" id="id" placeholder="ID" maxlength="20" required onpaste="return false;">
                    <label style="display:block; margin-top:5px;">
                        <input type="checkbox" id="show-id"> Show ID
                    </label>
                </div>
                </div>
                <div class="login-button">
                    <button type="submit" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>

 
    <script>
        const roleSelect = document.getElementById('role-select');
        const loginForm = document.getElementById('login-form');
        const roleInput = document.getElementById('role-input');
        const form = document.querySelector('form');
        const loader = document.getElementById('loader');

        roleSelect.addEventListener('change', function () {
            const selectedRole = this.value;
            if (selectedRole) {
                roleInput.value = selectedRole;
                loginForm.classList.remove('hidden');
            }
        });

        const showIDCheckbox = document.getElementById('show-id');
        const idInput = document.getElementById('id');

        showIDCheckbox.addEventListener('change', function () {
            idInput.type = this.checked ? 'text' : 'password';
        });

        form.addEventListener('submit', function () {
            loader.classList.remove('hidden');
        });

        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

    </script>

</body>
</html>