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
	if(isset($_GET['action']) && ($_GET['action'] == 'go') && $_GET['action'] != ''){

		$char_id = addslashes(htmlentities($_POST['char']));

		if(($char_id == '') || empty($char_id) || !isset($char_id)){
			echo '<div class="red">Ops.. Error!</div>';
		}else{
			$searchChar = $pdo->prepare("SELECT karma, online FROM characters WHERE obj_Id = $char_id AND account_name = '".$_SESSION['ucp']['login']."'");
			if($searchChar->execute()){
				if($searchChar->rowCount() == 1){
					$c = $searchChar->fetch(PDO::FETCH_OBJ);
					if($c->karma != 0){
						echo '<div class="red">Your character is with karma!</div>';
					}elseif($c->online != 0){
						echo '<div class="red">Your character is online, please logout!</div>';
					}else{
						$unlock = $pdo->query("UPDATE characters SET x = '$loc_x', y = '$loc_y', z = '$loc_z' WHERE account_name = '".$_SESSION['ucp']['login']."'");
						if($unlock->execute()){
							if($unlock){
								echo '<div class="green">Char unlocked successfully!</div>';
							}else{
								echo '<div class="red">Ops.. Error!</div>';
							}
						}
					}
				}else{
					echo "nao";
				}
			}
		}
	}
	?>
	<div class="register">
		<form action="./?page=ucp_destravar&action=go" method="post">
			<p style="color: red; text-shadow: 0px 0px 10px red; font-weight: bold;">The function does not work if your character is with karma or online!</p><br/><br/>
			Select character:
			<select class="dados" name="char" required>
				<?php
					$char = $pdo->query("SELECT obj_Id, char_name FROM characters WHERE account_name = '".$_SESSION['ucp']['login']."'");
					while($l = $char->fetch(PDO::FETCH_OBJ)){
				?>
				<option value="<?php echo $l->obj_Id; ?>"><?php echo $l->char_name; ?></option>
				<?php } ?>
			</select>
			<br/><br/>			
			<input type="submit" class="go" value="Unlock!"/>
		</form>
	</div>
		