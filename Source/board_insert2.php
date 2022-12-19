<html>
	<head>
		<title>🫑마켓</title>
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
							<h1><a href="index.php">Agit🏖</a></h1>
								<span>아지트</span>
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li class="current"><a href="index.php">Welcome</a></li>
									<li>
										<a href="">중고장터</a>
										<ul>
										<li><a href="category_clothes.php">의류</a></li>
											<li><a href="category_electronic.php">전자기기/가구</a></li>
											<li><a href="category_instrument.php">음반/악기</a>
												<a href="category_food.php">음식</a>
												<a href="category_sports.php">스포츠</a>
												<a href="category_beauty.php">뷰티/미용</a>
												<a href="category_etc.php">etc</a>
											</li>
											
										</ul>
									</li>
									<li><a href="left-sidebar.php">질문 게시판</a></li>
									<li><a href="message_form.php">쪽지</a></li>
									<li><a href="no-sidebar.html">문의사항</a></li>
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
									alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
									history.go(-1)
									</script>
						");
								exit;
					}
				
					$subject = $_POST["subject"];
					$content = $_POST["content"];
				
					$subject = htmlspecialchars($subject, ENT_QUOTES);
					$content = htmlspecialchars($content, ENT_QUOTES);
				
					$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
				
					$upload_dir = 'images/';
				
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
								alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
								history.go(-1)
								</script>
								");
								exit;
						}
				
						if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
						{
								echo("
									<script>
									alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
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
				
					$sql = "insert into notice (id, name, subject, content, regist_day, hit, file_name, file_type, file_copied) ";
					$sql .= "values('$userid','$username','$subject','$content','$regist_day', 0, ";
					$sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
					mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
				
					// 포인트 부여하기
					  $point_up = 100;
				
					$sql = "select point from members where id='$userid'";
					$result = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($result);
					$new_point = $row["point"] + $point_up;
					
					$sql = "update members set point=$new_point where id='$userid'";
					mysqli_query($con, $sql);
				
					mysqli_close($con);                // DB 연결 끊기
				
					echo "
					   <script>
						location.href = 'tradepage.php';
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
										<ui><button onclick="location.href='board_form.php'">글쓰기</button>
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