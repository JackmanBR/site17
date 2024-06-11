<?php
if(isset($_GET['login']) && ($_GET['login'] != '') && !empty($_GET['login']) && isset($_GET['email']) && ($_GET['email'] != '') && !empty($_GET['email'])){
	echo "<h1>Active Account</h1>";
	$login = addslashes(htmlentities($_GET['login']));
	$email = addslashes(htmlentities($_GET['email']));
	
	$search = $pdo->query("SELECT login, email, status FROM accounts WHERE login = '$login' AND email = '$email'");
	if($search->execute()){
		if($search->rowCount() == 1){
			$l = $search->fetch(PDO::FETCH_OBJ);
			if($l->status == 0){
				$active = $pdo->prepare("UPDATE accounts SET status = 1, access_level = 0 WHERE login = '$login' AND email = '$email'");
				if($active->execute()){
					if($active){
						echo "<div class='green'>Account successfully activated!</div>";
					}else{
						echo "<div class='red'>Ops... error!</div>";
					}
				}
			}else{
				echo "<div class='red'>You have already activated your account!</div>";
			}
			
		}else{
			echo "<div class='red'>Invalid data!</div>";
		}
	}
	
}else{
	echo "<script>location.href='./';</script>";
}

?>