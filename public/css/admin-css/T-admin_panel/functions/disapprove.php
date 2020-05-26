<?php
session_start();
$conn =  mysqli_connect('localhost','root','','db_capstone');
if(isset($_GET['product'])){
   if(isset($_POST['disapprove'])){
    $id = $_GET['product'];
    $reason = $_POST['reason'];

    $sql = "SELECT * FROM tblproduct where id = $id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        unset($_SESSION['success']);
        $_SESSION['error'] = "Product not found!";
        header('location: .././admin.php');
    }else{
        $sql = "UPDATE tblproduct SET approved=0, requested=0, remarks='$reason' WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
    
        if ($count !==0) {
            $_SESSION['success'] = "Disapproved!";
            unset($_SESSION['error']);
            header('location: .././admin.php');
        } else {    
            $_SESSION['error'] = "Error disapproving!";
            unset($_SESSION['success']);
             header('location: .././admin.php');
        }    
    }
   }else{
        $_SESSION['error'] = "Reason field is required!";
        header('location: .././admin.php');
   }
}else{
    $_SESSION['error'] = "Product not found!";
    header('location: .././admin.php');
}

?>