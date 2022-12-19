<?php

    $num   = $_GET["num"];
    $page   = $_GET["page"];

    $con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
    $sql = "select * from trade_board where num = $num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $copied_name = $row["file_copied"];

	if ($copied_name)
	{
		$file_path = "DATA/".$copied_name;
		unlink($file_path);
    }

    $sql = "delete from trade_board where num = $num";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo "
	     <script>
	         location.href = 'tradepage.php?page=$page';
	     </script>
	   ";
?>

