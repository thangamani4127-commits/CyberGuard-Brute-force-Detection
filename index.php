<?php
session_start();
require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare(
        "SELECT id, username, password, failed_attempts, blocked_until
         FROM users WHERE username = ?"
    );

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $message = "Invalid username or password.";
    } else {

        // Check whether account is temporarily blocked
        if ($user["blocked_until"] !== null &&
            strtotime($user["blocked_until"]) > time()) {

            $message = "Account temporarily blocked. Try again later.";

        } elseif (hash("sha256", $password) === $user["password"]) {

            // Successful login — reset failed attempts
            $reset = $conn->prepare(
                "UPDATE users SET failed_attempts = 0, blocked_until = NULL
                 WHERE id = ?"
            );
            $reset->bind_param("i", $user["id"]);
            $reset->execute();

            $_SESSION["username"] = $user["username"];

            $message = "Login successful! Welcome to CyberGuard.";

        } else {

            // Failed login
            $attempts = $user["failed_attempts"] + 1;

            if ($attempts >= 5) {

                $blocked_until = date(
                    "Y-m-d H:i:s",
                    time() + 300
                );

                $block = $conn->prepare(
                    "UPDATE users
                     SET failed_attempts = ?, blocked_until = ?
                     WHERE id = ?"
                );

                $block->bind_param(
                    "isi",
                    $attempts,
                    $blocked_until,
                    $user["id"]
                );

                $block->execute();

                $message = "Too many failed attempts. Account blocked for 5 minutes.";

            } else {

                $update = $conn->prepare(
                    "UPDATE users SET failed_attempts = ?
                     WHERE id = ?"
                );

                $update->bind_param(
                    "ii",
                    $attempts,
                    $user["id"]
                );

                $update->execute();

                $remaining = 5 - $attempts;

                $message = "Invalid password. Attempts remaining: $remaining";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CyberGuard Login</title>
</head>

<body>

    <h1>🛡️ CyberGuard</h1>

    <h2>Brute Force Attack Detection System</h2>

    <hr>

    <h3>Login</h3>

    <?php if ($message !== ""): ?>
        <p><strong><?php echo htmlspecialchars($message); ?></strong></p>
    <?php endif; ?>

    <form method="POST">

        <label>Username:</label><br>
        <input type="text" name="username" required>

        <br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required>

        <br><br>

        <button type="submit">Login</button>

    </form>

</body>
</html>