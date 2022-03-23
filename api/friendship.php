<!-- code for friend request sent starts here -->
<?php

    if (isset ($_POST['sent'])){
        
        $friend_name = $_POST['friendName'];
        $friend_snug = $_POST['friendSnug'];
        $self_id = $_SESSION['userId'];

        $check = mysqli_query($conn , "SELECT * FROM `request` WHERE fsnug = '$friend_snug' AND senderId='$_SESSION[userId]' AND `status`='request_sent' ");
        $check1 = mysqli_query($conn , "SELECT * FROM `request` WHERE fsnug = '$friend_snug' AND `status`='blocked' AND senderId='$_SESSION[userId]'");

        $result = mysqli_num_rows($check);
        $result1 = mysqli_num_rows($check1);

        if ($result > 0 ) {
            echo "<script>alert('Already request sent!! Search in your friendlist if not showing maybe your friend has not accepted your request till now!!');window.location.href='contact.php'</script>";
        }
        elseif ($result1 > 0 ) {
            $query1 = mysqli_query($conn,"UPDATE `request` SET `status`='request_sent'");
            echo "<script>alert('Request sent');window.location.href='contact.php'</script>";
        }

        else{
           $query2 = mysqli_query($conn, "INSERT INTO  `request` 
           (`senderId`, `friendName`, `fsnug`, `status`)  
           VALUES ('$self_id', '$friend_name','$friend_snug','request_sent')");
            echo "<script>alert('Friend request sent!!');window.location.href='#'</script>"; 
        }

    }
?>


<!-- code for friend request sent endss here -->


<!-- to block friend -->

<?php

    if (isset ($_POST['block'])){
        
        $friend_name = $_POST['friendName'];
        $friend_snug = $_POST['friendSnug'];
        $self_id = $_SESSION['userId'];

        $check2 = mysqli_query($conn , "SELECT * FROM `request` WHERE fsnug = '$friend_snug' AND senderId='$_SESSION[userId]' AND `status`='blocked' ");
        $check3 = mysqli_query($conn , "SELECT * FROM `request` WHERE fsnug = '$friend_snug' AND `status`='request_sent' AND senderId='$_SESSION[userId]'");

        $result2 = mysqli_num_rows($check2);
        $result3 = mysqli_num_rows($check3);

        if ($result2 > 0 ) {

            echo "<script>alert('User alredy blocked!! Search in your blocklist!!');window.location.href='contact.php'</script>";
        }
        elseif ($result3 > 0 ) {
            $query3 = mysqli_query($conn,"UPDATE `request` SET `status`='blocked'");
            echo "<script>alert('User blocked');window.location.href='contact.php'</script>";
        }

        else{
           $query4 = mysqli_query($conn, "INSERT INTO  `request` 
           (`senderId`, `friendName`, `fsnug`, `status`)  
           VALUES ('$self_id', '$friend_name','$friend_snug','request_sent')");
            echo "<script>alert('User blocked');window.location.href='#'</script>"; 
        }

    }
?>

<!-- request pending section code  -->
<?php

    if (isset ($_POST['accept'])){
    $snug= $_POST['snug'];
    $query9 = mysqli_query($conn,"UPDATE request r  
                left join information i on i.signupId = r.senderId 
                left join signup s on r.fSnug = s.snugid
SET status='accepted'
WHERE id ='$_SESSION[userId]' AND `status` = 'request_sent' AND usnugid='$snug'");
        echo "<script>alert('Request accepted');window.location.href='#'</script>";
    }
?>