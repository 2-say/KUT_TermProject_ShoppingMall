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
		<title>๐ซ๋ง์ผ</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload homepage">
		<div id="page-wrapper">

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
									<li><a herf="login_form.php">Login</a></li>

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
									<li><a href="admin.php">๊ด๋ฆฌ์ ๋ชจ๋(15์ฅ)</a></li>
								<?php
									}
								?>

								</ul>
							</nav>

					</header>
				</div>

			

		

				<?php
						if (isset($_GET["page"]))
							$page = $_GET["page"];
						else
							$page = 1;

						$con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
						$sql = "select * from board_computer order by num desc";
						$result = mysqli_query($con, $sql);
						$total_record = mysqli_num_rows($result); // ์ ์ฒด ๊ธ ์
						$scale = 10;

						// ์ ์ฒด ํ์ด์ง ์($total_page) ๊ณ์ฐ 
						if ($total_record % $scale == 0)     
							$total_page = floor($total_record/$scale);      
						else
							$total_page = floor($total_record/$scale) + 1; 
					
						// ํ์ํ  ํ์ด์ง($page)์ ๋ฐ๋ผ $start ๊ณ์ฐ  
						$start = ($page - 1) * $scale;      

						$number = $total_record - $start;
									
				?>






			<?php
				if ($total_page>=2 && $page >= 2)	
				{
					$new_page = $page-1;
					//echo "<li><a href='board_list.php?page=$new_page'>โ ์ด์ </a> </li>";
				}		
				else 
					//echo "<li>&nbsp;</li>";

				// ๊ฒ์ํ ๋ชฉ๋ก ํ๋จ์ ํ์ด์ง ๋งํฌ ๋ฒํธ ์ถ๋ ฅ
				for ($i=1; $i<=$total_page; $i++)
				{
					if ($page == $i)     // ํ์ฌ ํ์ด์ง ๋ฒํธ ๋งํฌ ์ํจ
					{
						//echo "<li><b> $i </b></li>";
					}
					else
					{
						//echo "<li><a href='board_list.php?page=$i'> $i </a><li>";
					}
				}
				if ($total_page>=2 && $page != $total_page)		
				{
					$new_page = $page+1;	
					//echo "<li> <a href='board_list.php?page=$new_page'>๋ค์ โถ</a> </li>";
				}
				else 
					//echo "<li>&nbsp;</li>";
			?> 	
				
			<?php 
				if($userid) { 
			?>
								
			<?php
				} else {
			?>
							
			<?php
				}
			?>
				
					<div id="banner1" class="box container">
						
							<h2>์ปดํจํฐ ๊ณตํ๋ถ๐ป</h2>
							
							<h4>
								์ฌ๊ธฐ๋ ์ปดํจํฐ๊ณตํ๋ถ ์์งํธ ์๋๋ค.
							</h4>
							
								
								<li>
								<span class="col1">๋ฒํธ</span>
								<span class="col2">์ ๋ชฉ</span>
								<span class="col3">๊ธ์ด์ด</span>
								<span class="col4">์ฒจ๋ถ</span>
								<span class="col5">๋ฑ๋ก์ผ</span>
								<span class="col6">์กฐํ</span>
					
								</li>
								
								
							<?php
							for ($i=$start; $i<$start+$scale && $i < $total_record; $i++){
								mysqli_data_seek($result, $i);
								// ๊ฐ์ ธ์ฌ ๋ ์ฝ๋๋ก ์์น(ํฌ์ธํฐ) ์ด๋
								$row = mysqli_fetch_array($result);
								// ํ๋์ ๋ ์ฝ๋ ๊ฐ์ ธ์ค๊ธฐ

								$num         = $row["num"];
								$id          = $row["id"];
								$name        = $row["name"];
								$subject     = $row["subject"];
								$regist_day  = $row["regist_day"];
								$hit         = $row["hit"];
								if ($row["file_name"])
									$file_image = "<img src='./images/file.gif'>";
								else
									$file_image = " ";

								?>
								<li>
									
									<span class="col1"><?=$number?></span>
									<span class="col2"><a href="board_view_com.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span> 
									<span class="col3"><?=$name?></span>
									<span class="col4"><?=$file_image?></span>
									<span class="col5"><?=$regist_day?></span>
									<span class="col6"><?=$hit?></span>
									
								</li>

								<?php
									$number--;  }
								?>

								<?php
								mysqli_close($con);
								?>
							
								

								<li><button onclick="location.href='board_form_com.php'">๊ธ์ฐ๊ธฐ</button>
								<button onclick="location.href='board_list_com.php'">๋ชฉ๋ก</button>
								

							
								
							
						</div>
					
				</div>

		





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