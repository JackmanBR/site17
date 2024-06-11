<?php
if(isset($_SESSION['ucp']) && count($_SESSION['ucp']) > 0){
	$search = $pdo->query("SELECT login, email FROM accounts WHERE login = '".$_SESSION['ucp']['login']."' AND email = '".$_SESSION['ucp']['email']."'");
	if($search->execute()){
		if($search->rowCount() == 0){
			echo "<script>location.href='./';</script>";
		}
	}else{
		echo "<script>location.href='./';</script>";
	}
}
?>
<h1>Change Pass</h1>
	<?php
	if(isset($_GET['change']) && ($_GET['change'] == 'go') && $_GET['change'] != ''){
		if(isset($_POST['pass']) && !empty($_POST['pass']) && ($_POST['pass'] != '') &&
			isset($_POST['newpass']) && !empty($_POST['newpass']) && ($_POST['newpass'] != '') &&
			isset($_POST['repass']) && !empty($_POST['repass']) && ($_POST['repass'] != '')){

			$pass = base64_encode(pack('H*', sha1($_POST['pass'])));
			$newpass = base64_encode(pack('H*', sha1($_POST['newpass'])));
			$repass = base64_encode(pack('H*', sha1($_POST['repass'])));

			$searchAcc = $pdo->prepare("SELECT password FROM accounts WHERE password = '$pass' AND login = '".$_SESSION['ucp']['login']."' AND email = '".$_SESSION['ucp']['email']."'");

			if($newpass != $repass){
				echo '<div class="red">The passwords not confered!</div>';
			}elseif(strlen($newpass) < 6){
				echo '<div class="red">The password must be at least 6 characters!</div>';
			}else{
				if($searchAcc->execute()){
					if($searchAcc->rowCount() == 1){
						$up = $pdo->prepare("UPDATE accounts SET password = '$newpass' WHERE login = '".$_SESSION['ucp']['login']."' AND email = '".$_SESSION['ucp']['email']."'");
						if($up->execute()){
							if($up){
								echo '<div class="green">Congrulations! Your password as been changed!</div>';
								if($acc_changepass_email){
									echo changePassSendEmail($_SESSION['ucp']['email'], $server_name, $server_email, $acc);
								}
								unset($_SESSION['ucp']['email']);
								unset($_SESSION['ucp']['login']);
								session_destroy();
								echo "<meta HTTP-EQUIV='Refresh' CONTENT='3;URL=./'>";
							}else{
								echo '<div class="red">Ops.. Error!</div>';
							}
						}
					}else{
						echo '<div class="red">Current password incorrect!</div>';
					}
				}
			}

		}else{
			echo '<div class="red">Fill in all fields</div>';
		}
	}
	?>
	<div class="register">
		<form action="./?page=ucp_changepass&change=go" method="post">
			<input type="password" class="dados" name="pass" autocomplete="off" maxlength="16" placeholder="Old password" required/>
			<input type="password" class="dados" name="newpass" autocomplete="off" maxlength="16" placeholder="New Password" required/>
			<input type="password" class="dados" name="repass" autocomplete="off" maxlength="16" placeholder="Re New Password" required/>
			<br/><br/>
			
			<input type="submit" class="go" value="Change pass!"/>
		</form>
	</div>
		