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
		<title>μμ§νΈπ</title>
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
						$sql = "select * from trade_board where category='μλ₯' order by num desc";
						$result = mysqli_query($con, $sql);
						$total_record = mysqli_num_rows($result); // μ μ²΄ κΈ μ
						$scale = 10;

						// μ μ²΄ νμ΄μ§ μ($total_page) κ³μ° 
						if ($total_record % $scale == 0)     
							$total_page = floor($total_record/$scale);      
						else
							$total_page = floor($total_record/$scale) + 1; 
					
						// νμν  νμ΄μ§($page)μ λ°λΌ $start κ³μ°  
						
						$start = ($page - 1) * $scale;      

						$number = $total_record - $start;				
		
				
					?>




			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
							<h1><a href="index.php">Agitπ</a></h1>
								<span>μμ§νΈ</span>
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									
									<li>
										<a href="tradepage.php">μ€κ³ μ₯ν°</a>
										<ul>
										<li><a href="category_clothes.php">μλ₯</a></li>
											<li><a href="category_electronic.php">μ μκΈ°κΈ°/κ°κ΅¬</a></li>
											<li><a href="category_instrument.php">μλ°/μκΈ°</a>
												<a href="category_food.php">μμ</a>
												<a href="category_sports.php">μ€ν¬μΈ </a>
												<a href="category_beauty.php">λ·°ν°/λ―Έμ©</a>
												<a href="category_etc.php">etc</a>
											</li>
											
										</ul>
									</li>
									<li><a href="board_list.php">μ§λ¬Έ κ²μν</a></li>
									<li><a href="message_form.php">μͺ½μ§</a></li>
	
									<li> &nbsp;</li> 
								<?php
    								if(!$userid) {
								?>                
									<li><a href="member_form.php">Sign up</a></li>
									<li><a href="login_form">Login</a></li>

								<?php
   									 } else {
                						$logged = $username."(".$userid.")λ[Level:".$userlevel.", Point:".$userpoint."]";
								?>
										<li><?=$logged?> </li>
										<li> | </li>
										<li><a href="logout.php">Logout</a> </li>
										<li> | </li>
										<li><a href="member_modify_form.php">μ λ³΄ μμ </a></li>
								
								<?php
   								 }
								?>
								<?php
									if($userlevel==1) {
								?>
									<li> | </li>
									<li><a href="admin.php">κ΄λ¦¬μ λͺ¨λ(15μ₯)</a></li>
								<?php
									}
								?>

								</ul>
							</nav>

					</header>
				</div>






				<!-- Content -->
				<div id="make_board_button1">
					<ui>
						<button onclick="location.href='board_form1.php'">κΈμ°κΈ°</button>
					</ui>
				</div>


			<!-- Features -->
			<div id="features-wrapper">
					<div class="container">
						<div class="row">

			<?php

								if($total_record == 0 ){
									echo  "<h3>κΈμ΄ μμ΄μ γ γ  <br></h3>";
								}

								for ($i=$start; $i<$start+$scale && $i < $total_record; $i++){

									mysqli_data_seek($result, $i);
									// κ°μ Έμ¬ λ μ½λλ‘ μμΉ(ν¬μΈν°) μ΄λ
									$row = mysqli_fetch_array($result);
									// νλμ λ μ½λ κ°μ Έμ€κΈ°

									$category    = $row["category"];
									$price       = $row["price"];
									$num         = $row["num"];
									$id          = $row["id"];
									$name        = $row["name"];
									$subject     = $row["subject"];
									$regist_day  = $row["regist_day"];
									$hit         = $row["hit"];
									$img_path    = "DATA/".$row["file_name"];
									

							?>


							<div class="col-4 col-12-medium">

								<!-- Box -->
									<section class="box feature">
										<a href="board_view1.php?num=<?=$num?>&page=<?=$page?> class="image featured"><img src="<?=$img_path?>"  alt="" style= "height:360px; width: 373px; min-width: 140px;" /></a>
										<div class="inner">
											<header>
												<h2><?=$subject?></h2>
												<p><?=$userid?></p>
											</header>
											<p>κ°κ²©: <?=$price?></p>
											<p>μ€μ°© 1λ² μ΄κ³ μ 2λ§μμ νλλ€.</p>
										</div>
									</section>

							</div>

							<?php
									$number--;  }
							?>

								<?php
								mysqli_close($con);
								?>
							
			
			
			
			
							<!-- Footer -->
			<div id="footer-wrapper">
					<footer id="footer" class="container">
						<div class="row">
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section class="widget links">
										<h3>νκ³Όλ³ μ¬μ΄νΈ</h3>
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
										<h3>νκ΅ μ¬μ΄νΈ</h3>
										<ul class="style2">
											<li><a href="https://portal.koreatech.ac.kr/p/STHOME/">μμ°λλ¦¬</a></li>
											<li><a href="https://www.koreatech.ac.kr/kor/Main.do">λ©μΈ ννμ΄μ§</a></li>
											<li><a href="https://lib.koreatech.ac.kr/#/">λ€μ°μ λ³΄κ΄</a></li>
											<li><a href="https://dorm.koreatech.ac.kr">μνκ΄</a></li>
											<li><a href="https://www.koreatech.ac.kr/grd/Main.do">λνμ</a></li>
										</ul>
									</section>

							</div>
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section class="widget links">
										<h3>More site</h3>
										<ul class="style2">
											<li><a href="https://coop.koreatech.ac.kr/dining/menu.php">νμμΆ©</a></li>
											<li><a href="https://hrdi.koreatech.ac.kr/hrdi/Main.do">λ₯λ ₯κ°λ°κ΅μ‘μ</a></li>
											<li><a href="https://sandan.koreatech.ac.kr/kor/Main.do">μ°μ νλ ₯κ΄</a></li>
											<li><a href="https://counsel.koreatech.ac.kr">μλ΄μ§λ‘κ°λ°μΌν°</a></li>
											<li><a href="https://cms3.koreatech.ac.kr/humanrights/index.do">μΈκΆ μΌν°</a></li>
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
										<p>2018136085 μ΄μΈν¬<br />
										νκ΅­κΈ°μ κ΅μ‘λνκ΅<br />
										μ»΄ν¨ν° κ³΅νλΆ</p>
									</section>

							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div id="copyright">
									<ul class="menu">
										<li>&copy; Untitled. All rights reserved</li><li>Design: μ΄μΈν¬</a></li>
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