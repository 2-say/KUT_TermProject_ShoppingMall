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

	<div id="admin_box">

		
	<h3 id="member_title">
	    	관리자 모드 > 공지 사항 관리
		</h3>
	    <ul id="member_list">
				<table>
				<tr>
					<th>번호</th>
					<th>아이디</th>
					<th>게시물 제목 </th>
					<th>작성 날짜</th>

					<th><button type="button" onclick="location.href='board_form2.php'">글쓰기</button></th>
				</tr>
				</table>
<?php
	$con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
	$sql = "select * from notice order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 회원 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result))
   {
	$subject       =$row["subject"];
      $num         = $row["num"];
	  $id          = $row["id"];
      $regist_day  = $row["regist_day"];
?>
			
		
			<form method="post" action="admin_member_update.php?num=<?=$num?>">
			<table>
			<tr>
			<th><?=$number?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			
			<th><?=$id?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th><?=$subject?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th>&nbsp;&nbsp;&nbsp;&nbsp;<?=$regist_day?>&nbsp;&nbsp;</th>
			<th><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button>&nbsp;&nbsp;</th>
  		 	</tr>
		
		</form>
		</table>
			
<?php
   	   $number--;
   }
?>




	    <h3 id="member_title">
	    	관리자 모드 > 회원 관리
		</h3>
	    <ul id="member_list">
				<table>
				<tr>
					<th>번호</th>
					<th>아이디</th>
					<th>이름</th>
					<th>레벨</th>
					<th>포인트</th>
					<th>가입일</th>
					<th>수정</th>
					<th>삭제</th>
				</tr>
				</table>
<?php
	$con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
	$sql = "select * from members order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 회원 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result))
   {
      $num         = $row["num"];
	  $id          = $row["id"];
	  $name        = $row["name"];
	  $level       = $row["level"];
      $point       = $row["point"];
      $regist_day  = $row["regist_day"];
?>
			
		
			<form method="post" action="admin_member_update.php?num=<?=$num?>">
			<table>
			<tr>
			<th><?=$number?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th><?=$id?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th><?=$name?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th><input type="text" name="level" value="<?=$level?>" style= "width: 50px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th><input type="text" name="point" value="<?=$point?>" style= "width: 50px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$regist_day?>&nbsp;&nbsp;</th>
			<th><button type="submit">수정</button>&nbsp;&nbsp;</th>
			<th><button type="button" onclick="location.href='admin_member_delete.php?num=<?=$num?>'">삭제</button>&nbsp;&nbsp;</th>
  		 	</tr>
		
		</form>
		</table>
			
<?php
   	   $number--;
   }
?>
	    </ul>
	    <h3 id="member_title">
	    	관리자 모드 > 게시판 관리
		</h3>
	    <ul id="board_list">
		<table>
			<tr>
			<th>선택</th>
			<th>번호</th>
			<th>이름</th>
			<th>제목</th>
			<th>첨부파일명</th>
			<th>작성일</th>
			</tr>
		</table>
		
		<form method="post" action="admin_board_delete.php">
<?php
	$sql = "select * from board order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글의 수

	$number = $total_record;

   while ($row = mysqli_fetch_array($result))
   {
      $num         = $row["num"];
	  $name        = $row["name"];
	  $subject     = $row["subject"];
	  $file_name   = $row["file_name"];
      $regist_day  = $row["regist_day"];
      $regist_day  = substr($regist_day, 0, 10)
?>
	<table>
		<tr>
			<th><span class="col1"><input type="checkbox" name="item[]" value="<?=$num?>" ></span></th>
			<th><?=$number?></th>
			<th><?=$name?></th>
			<th><?=$subject?></th>
			<th><?=$file_name?></th>
			<th><?=$regist_day?></th>
			</intput>
   		</tr>	
   </table>
<?php
   	   $number--;
   }
   mysqli_close($con);
?>
				<button type="submit">선택된 글 삭제</button>
			</form>
	    </ul>
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