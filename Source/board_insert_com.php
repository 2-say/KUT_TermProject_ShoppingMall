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
									<li class="current"><a href="index.php">Welcome</a></li>
									<li>
										<a href="">์ค๊ณ ์ฅํฐ</a>
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
									<li><a href="left-sidebar.php">์ง๋ฌธ ๊ฒ์ํ</a></li>
									<li><a href="message_form.php">์ชฝ์ง</a></li>
									<li><a href="no-sidebar.html">๋ฌธ์์ฌํญ</a></li>
								</ul>
							</nav>

					</header>
				</div>
				<meta charset="utf-8">
				
				
				<?php
					session_start();
					if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
					else $userid = "";
					if (isset($_SESSION["username"])) $username = $_SESSION["username"];
					else $username = "";
				
					if ( !$userid )
					{
						echo("
									<script>
									alert('๊ฒ์ํ ๊ธ์ฐ๊ธฐ๋ ๋ก๊ทธ์ธ ํ ์ด์ฉํด ์ฃผ์ธ์!');
									history.go(-1)
									</script>
						");
								exit;
					}
				
					$subject = $_POST["subject"];
					$content = $_POST["content"];
				
					$subject = htmlspecialchars($subject, ENT_QUOTES);
					$content = htmlspecialchars($content, ENT_QUOTES);
				
					$regist_day = date("Y-m-d (H:i)");  // ํ์ฌ์ '๋-์-์ผ-์-๋ถ'์ ์ ์ฅ
				
					$upload_dir = './data/';
				
					$upfile_name	 = $_FILES["upfile"]["name"];
					$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
					$upfile_type     = $_FILES["upfile"]["type"];
					$upfile_size     = $_FILES["upfile"]["size"];
					$upfile_error    = $_FILES["upfile"]["error"];
				
					if ($upfile_name && !$upfile_error)
					{
						$file = explode(".", $upfile_name);
						$file_name = $file[0];
						$file_ext  = $file[1];
				
						$new_file_name = date("Y_m_d_H_i_s");
						$new_file_name = $new_file_name;
						$copied_file_name = $new_file_name.".".$file_ext;      
						$uploaded_file = $upload_dir.$copied_file_name;
				
						if( $upfile_size  > 1000000 ) {
								echo("
								<script>
								alert('์๋ก๋ ํ์ผ ํฌ๊ธฐ๊ฐ ์ง์ ๋ ์ฉ๋(1MB)์ ์ด๊ณผํฉ๋๋ค!<br>ํ์ผ ํฌ๊ธฐ๋ฅผ ์ฒดํฌํด์ฃผ์ธ์! ');
								history.go(-1)
								</script>
								");
								exit;
						}
				
						if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
						{
								echo("
									<script>
									alert('ํ์ผ์ ์ง์ ํ ๋๋ ํ ๋ฆฌ์ ๋ณต์ฌํ๋๋ฐ ์คํจํ์ต๋๋ค.');
									history.go(-1)
									</script>
								");
								exit;
						}
					}
					else 
					{
						$upfile_name      = "";
						$upfile_type      = "";
						$copied_file_name = "";
					}
					
					$con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
				
					$sql = "insert into board_computer (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
					$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
					$sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
					mysqli_query($con, $sql);  // $sql ์ ์ ์ฅ๋ ๋ช๋ น ์คํ
				
					// ํฌ์ธํธ ๋ถ์ฌํ๊ธฐ
					  $point_up = 100;
				
					$sql = "select point from members where id='$userid'";
					$result = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($result);
					$new_point = $row["point"] + $point_up;
					
					$sql = "update members set point=$new_point where id='$userid'";
					mysqli_query($con, $sql);
				
					mysqli_close($con);                // DB ์ฐ๊ฒฐ ๋๊ธฐ
				
					echo "
					   <script>
						location.href = 'board_list_com.php';
					   </script>
					";
				?>
				

			<!-- Main -->
				<div id="main-wrapper">
					<div class="container">
						<div class="row gtr-200">
							<div class="col-4 col-12-medium">

								

								<!-- Content -->
									<div id="content">
										<ui><button onclick="location.href='board_form_com.php'">๊ธ์ฐ๊ธฐ</button>
										</ui>
									
									</div>
							</div>
						</div>
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