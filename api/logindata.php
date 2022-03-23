<?php
    include './include/connection.php';

    //sql code to login
    $error = "";
    if (isset ($_POST['userLogin'])) {
        /*echo "Login button pressed";*/

        // code to take data from login page
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = sha1($password);

        // logic to login as customer
        $result = $conn -> query("SELECT * FROM signup WHERE email = '$email' AND password = '$password' AND type = 'customer'");
        if($result -> num_rows > 0) {
            session_start();
            $data = $result -> fetch_assoc();
            $_SESSION['userId'] = $data['id'];
            // $_SESSION['snugId'] = $data['snugid'];
            $_SESSION['user'] = $data[''];
            header('location:customerindex.php');
        }
        else{
            echo '<script>alert("Invalid email or password. Please try again.")</script>';
        }

        // logic to login as shop owner
        $result1 = $conn -> query("SELECT * FROM signup WHERE email = '$email' AND password = '$password' AND type = 'owner'");
        if($result1 -> num_rows > 0) {
            session_start();
            $data = $result1 -> fetch_assoc();
            $_SESSION['userId'] = $data['id'];
            $_SESSION['senderName'] = $data['fullname'];
            $_SESSION['senderSnugId']= $data['snugid'];
            // $_SESSION['snugId'] = $data['snugid'];
            $_SESSION['user'] = $data;
            header('location:ownerindex.php');
        }
        else{
            echo '<script>alert("Invalid email or password. Please try again.")</script>';
        }

        // logic to login as admin
        $result2 = $conn -> query("SELECT * FROM signup WHERE email = '$email' AND password = '$password' AND type = 'admin'");
        if($result2 -> num_rows > 0) {
            session_start();
            $data = $result2 -> fetch_assoc();
            $_SESSION['userId'] = $data['id'];
            // $_SESSION['snugId'] = $data['snugid'];
            $_SESSION['user'] = $data;
            header('location:adminindex.php');
        }
        else{
            echo '<script>alert("Invalid email or password. Please try again.")</script>';
        }

    } 

?>

<!-- $result = $conn -> query("SELECT * FROM signup WHERE email = '$email' AND password = '$password' AND type = 'customer'"); -->