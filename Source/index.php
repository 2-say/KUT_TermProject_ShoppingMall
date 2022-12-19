
<!-- 메인 홈페이지 -->


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
		<title>Agit🏖</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="./assets/css/banner.css" />
	</head>
	<body class="is-preload homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
					<header id="header" class="container">

						<!-- Logo -->
							<div id="logo">
								<h1><a href="index.php">Agit🏖</a></h1>
								<span>아지트</span>
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									
									<li>
										<a href="tradepage.php">중고장터</a>
										<ul>
											<li><a href="category_clothes.php">의류</a></li>
											<li><a href="category_electronic.php">전자기기/가구</a></li>
											<li><a href="category_instrument.php">음반/악기</a>
												<a href="category_food.php">음식</a>
												<a href="category_sports.php">스포츠</a>
												<a href="category_beauty.php">뷰티/미용</a>
												<a href="category_etc.php">etc</a>
											</li>
											</li>
											
										</ul>
									</li>
									<li><a href="board_list.php">질문 게시판</a></li>
									<li><a href="message_form.php">쪽지</a></li>
	
									<li> &nbsp;</li> 
								<?php
    								if(!$userid) {
								?>                
									<li><a href="member_form.php">Sign up</a></li>
									<li><a href="login_form.php">Login</a></li>

								<?php
   									 } else {
                						$logged = $username."(".$userid.")님[Level:".$userlevel.", Point:".$userpoint."]";
								?>
										<li><?=$logged?> </li>
										<li> | </li>
										<li><a href="logout.php">Logout</a> </li>
										<li> | </li>
										<li><a href="member_modify_form.php">정보 수정</a></li>
								
								<?php
   								 }
								?>
								<?php
									if($userlevel==1) {
								?>
									<li> | </li>
									<li><a href="admin.php">관리자 모드</a></li>
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
						$sql = "select * from notice order by num desc";
						$result = mysqli_query($con, $sql);
						$total_record = mysqli_num_rows($result); // 전체 글 수
						$scale = 9;

						// 전체 페이지 수($total_page) 계산 
						if ($total_record % $scale == 0)     
							$total_page = floor($total_record/$scale);      
						else
							$total_page = floor($total_record/$scale) + 1; 
					
						// 표시할 페이지($page)에 따라 $start 계산  
						$start = ($page - 1) * $scale;      

						$number = $total_record - $start;		
		
				
				?>
				


			<!-- Banner -->
				<div id="banner-wrapper">
					<div id="banner" class="box container">
						<div class="row">
								<ul>
								<?php
									$count = 0;
									for ($i=$start; $i<$start+$scale && $i < $total_record; $i++){
										
										mysqli_data_seek($result, $i);
										// 가져올 레코드로 위치(포인터) 이동
										$row = mysqli_fetch_array($result);
										// 하나의 레코드 가져오기

										$num         = $row["num"];
										$id          = $row["id"];
										$name        = $row["name"];
										$subject     = $row["subject"];
										$regist_day  = $row["regist_day"];
										$hit         = $row["hit"];


										
										$img_path[$count]    = "images/".$row["file_name"];
										$count= $count+1 ; 
										$number--;
									}
									mysqli_close($con);

									?>



										<span class = "body1">
										<section id="slider1" class="slider">
										<div class="box1" style="background-color: ivory;"><img src="<?=$img_path[0]?>" onerror="this.onerror=null; this.src='images/no_notice.png' ;" style="width:400px; height:400px;"></div>
										<div class="box1" style="background-color: ivory;"><img src="<?=$img_path[1]?>" onerror="this.onerror=null; this.src='images/no_notice.png' ;" style="width:400px; height:400px;"></div>
										<div class="box1" style="background-color: ivory;"><img src="<?=$img_path[2]?>" onerror="this.onerror=null; this.src='images/no_notice.png' ;" style="width:400px; height:400px;"></div>
										
										</section>

										<section id="slider2" class="slider">
										<div class="box1" style="background-color: ivory;"><img src="<?=$img_path[3]?>"  onerror="this.onerror=null; this.src='images/no_notice.png' ;" style="width:400px; height:400px;"></div>
										<div class="box1" style="background-color: ivory;"><img src="<?=$img_path[4]?>"  onerror="this.onerror=null; this.src='images/no_notice.png' ;" style="width:400px; height:400px;"></div>
										<div class="box1" style="background-color: ivory;"><img src="<?=$img_path[5]?>"  onerror="this.onerror=null; this.src='images/no_notice.png' ;" style="width:400px; height:400px;"></div>
										
										</section>
										<br>
										<div class ="banner_button">
										<a href="board_list2.php" class="button small icon solid fa-arrow-circle-right">More info</a>

										</li>
										</div>
										<script type="text/javascript" src="./assets/js/test.js"></script>
										</span>
			
								</ul>
	
						</div>
					</div>
				</div>

			<!-- Features -->
					
			<?php
						if (isset($_GET["page"]))
							$page = $_GET["page"];
						else
							$page = 1;

						$con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
						$sql = "select * from trade_board order by num desc";
						$result = mysqli_query($con, $sql);
						$total_record = mysqli_num_rows($result); // 전체 글 수
						$scale = 3;

						// 전체 페이지 수($total_page) 계산 
						if ($total_record % $scale == 0)     
							$total_page = floor($total_record/$scale);      
						else
							$total_page = floor($total_record/$scale) + 1; 
					
						// 표시할 페이지($page)에 따라 $start 계산  
						$start = ($page - 1) * $scale;      

						$number = $total_record - $start;		
				?>
				
			<!-- Features -->
				<div id="features-wrapper">
					<div class="container">
						<div class="row">



							<?php

								if($total_record == 0 ){
									echo  "<h3>글이 없어요 ㅠㅠ <br></h3>";
								}

								for ($i=$start; $i<$start+$scale && $i < $total_record; $i++){
									
									mysqli_data_seek($result, $i);
									// 가져올 레코드로 위치(포인터) 이동
									$row = mysqli_fetch_array($result);
									// 하나의 레코드 가져오기

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




								<!-- Box -->
								<div class="col-4 col-12-medium">
									<section class="box feature">
										<a href="board_view1.php?num=<?=$num?>&page=<?=$page?>" class="image featured">
										<img src="<?=$img_path?>" onerror="this.onerror=null; 
										this.src='images/no_img.jpeg' ;" style="height:400px; width: 100%; min-width: 140px;" /></a>
										
										<div class="inner">
											<header>
												<h2><a href="board_view1.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></h2>
												<p><?=$id?></p>
											</header>
											<p>가격 : <?= $price?></p>
										</div>
									</section>
								</div>

									
							<?php
									$number--;  }
							?>

								<?php
									mysqli_close($con);
								?>
							



							
			<!-- Main -->
				<div id="main-wrapper1">
					<div class="container">
						<div class="row gtr-200">
							<div class="col-8 col-12-medium">

								<!-- Sidebar -->
				
										
										<div id="content">
												<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

												🏫 우리 과 모여라 🏫</h4>
											<div class="grid">
												<div class="row gtr-50">
													
													<div class="col-4">
													<figure class="snip1132">
													<img src="images/computer.png" alt="sample22" />
													<figcaption>
													<div class="heading">
													<h5>computer <span> science</span></h5>
													</div>
													<div class="caption">
													<p>컴퓨터 공학부</p>
													</div>
													</figcaption>
													<a href="board_list_com.php"></a>
													</figure>
													</div>

													<div class="col-4">
													<figure class="snip1132">
													<img src="images/gigea.jpeg" alt="sample22" />
													<figcaption>
													<div class="heading">
													<h5>computer <span> science</span></h5>
													</div>
													<div class="caption">
													<p>기계 공학부</p>
													</div>
													</figcaption>
													<a href="#"></a>
													</figure>
													</div>


													<div class="col-4">
													<figure class="snip1132">
													<img src="images/electronic.png" alt="sample22" />
													<figcaption>
													<div class="heading">
													<h5>computer <span> science</span></h5>
													</div>
													<div class="caption">
													<p>전기전자통신공학부</p>
													</div>
													</figcaption>
													<a href="#"></a>
													</figure>
													</div>



													<div class="col-4">
													<figure class="snip1132">
													<img src="images/mecha.png" alt="sample22" />
													<figcaption>
													<div class="heading">
													<h5>computer <span> science</span></h5>
													</div>
													<div class="caption">
													<p>메카트로닉스공학부</p>
													</div>
													</figcaption>
													<a href="#"></a>
													</figure>
													</div>

											
													<div class="col-4">
													<figure class="snip1132">
													<img src="images/architure.jpeg" alt="sample22" />
													<figcaption>
													<div class="heading">
													<h5>computer <span> science</span></h5>
													</div>
													<div class="caption">
													<p>디자인&건축공학부</p>
													</div>
													</figcaption>
													<a href="#"></a>
													</figure>
													</div>

													<div class="col-4">
													<figure class="snip1132">
													<img src="images/energe.png" alt="sample22" />
													<figcaption>
													<div class="heading">
													<h5>computer <span> science</span></h5>
													</div>
													<div class="caption">
													<p>에너지신소재화학공학부</p>
													</div>
													</figcaption>
													<a href="#"></a>
													</figure>
													</div>



													<div class="col-4">
													<figure class="snip1132">
													<img src="images/sanup.jpeg" alt="sample22" />
													<figcaption>
													<div class="heading">
													<h5>computer <span> science</span></h5>
													</div>
													<div class="caption">
													<p>산업 경영학부</p>
													</div>
													</figcaption>
													<a href="#"></a>
													</figure>
													</div>

													<div class="col-4">
													<figure class="snip1132 hover">
													<img src="images/goyoung.jpeg" alt="sample21" />
													<figcaption>
														<div class="heading">
														<h5>Chauffina <span> Carr</span></h5>
														</div>
														<div class="caption">
														<p>고용서비스정책학과</p>
														</div>
													</figcaption>
													<a href="#"></a>
													</figure>
													</div>


													<div class="col-4">
													<figure class="snip1132">
														<img src="images/mix.jpeg" alt="sample18" />
													<figcaption>
														<div class="heading">
														<h5>Richard <span> Tea</span></h5>
														</div>
														<div class="caption">
														<p>융합학과</p>
														</div>
													</figcaption>
													<a href="#"></a>
													</figure>
													</div>


												</div>
											</div>
									</div>
	
							</div>
								
							
							
							<div class="col-4 col-12-medium imp-medium">
								<!-- Content -->
								<div id="content">
										<section id="last">
										
										<h3>오늘의 날씨</h3>
										<iframe src="https://forecast.io/embed/#lat=36.8256&lon=127.1408&name=천안&color=&font=&units=si" frameborder="0" width="100%" height="245px"></iframe>
							
										<h4>학식 먹자</h4>
											<iframe title="menucontents" id="menucontents" src="https://coop.koreatech.ac.kr/dining/menu.html?fmenu=pf&amp;LOCALE=ko" style="width:100%;height:200px;float:right;"></iframe>
										</section>
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
										<h3>학과별 사이트</h3>
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
										<h3>학교 사이트</h3>
										<ul class="style2">
											<li><a href="https://portal.koreatech.ac.kr/p/STHOME/">아우누리</a></li>
											<li><a href="https://www.koreatech.ac.kr/kor/Main.do">메인 홈페이지</a></li>
											<li><a href="https://lib.koreatech.ac.kr/#/">다산정보관</a></li>
											<li><a href="https://dorm.koreatech.ac.kr">생활관</a></li>
											<li><a href="https://www.koreatech.ac.kr/grd/Main.do">대학원</a></li>
										</ul>
									</section>

							</div>
							<div class="col-3 col-6-medium col-12-small">

								<!-- Links -->
									<section class="widget links">
										<h3>More site</h3>
										<ul class="style2">
											<li><a href="https://coop.koreatech.ac.kr/dining/menu.php">학식충</a></li>
											<li><a href="https://hrdi.koreatech.ac.kr/hrdi/Main.do">능력개발교육원</a></li>
											<li><a href="https://sandan.koreatech.ac.kr/kor/Main.do">산악 협력관</a></li>
											<li><a href="https://counsel.koreatech.ac.kr">상담진로개발센터</a></li>
											<li><a href="https://cms3.koreatech.ac.kr/humanrights/index.do">인권 센터</a></li>
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
										<p>2018136085 이세희<br />
										한국기술교육대학교<br />
										컴퓨터 공학부</p>
									</section>

							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<div id="copyright">
									<ul class="menu">
										<li>&copy; Untitled. All rights reserved</li><li>Design: 이세희</a></li>
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