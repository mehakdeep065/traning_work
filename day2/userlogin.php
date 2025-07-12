<?php 
require '../connect.php';
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $sql = "INSERT INTO user (username, password, email) VALUES ('$username', '$password','$email')";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo '<div class="justify-center flex">added data successfully</div>';
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
    <div class="flex  h-screen bg-[#DEDFE1] justify-center items-center">
        <form class="flex flex-col  bg-white p-8 rounded " method="post">
            <label for="username">Name:</label>
            <input class="border rounded " type="name" name = "username" id="username">
            <label for="password">password:</label>
            <input class="border rounded " type="password" name = "password" id="password">
            <label for="email">email:</label>
            <input class="border rounded " type="email" name = "email" id="email">
            <input class="border rounded mt-4 py-1 bg-blue-400 text-white " type="submit" name = "submit" id="submit">
        </form>
    </div>
</body>
</html>
