<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>		



<!DOCTYPE HTML>

<html>
	<head>
		<title>Agit๐</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload homepage">
		<div id="page-wrapper">

					<?php
						if (isset($_GET["page"]))
							$page = $_GET["page"];
						else
							$page = 1;

						$con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
						$sql = "select * from trade_board order by num desc";
						$result = mysqli_query($con, $sql);
						$total_record = mysqli_num_rows($result); // ์ ์ฒด ๊ธ ์
						$scale = 9;

						// ์ ์ฒด ํ์ด์ง ์($total_page) ๊ณ์ฐ 
						if ($total_record % $scale == 0)     
							$total_page = floor($total_record/$scale);      
						else
							$total_page = floor($total_record/$scale) + 1; 
					
						// ํ์ํ  ํ์ด์ง($page)์ ๋ฐ๋ผ $start ๊ณ์ฐ  
						
						$start = ($page - 1) * $scale;      

						$number = $total_record - $start;				
		
				
					?>













			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
							<h1><a href="index.php">Agit๐</a></h1>
								<span>์์งํธ</span>
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									
									<li>
										<a href="tradepage.php">์ค๊ณ ์ฅํฐ</a>
										<ul>
											<li><a href="category_clothes.php">์๋ฅ</a></li>
											<li><a href="category_electronic.php">์ ์๊ธฐ๊ธฐ/๊ฐ๊ตฌ</a></li>
											<li><a href="category_instrument.php">์๋ฐ/์๊ธฐ</a>
												<a href="category_food.php">์์</a>
												<a href="category_sports.php">์คํฌ์ธ </a>
												<a href="category_beauty.php">๋ทฐํฐ/๋ฏธ์ฉ</a>
												<a href="category_etc.php">etc</a>
											</li>
										</ul>
									</li>
									<li><a href="board_list.php">์ง๋ฌธ ๊ฒ์ํ</a></li>
									<li><a href="message_form.php">์ชฝ์ง</a></li>
	
									<li> &nbsp;</li> 
								<?php
    								if(!$userid) {
								?>                
									<li><a href="member_form.php">Sign up</a></li>
									<li><a href="login_form">Login</a></li>

								<?php
   									 } else {
                						$logged = $username."(".$userid.")๋[Level:".$userlevel.", Point:".$userpoint."]";
								?>
										<li><?=$logged?> </li>
										<li> | </li>
										<li><a href="logout.php">Logout</a> </li>
										<li> | </li>
										<li><a href="member_modify_form.php">์ ๋ณด ์์ </a></li>
								
								<?php
   								 }
								?>
								<?php
									if($userlevel==1) {
								?>
									<li> | </li>
									<li><a href="admin.php">๊ด๋ฆฌ์ ๋ชจ๋</a></li>
								<?php
									}
								?>

								</ul>
							</nav>

					</header>
					<div id="make_board_button1">
					<ui>
						<button onclick="location.href='board_form1.php'">๊ธ์ฐ๊ธฐ</button>
					</ui>
				</div>
				</div>		
			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">





							<?php

								if($total_record == 0 ){
									echo  "<h3>๊ธ์ด ์์ด์ ใ ใ  <br></h3>";
								}



								for ($i=$start; $i<$start+$scale && $i < $total_record; $i++){


									

									mysqli_data_seek($result, $i);
									// ๊ฐ์ ธ์ฌ ๋ ์ฝ๋๋ก ์์น(ํฌ์ธํฐ) ์ด๋
									$row = mysqli_fetch_array($result);
									// ํ๋์ ๋ ์ฝ๋ ๊ฐ์ ธ์ค๊ธฐ

									$category    = $row["category"];
									$price       = $row["price"];
									$num         = $row["num"];
									$id          = $row["id"];
									$name        = $row["name"];
									$subject     = $row["subject"];
									$regist_day  = $row["regist_day"];
									$hit         = $row["hit"];
									$img_path    = "DATA/".$row["file_name"];
									$content     = $row["content"];
									

							?>





							<div class="col-4 col-12-medium">

								<!-- Box -->
									<section class="box feature">
										<a href="board_view1.php?num=<?=$num?>&page=<?=$page?>" class="image featured"><img src="<?=$img_path?>"  onerror="this.onerror=null; this.src='images/no_img.jpeg' ;" style= "height:400px; width: 100%; min-width: 140px;" /></a>
										<div class="inner">
											<header>
												
												<h2><a href="board_view1.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></h2>
												<p><?=$id?></p>
											</header>
											<p>๊ฐ๊ฒฉ: <?=$price?></p>
											<p>
												<?php
													$content=mb_substr($content,0,10);
													echo "$content";
													if(mb_strlen($content)>=10)
													{
												?>
														&nbsp;&nbsp;&nbsp;โโโ&nbsp;&nbsp;
												
												<?php	
													}

												?>

												
											</p>
										</div>
									</section>

							</div>

							<?php
									$number--;  }
							?>

								<?php
								mysqli_close($con);
								?>
							




						<ul id="page_num"> 	
							<?php
							if ($total_page>=2 && $page >= 2)	
							{
								$new_page = $page-1;
								echo "<a href='tradepage.php?page=$new_page'>โ ์ด์ </a>";
							}		
							else 
								echo "&nbsp;&nbsp;&nbsp;";

							// ๊ฒ์ํ ๋ชฉ๋ก ํ๋จ์ ํ์ด์ง ๋งํฌ ๋ฒํธ ์ถ๋ ฅ
							for ($i=1; $i<=$total_page; $i++)
							{
								if ($page == $i)     // ํ์ฌ ํ์ด์ง ๋ฒํธ ๋งํฌ ์ํจ
								{
									echo "<b> $i </b>";
								}
								else
								{
									echo "<a href='tradepage.php?page=$i'> $i </a>";
								}
							}
							if ($total_page>=2 && $page != $total_page)		
							{
								$new_page = $page+1;	
								
								echo "<a href='tradepage.php?page=$new_page'> &nbsp;&nbsp; ๋ค์ โถ</a>";
							}
							else 
								echo "&nbsp;&nbsp;&nbsp;";
						?>	

								
								
						
				

			<!-- Footer -->
			<div id="footer-wrapper">
					<footer id="footer" class="container">
						<div class="row">
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section class="widget links">
										<h3>ํ๊ณผ๋ณ ์ฌ์ดํธ</h3>
										<ul class="style2">
											<li><a href="https://cse.koreatech.ac.kr">Computer Science</a></li>
											<li><a href="https://cms3.koreatech.ac.kr/emc/index.do?sso=ok">Department of Chemical Engineering, New Materials, Energy</a></li>
											<li><a href="https://cms3.koreatech.ac.kr/me/index.do?sso=ok">Mechanic Engineering</a></li>
											<li><a href="https://cms3.koreatech.ac.kr/mechatronics/index.do?sso=ok">Mechatronic Engineering</a></li>
											<li><a href="https://cms3.koreatech.ac.kr/ite/index.do?sso=ok">electronic Engineering</a></li>
										</ul>
									</section>

							</div>
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section class="widget links">
										<h3>ํ๊ต ์ฌ์ดํธ</h3>
										<ul class="style2">
											<li><a href="https://portal.koreatech.ac.kr/p/STHOME/">์์ฐ๋๋ฆฌ</a></li>
											<li><a href="https://www.koreatech.ac.kr/kor/Main.do">๋ฉ์ธ ํํ์ด์ง</a></li>
											<li><a href="https://lib.koreatech.ac.kr/#/">๋ค์ฐ์ ๋ณด๊ด</a></li>
											<li><a href="https://dorm.koreatech.ac.kr">์ํ๊ด</a></li>
											<li><a href="https://www.koreatech.ac.kr/grd/Main.do">๋ํ์</a></li>
										</ul>
									</section>

							</div>
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section class="widget links">
										<h3>More site</h3>
										<ul class="style2">
											<li><a href="https://coop.koreatech.ac.kr/dining/menu.php">ํ์์ถฉ</a></li>
											<li><a href="https://hrdi.koreatech.ac.kr/hrdi/Main.do">๋ฅ๋ ฅ๊ฐ๋ฐ๊ต์ก์</a></li>
											<li><a href="https://sandan.koreatech.ac.kr/kor/Main.do">์ฐ์ ํ๋ ฅ๊ด</a></li>
											<li><a href="https://counsel.koreatech.ac.kr">์๋ด์ง๋ก๊ฐ๋ฐ์ผํฐ</a></li>
											<li><a href="https://cms3.koreatech.ac.kr/humanrights/index.do">์ธ๊ถ ์ผํฐ</a></li>
										</ul>
									</section>

							</div>
							<div class="col-3 col-6-medium col-12-small">

								<!-- Contact -->
									<section class="widget contact last">
										<h3>Contact Us</h3>
										<ul>
											<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
											<li><a href="https://www.facebook.com/profile.php?id=100005832337593" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
											<li><a href="https://www.instagram.com/seheeo_o/" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
											<li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
											<li><a href="#" class="icon brands fa-pinterest"><span class="label">Pinterest</span></a></li>
										</ul>
										<p>2018136085 ์ด์ธํฌ<br />
										ํ๊ตญ๊ธฐ์ ๊ต์ก๋ํ๊ต<br />
										์ปดํจํฐ ๊ณตํ๋ถ</p>
									</section>

							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div id="copyright">
									<ul class="menu">
										<li>&copy; Untitled. All rights reserved</li><li>Design: ์ด์ธํฌ</a></li>
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>

			</div>

		<!-- Scripts -->

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>