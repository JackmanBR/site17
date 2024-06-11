<h1>Register account</h1>

<?php
	if(isset($_GET['register']) && ($_GET['register'] == 'go')){

		$pass = base64_encode(pack('H*', sha1($_POST['pass'])));
		$pass2 = base64_encode(pack('H*', sha1($_POST['pass2'])));
		
		if(empty($_POST['login']) && empty($_POST['email']) && empty($_POST['pass']) && empty($_POST['pass2']) && empty($_POST['terms'])){
			echo "<span class=\"red\">You neccessit preench all camps!</span><br/>";
			//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
		}elseif(empty($_POST['terms']) || ($_POST['terms'] == '') || !isset($_POST['terms'])){
			echo "<span class=\"red\">You neccessit to agree the terms!</span><br/>";
			//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
		}elseif(empty($_POST['login']) || ($_POST['login'] == '') || !isset($_POST['login'])) {
			echo "<span class=\"red\">Login is required!</span><br/>";
			//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
		}elseif(empty($_POST['email']) || ($_POST['email'] == '') || !isset($_POST['email'])) {
			echo "<span class=\"red\">Email is required!</span><br/>";
			//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
		}elseif(empty($_POST['pass']) || ($_POST['pass'] == '') || !isset($_POST['pass'])) {
			echo "<span class=\"red\">Password is required!</span><br/>";
			//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
		}elseif(empty($_POST['pass2']) || ($_POST['pass2'] == '') || !isset($_POST['pass2'])) {
			echo "<span class=\"red\">Re Password is required!</span><br/>";
			//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
		}elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			echo "<span class=\"red\">Email is invalid!</span><br/>";
			//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
		}elseif(!filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) {
			echo "<span class=\"red\">Email is invalid!</span><br/>";
			//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
		}elseif($pass != $pass2){
			echo "<span class=\"red\">The passwords not confered!</span><br/>";
			//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
		}elseif(strlen($_POST['pass']) < 6){
			echo "<div class='red'>The password must contain at least 6 characters</div>";
		}else{
		
			$login = addslashes(htmlentities($_POST['login']));
			$email = addslashes(htmlentities($_POST['email']));
			
			$searchAcc = $pdo->prepare("SELECT login FROM accounts WHERE login = '".$login."'");
				if($searchAcc->execute()){
					if($acc_confirm_email){ $status = 0; } else { $status = 1; }
					if($searchAcc->rowCount() != 0){
						echo "<span class=\"red\">Login is already in use!</span><br/>";
						//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
					}elseif($acc_multiple_email == false) {
							$searchEmail = $pdo->prepare("SELECT email FROM accounts WHERE email = '".$email."'"); // procura o email
							if($searchEmail->execute()){
								if($searchEmail->rowCount() != 0){
									echo "<span class=\"red\">Email is already in use!</span><br/>";
									//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
								}else{
									$reg1 = $pdo->prepare("INSERT INTO accounts (login, password, accessLevel, email)
											VALUES ('$login', '$pass', -1, '$email')");
									if($reg1->execute()){				
										if($reg1){
											echo "<span class=\"green\">Congrulations! Your account as been register!</span><br/>";
											if($acc_confirm_email){
												echo activeAccount($email, $login, $server_name, $server_email, $server_site);
											}
											//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
										}else{
											echo "<span class=\"red\">Ops! Error!</span><br/>";
											//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
										}
									}
								} // fim rowCount searchEmail
							} // fim execute searchEmail
					}else{
						$reg = $pdo->prepare("INSERT INTO accounts (login, password, access_level, email, status)
											VALUES ('$login', '$pass', -1, '$email', $status)");
						if($reg->execute()){				
							if($reg){
								echo "<span class=\"green\">Congrulations! Your account as been register!</span><br/>";
								if($acc_confirm_email){
									echo activeAccount($email, $login, $server_name, $server_email, $server_site);
								}
								//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
							}else{
								echo "<span class=\"red\">Ops! Error!</span><br/>";
								//echo "<a href=\"javascript:history.back();\" style=\"color: #282828 !important; font-weight: bold; \">Back to page of register</a>";
							}
						}
					}
				}// fim execute
		} // fim else
	} // fim all

?>

	<div class="register">
		<form action="./?page=register&register=go" method="post">
			<input type="text" class="dados" name="login" autocomplete="off" maxlength="16" placeholder="Login" required/>
			<input type="email" class="dados" name="email" autocomplete="off" maxlength="255" placeholder="Email" required/>
			<input type="password" class="dados" name="pass" autocomplete="off" maxlength="16" placeholder="Password" required/>
			<input type="password" class="dados" name="pass2" autocomplete="off" maxlength="16" placeholder="Re Password" required/>
			<br/><br/>
			<p>To register your concording with <a href="./?page=rules" target="_blank">rules</a> from server!<br/>
			I agree <input type="checkbox" name="terms"/><br/><br/></p>
			
			<input type="submit" class="go" value="Register now!"/>
		</form>
	</div>
		