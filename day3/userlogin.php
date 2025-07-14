<?php
require '../connect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM `user` WHERE `email`='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Check password (assuming it's hashed in DB)
        if (password_verify($password, $row['password'])) {
            echo '<div class="p-4 bg-green-100 text-green-800 mb-4 rounded">Login successful!</div>';
        } else {
            echo '<div class="p-4 bg-red-100 text-red-800 mb-4 rounded">Invalid password.</div>';
        }
    } else {
        echo '<div class="p-4 bg-red-100 text-red-800 mb-4 rounded">User not found.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="flex h-screen bg-[#DEDFE1] justify-center items-center">
        <form class="flex flex-col bg-white p-8 rounded" method="post">
            <label for="email">Email:</label>
            <input class="border rounded" type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input class="border rounded" type="password" name="password" id="password" required>
            <input class="border rounded mt-4 py-1 bg-blue-400 text-white" type="submit" name="submit" value="Login">
        </form>
    </div>
</body>
</html>