<?php
    $num   = $_GET["num"];
    $page   = $_GET["page"];
    $reply_num = $_GET["reply_num"];
    $con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
    $sql = "select * from reply where reply_num = $reply_num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $sql = "delete from reply where reply_num = $reply_num";
    mysqli_query($con, $sql);
    mysqli_close($con);
    
    
    echo 
    
        "<script>
	         location.href = 'board_view_com.php?num=$num&page=$page';
	     </script>";
    

    
?>

