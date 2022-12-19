<?php
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $price = $_POST["price"];
          
    $con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
    $sql = "update trade_board set subject='$subject', content='$content',price='$price'";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'tradepage.php?page=$page';
	      </script>
	  ";
?>

   
