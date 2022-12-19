
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
					
					$num     = $_GET["num"];
					$page    = $_GET["page"];
					$content = $_POST["content"];
					

				
					$content = htmlspecialchars($content, ENT_QUOTES);
				
					$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
								
					$con = mysqli_connect("127.0.0.1", "root", "9eexju!@12","sample");
					
					$sql = "insert into reply (num, id, content, regist_day) ";
					$sql .= "values('$num','$userid', '$content', '$regist_day') ";
					mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
				
					// 포인트 부여하기
					$point_up = 10;
				
					$sql = "select point from members where id='$userid'";
					$result = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($result);
					$new_point = $row["point"] + $point_up;
					
					$sql = "update members set point=$new_point where id='$userid'";
					mysqli_query($con, $sql);
				
					mysqli_close($con);                // DB 연결 끊기
				
					echo "
					   <script>
						location.href = 'board_view_com.php?num=$num&page=$page';
					   </script>
					";
				?>
				

			