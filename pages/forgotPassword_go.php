<?php
if(!isset($_GET['login']) || ($_GET['login'] == '') || empty($_GET['login']) || !isset($_GET['email']) || ($_GET['email'] == '') || empty($_GET['email']) || !isset($_GET['tk']) || ($_GET['tk'] == '') || empty($_GET['tk'])){
	echo "<script>location.href='./';</script>";
}else{
	if(!isset($_SESSION['forgot']) || count($_SESSION['forgot']) == 0){	
		echo "<script>location.href='./';</script>";
	}else{
		$token = addslashes(htmlentities($_GET['tk']));
		if($_SESSION['forgot']['token'] != $token){
				unset($_SESSION['forgot']['email']);
				unset($_SESSION['forgot']['login']);
				unset($_SESSION['forgot']['token']);
				session_destroy();
			echo "<script>location.href='./';</script>";
		}else{
			$tk = addslashes(htmlentities($_GET['tk']));
			$login = addslashes(htmlentities($_GET['login']));
			$email = addslashes(htmlentities($_GET['email']));

?>
<h1>Reset Password</h1>
	<?php
	if(isset($_GET['forgot']) && ($_GET['forgot'] == 'go') && $_GET['forgot'] != ''){
		if(isset($_POST['newpass']) && !empty($_POST['newpass']) && ($_POST['newpass'] != '')&&
			isset($_POST['newpass2']) && !empty($_POST['newpass2']) && ($_POST['newpass2'] != '')){

			$newpass = base64_encode(pack('H*', sha1($_POST['newpass'])));
			$newpass2 = base64_encode(pack('H*', sha1($_POST['newpass2'])));
		
			if($newpass != $newpass2){
				echo '<div class="red">The passwords not confered!</div>';
			}elseif((strlen($_POST['newpass']) > 16) || (strlen($_POST['newpass']) < 3)){
				echo "<div class='red'>The password can not be more than 16 or less than 3 characters!</div>";
			}else{
				$up = $pdo->prepare("UPDATE accounts SET password = '$newpass' WHERE login = '$login' AND email = '$email' AND status = 1");
				if($up->execute()){
					if($up->rowCount() == 1){
						echo "<div class='green'>Your password as been reseted!</div>";
						unset($_SESSION['ucp']['login']);
						unset($_SESSION['ucp']['email']);
						unset($_SESSION['forgot']['email']);
						unset($_SESSION['forgot']['login']);
						unset($_SESSION['forgot']['token']);
						session_destroy();
						echo "<meta HTTP-EQUIV='Refresh' CONTENT='4;URL=./'>";
					}else{
						echo "<div class='red'>Ops... Error!</div>";
					}
				}else{
					echo "<div class='red'>Ops... Error!</div>";
				}
			}		
		}else{
			echo '<div class="red">Fill in all fields</div>';
		}
	}
	?>
	<div class="register">
		<form action="./?page=forgotPassword_go&login=<?php echo $login; ?>&email=<?php echo $email; ?>&tk=<?php echo $tk; ?>&forgot=go" method="post">
			<input type="password" class="dados" name="newpass" autocomplete="off" maxlength="16" placeholder="New Pass" required/>
			<input type="password" class="dados" name="newpass2" autocomplete="off" maxlength="16" placeholder="Re New Pass" required/>
			<br/><br/>
			
			<input type="submit" class="go" value="Reset Password!"/>
		</form>
	</div>
<?php
		} // fim if token
	} // fim if session
} // fim if get
?>