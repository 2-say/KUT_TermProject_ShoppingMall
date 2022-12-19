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
	// 오류 출력 x
	error_reporting(E_ALL^ E_WARNING); 
?>		

<!DOCTYPE HTML>

<html>
	<head>
		<title>당근마켓</title>
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
									<li><a herf="#">Login</a></li>

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
	$num  = $_GET["num"];
	$page  = $_GET["page"];

	$con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
	$sql = "select * from board_computer where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];
	

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$new_hit = $hit + 1;
	$sql = "update board_computer set hit=$new_hit where num=$num";   
	mysqli_query($con, $sql);
	mysqli_close($con);
?>		
	    
				<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}
				?>
					
	    </ul>
	    <ul class="buttons">
		<div id="banner-wrapper">
					<div id="banner1" class="box container">
						<div class="row">
							<div class="col-10 col-12-medium">
							<ui>&nbsp;&nbsp;&nbsp;<button onclick="location.href='board_list_com.php?page=<?=$page?>'">목록</button>
								<button onclick="location.href='board_delete_com.php?num=<?=$num?>&page=<?=$page?>'">삭제</button>
								<button onclick="location.href='board_form_com.php'">글쓰기</button></ui>
								<br>
								<br>
							<ul id="view_content"><b>제목 :</b>
			<?=$subject?><ul>

			<li><?=$name?></li>
			<?=$regist_day?><br><br>
			<?=$content?>
			
			
			<br>
			<br>
			<br>
		

			
			<li><h3>댓글</h3></li>

			<?php
						$num  = $_GET["num"];
						if (isset($_GET["page"]))
							$page = $_GET["page"];
						else
							$page = 1;

						
						$con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
						$sql = "select * from reply where num=$num";
						$result = mysqli_query($con, $sql);
						$total_record = mysqli_num_rows($result); // 전체 글 수
						$scale = 10;
					
						// 표시할 페이지($page)에 따라 $start 계산  
						$start = ($page - 1) * $scale;      
						$number = $total_record - $start;
						$count = 1 ;
						$count1=0;


						for ($i=$start; $i<$start+$scale && $i < $total_record; $i++){
							mysqli_data_seek($result, $i);
							// 가져올 레코드로 위치(포인터) 이동
							$row = mysqli_fetch_array($result);
							// 하나의 레코드 가져오기

							$num[$count1]         = $row["num"];
							$id          = $row["id"];
							$content     = $row["content"];
							$regist_day  = $row["regist_day"];
							$reply_num[$count1]   = $row["reply_num"];
													
							
		
							
				?>
				<div id="reply_num">
				<li><?=$count?>번 &nbsp;&nbsp;<?=$userid ?>&nbsp;: [<?=$regist_day?>] &nbsp;&nbsp;&nbsp; <?=$content?>
				
					
				<button id="reply_delete_bt" onclick="location.href='reply_delete.php?num=<?=$num[$count1];?>&reply_num=<?=$reply_num[$count1];?>&page=<?=$page;?>'"  style="float:right; height:40px; width:60px;">
				삭제</button>
				
							
				</div>
			</li>
				

				<?php
					$count=$count +1;
					$count1=$count1+1;	
						}
						mysqli_close($con);
				?>



	


			
			<!-- 댓글 입력 폼 dialog -->
			<div class="dap_ins">
			<form action="reply_insert.php?num=<?=$num[0]?>&page=<?=$page?>" method="post">
			<div style="margin-top:10px; ">
			
			<li>댓글</li>
			<li><textarea name="content" laceholder="댓글을 입력해주세요." style="width:790px; "></textarea>
			<div id="rep_bt">
			<input type="submit" value="댓 글" style="height:100px;"></li>
			</div>
			</div>
			</form>
			</div>


			
			
				
				
					</div>
				</div>
			</div>
		</div>
			
		</ul>
	</div> <!-- board_box -->







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