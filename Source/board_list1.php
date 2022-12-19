<!--판매글 보기 리스트 -->


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
		<title>아지트🏖</title>
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
											
										</ul>
									</li>
									<li><a href="board_list.php">질문 게시판</a></li>
									<li><a href="message_form.php">쪽지</a></li>
	
									<li> &nbsp;</li> 
								<?php
    								if(!$userid) {
								?>                
									<li><a href="member_form.php">Sign up</a></li>
									<li><a herf="login_form.php">Login</a></li>

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
									<li><a href="admin.php">관리자 모드(15장)</a></li>
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
						$sql = "select * from trade_board order by num desc";
						$result = mysqli_query($con, $sql);
						$total_record = mysqli_num_rows($result); // 전체 글 수
						$scale = 10;

						// 전체 페이지 수($total_page) 계산 
						if ($total_record % $scale == 0)     
							$total_page = floor($total_record/$scale);      
						else
							$total_page = floor($total_record/$scale) + 1; 
					
						// 표시할 페이지($page)에 따라 $start 계산  
						$start = ($page - 1) * $scale;      

						$number = $total_record - $start;
					
				
					
					
				
				
				?>






			<?php
				if ($total_page>=2 && $page >= 2)	
				{
					$new_page = $page-1;
					//echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a> </li>";
				}		
				else 
					//echo "<li>&nbsp;</li>";

				// 게시판 목록 하단에 페이지 링크 번호 출력
				for ($i=1; $i<=$total_page; $i++)
				{
					if ($page == $i)     // 현재 페이지 번호 링크 안함
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
					//echo "<li> <a href='board_list.php?page=$new_page'>다음 ▶</a> </li>";
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
						
							<h2>판매 상품</h2>
							
							<h3>
								판매 상품 > 목록보기
							</h3>
							
								
								<li>
								<span class="col1">번호</span>
								<span class="col2">제목</span>
								<span class="col3">글쓴이</span>
								<span class="col4">첨부</span>
								<span class="col5">등록일</span>
								<span class="col6">조회</span>
								<span class="col7">카테고리</span>
								<span class="col8">가격</span>
								</li>
								
								
							<?php
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
								if ($row["file_name"])
									$file_image = "<img src='./images/file.gif'>";
								else
									$file_image = " ";

								?>
								<li>
									
									<span class="col1"><?=$number?></span>
									<span class="col2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span> 
									<span class="col3"><?=$name?></span>
									<span class="col4"><?=$file_image?></span>
									<span class="col5"><?=$regist_day?></span>
									<span class="col6"><?=$hit?></span>
									<span class="col7"><?=$category?></span>
									<span class="col8"><?=$price?></span>
								</li>

								<?php
									$number--;  }
								?>

								<?php
								mysqli_close($con);
								?>
							
								

								<li><button onclick="location.href='board_form.php'">글쓰기</button>
								<button onclick="location.href='board_list.php'">목록</button>
								<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a></li>

							
								
							
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