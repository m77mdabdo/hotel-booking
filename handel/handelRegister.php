<?php
require_once "../APP/APP.php";


if (isset($_POST['submit'])) {

    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    // var_dump($_POST);
    $errors = [];
    //valiton 
    //username
    if (empty($username)) {
        $errors[] = "username is requerd";
    } elseif (strlen($username) < 3) {
        $errors[] = "username must be at least 3 characters";
    } elseif (strlen($username) > 50) {
        $errors[] = "username must be at less 50";
    } elseif (preg_match('/[^a-zA-Z0-9\s]/', $username)) {
        $errors[] = "name must not contain special characters";
    }


    // email
    if (empty($email)) {
        $errors[] = "email is  reqired";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "email is not valid";
    } elseif (strlen($email) > 100) {
        $errors[] = "email must be at less 100";
    } elseif (!preg_match('/[^a-zA-Z0-9\s]/', $email)) {
        $errors[] = "email must not contain special characters";
    }


    // password
    if (empty($password)) {
        $errors[] = "password is  reqired";
    } elseif (strlen($password) < 6) {
        $errors[] = "password must be at least 6 characters";
    } elseif (strlen($password) > 100) {
        $errors[] = "password must be at less 100";
    } else if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least one uppercase letter (A-Z)";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least one lowercase letter (a-z)";
    } elseif (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least one digit (0-9)";
    } elseif (!preg_match('/[\W]/', $password)) {
        $errors[] = "Password must contain at least one special character (@, #, $, %, etc.)";
    }

    $password = password_hash(trim(htmlspecialchars($_POST['password'])), PASSWORD_DEFAULT);


    if (empty($errors)) {

        $insert = $conn->prepare("INSERT INTO users (`username`, `email`, `mypassword`) 
                VALUES (:username, :email, :mypassword)");


        $insert->bindParam(':username', $username, PDO::PARAM_STR);
        $insert->bindParam(':email', $email, PDO::PARAM_STR);
        $insert->bindParam(':mypassword', $password, PDO::PARAM_STR);


        if ($insert->execute()) {
            header("location:../auth/login.php");
            exit();
        } else {
            $_SESSION['error'] = $errors;
            header("location:../auth/register.php");
            exit();
        }
    } else {
        $_SESSION['error'] = $errors;
        header("location:../auth/register.php");
        exit();
    }
} else {
    // header('location:../auth/login.php');
}
