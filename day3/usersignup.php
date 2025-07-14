<?php
session_start();
require '../connect.php';
$errors = [];
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);

    //validation
    if (empty($username)) {
        $errors[] = 'username is required';
    }
    if (empty($password)) {
        $errors[] = 'password is required';
    } else if (strlen($password) < 6) {
        $errors[] = 'password must be at least 6 characters long';
    }
    if (empty($email)) {
        $errors[] = 'email is required';
    } else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors[] = 'invalid email';
    }
    if (empty($errors)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user`(`username`, `password`, `email`) VALUES ('$username', '$password','$email')";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['success'] = "Signup successfully";
            header('Location:./emailform.php');
            exit();

        } else {
            echo "Insert Error: ";
        }

    }
    else if(!empty($errors)) {
        foreach($errors as $err){
            echo $err . "<br>";
        }
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignupT</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <div class="flex  h-screen bg-[#DEDFE1] justify-center items-center">
        <form class="flex flex-col  bg-white p-8 rounded " method="post">
            <label for="username">Name:</label>
            <input class="border rounded " type="name" name="username" id="username">
            <label for="password">password:</label>
            <input class="border rounded " type="password" name="password" id="password">
            <label for="email">email:</label>
            <input class="border rounded " type="email" name="email" id="email">
            <input class="border rounded mt-4 py-1 bg-blue-400 text-white " type="submit" name="submit" id="submit">
        </form>
    </div>
</body>

</html>