<html>
	<script>
		function check_input() {
			if (!document.board_form.subject.value)
			{
				alert("제목을 입력하세요!");
				document.board_form.subject.focus();
				return;
			}
			if (!document.board_form.content.value)
			{
				alert("내용을 입력하세요!");    
				document.board_form.content.focus();
				return;
			}
			document.board_form.submit();
		 }
	  </script>


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
<!--
	Verti by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
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
									<li><a href="login_form">Login</a></li>

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

				<script>
					function check_input()
					{
					   if (!document.member_form.id.value) {
						   alert("아이디를 입력하세요!");    
						   document.member_form.id.focus();
						   return;
					   }
				 
					   if (!document.member_form.pass.value) {
						   alert("비밀번호를 입력하세요!");    
						   document.member_form.pass.focus();
						   return;
					   }
				 
					   if (!document.member_form.pass_confirm.value) {
						   alert("비밀번호확인을 입력하세요!");    
						   document.member_form.pass_confirm.focus();
						   return;
					   }
				 
					   if (!document.member_form.name.value) {
						   alert("이름을 입력하세요!");    
						   document.member_form.name.focus();
						   return;
					   }
				 
					   if (!document.member_form.email1.value) {
						   alert("이메일 주소를 입력하세요!");    
						   document.member_form.email1.focus();
						   return;
					   }
				 
					   if (!document.member_form.email2.value) {
						   alert("이메일 주소를 입력하세요!");    
						   document.member_form.email2.focus();
						   return;
					   }
				 
					   if (document.member_form.pass.value != 
							 document.member_form.pass_confirm.value) {
						   alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
						   document.member_form.pass.focus();
						   document.member_form.pass.select();
						   return;
					   }
				 
					   document.member_form.submit();
					}
				 
					function reset_form() {
					   document.member_form.id.value = "";  
					   document.member_form.pass.value = "";
					   document.member_form.pass_confirm.value = "";
					   document.member_form.name.value = "";
					   document.member_form.email1.value = "";
					   document.member_form.email2.value = "";
					   document.member_form.id.focus();
					   return;
					}
				 
					function check_id() {
					  window.open("member_check_id.php?id=" + document.member_form.id.value,
						  "IDcheck",
						   "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
					}
				 </script>






<div id="main_content">
	<div id="join_box">
	<form  name="member_form" method="post" action="member_insert.php">
	  <h2>회원 가입</h2>
		  <div class="form id">
			  <div class="col1">아이디</div>
			  <div class="col2">
				  <input type="text" name="id">
			  </div>  
			  <div class="col3">
				  <a href="#"><img src="./images/check_id.gif" 
					  onclick="check_id()"></a>
			  </div>                 
			 </div>
			 <div class="clear"></div>

			 <div class="form">
			  <div class="col1">비밀번호</div>
			  <div class="col2">
				  <input type="password" name="pass">
			  </div>                 
			 </div>
			 <div class="clear"></div>
			 <div class="form">
			  <div class="col1">비밀번호 확인</div>
			  <div class="col2">
				  <input type="password" name="pass_confirm">
			  </div>                 
			 </div>
			 <div class="clear"></div>
			 <div class="form">
			  <div class="col1">이름</div>
			  <div class="col2">
				  <input type="text" name="name">
			  </div>                 
			 </div>
			 <div class="clear"></div>
			 <div class="form email">
			  <div class="col1">이메일</div>
			  <div class="col2">
				  <input type="text" name="email1">@<input type="text" name="email2">
			  </div>                 
			 </div>
			 <div class="clear"></div>
			 <div class="bottom_line"> </div>

			 
			 <div class="buttons">
				<br>
			  <img style="cursor:pointer" src="./images/button_save.gif" onclick="check_input()">&nbsp;
				<img id="reset_button" style="cursor:pointer" src="./images/button_reset.gif"
					onclick="reset_form()">
			 </div>
	 </form>
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