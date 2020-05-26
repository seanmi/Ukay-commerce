<?php
session_start();
$conn =  mysqli_connect('localhost','root','','db_capstone');
if(isset($_GET['product'])){
    $id = $_GET['product'];
    $sql = "SELECT * FROM tblproduct where id = $id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0){
        unset($_SESSION['success']);
        $_SESSION['error'] = "Product not found!";
        header('location: .././admin.php');
    }else{
        $sql = "UPDATE tblproduct SET approved=1 WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
    
        if ($count !==0) {
            $_SESSION['success'] = "Approved!";
            unset($_SESSION['error']);
            header('location: .././admin.php');
        } else {    
            $_SESSION['error'] = "Error Approving!";
            unset($_SESSION['success']);
            echo "Error Approving";
        }    
    }
   
}else{
    $_SESSION['error'] = "Product not found!";
    header('location: .././admin.php');
}

?>