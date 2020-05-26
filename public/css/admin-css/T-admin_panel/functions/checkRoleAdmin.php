<?php
    if(isset($_SESSION['user_id'])){
        if($_SESSION['role'] !== 'admin'){
            header('location:../homepage.php');           
        }
    }
?>