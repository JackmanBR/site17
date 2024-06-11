<h1>Forgot Password</h1>
	<?php
	if(isset($_GET['forgot']) && ($_GET['forgot'] == 'go') && $_GET['forgot'] != ''){
		if(isset($_POST['login']) && !empty($_POST['login']) && ($_POST['login'] != '')&&
			isset($_POST['email']) && !empty($_POST['email']) && ($_POST['email'] != '')){

			$login = addslashes(htmlentities($_POST['login']));
			$email = addslashes(htmlentities($_POST['email']));

			$searchAcc = $pdo->prepare("SELECT login, email FROM accounts WHERE login = '$login' AND email = '$email'");

			if($searchAcc->execute()){
				if($searchAcc->rowCount() == 1){					
					
					$token = md5(randPassword());
					
					echo forgotPassword($email, $login, $server_name, $server_email, $server_site, $token);
					
					$_SESSION['forgot']['email'] = $email;
					$_SESSION['forgot']['login'] = $login;
					$_SESSION['forgot']['token'] = $token;
					
				}else{
					echo '<div class="red">Invalid data!</div>';
				}
			}else{
				echo '<div class="red">Ops... Error!</div>';
			}
		}else{
			echo '<div class="red">Fill in all fields</div>';
		}
	}
	?>
	<div class="register">
		<form action="./?page=forgot&forgot=go" method="post">
			<input type="text" class="dados" name="login" autocomplete="off" maxlength="16" placeholder="Your login" required/>
			<input type="email" class="dados" name="email" autocomplete="off" maxlength="255" placeholder="Email" required/>
			<br/><br/>
			
			<input type="submit" class="go" value="Forgot Password!"/>
		</form>
	</div>
		