<?php
session_cache_expire(5);
session_start();
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');
require_once './configs.php';
require_once './functions.php';
#session_name(md5($server_name.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

	<!--
	
	Site Criado e Desenvolvido por Augusto César - NaNyNhA
	Visuartstudio Criação de Sites e Sistemas Web
	www.visuartstudio.com.br
	
	-->

	<meta charset="UTF-8">
	<title>Lineage2 Bhascara</title>
	<meta name="keywords" content="l2Valiance, games, Valiance, l2, lineage, lineage2, lineage 2, lainiege, laineage, lainiage, lineage dois, lineage ii, l2off, servidor l2off, server l2off, interlude, 1000x, free fun, diversao gratis, new server, novo servidor, o melhor servidor de lineage 2, o melhor servidor" />
	<meta name="description" content="Lineage 2 Bhascara, o melhor server privado br. " />
	<link rel="shortcut icon" href="imgs/favicon.ico">
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/facebook.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="./js/jquery.cookie.js"></script>
	<script src="./js/facebook.js"></script>

	<meta name="author" content="Paulo Guerra" />
	<meta name="reply-to" content="contato@contato" />
	<meta name="city" content="Recife-PE" />
	<meta name="country" content="Brasil" />
	<meta name="language" content="Portuguese" />
	<meta name="copyright" content="Paulo Guerra" />
	<meta name="publisher" content="Paulo Guerra" />
	<meta name="distribution" content="Global" />

	<script>
		(function(i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function() {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-51361242-1', 'auto');
		ga('send', 'pageview');
	</script>

</head>

<body>
	<div id="fanback">
		<div id="fan-exit"></div>
		<div id="fanbox">
			<div id="fanclose"></div>
			<div class="remove-borda"></div>
			<iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $pagelike; ?>&amp;width=402&amp;height=255&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23E2E2E2&amp;stream=false&amp;header=false&amp;appId=502894203121528" scrolling="no" frameborder="0" style="border: none; overflow: hidden; margin-top: -19px; width: 402px; height: 230px;margin-left: 8px;" allowTransparency="true"></iframe>
		</div>
	</div>

	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=1535382866723941&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<?php
	if (isset($_GET['login']) && $_GET['login'] == 'go') {
		if (isset($_POST['login']) && !empty($_POST['login']) && ($_POST['login'] != '') && isset($_POST['senha']) && !empty($_POST['senha']) && ($_POST['senha'] != '')) {
			$login = addslashes(htmlentities($_POST['login']));
			$senha = base64_encode(pack('H*', sha1($_POST['senha'])));
			$search = $pdo->query("SELECT login, email, password FROM accounts WHERE login = '$login' AND password = '$senha'");
			if ($search->execute()) {
				if ($search->rowCount() == 1) {
					$l = $search->fetch(PDO::FETCH_OBJ);
					$_SESSION['ucp']['login'] = $login;
					$_SESSION['ucp']['email'] = $l->email;
					echo "<script>location.href='./';</script>";
				} else {
					echo "<script>location.href='./';</script>";
				}
			}
		} else {
			echo "<script>location.href='./';</script>";
		}
	} elseif (isset($_GET['logout'])) {
		unset($_SESSION['ucp']['login']);
		unset($_SESSION['ucp']['email']);
		session_destroy();
		echo "<script>location.href='./';</script>";
	}
	?>
	<div id="all">
		<header>
			<div class="logo"></div>
		</header>
		<div id="conteudo">
			<div class="area935">
				<!-- Menu Principal -->
				<nav id="menu">
					<a href="./" class="sp1"></a>
					<div class="sp2">
						<ul class="drop">
							<li><a href="./?page=information">Server</a></li>
							<li><a href="./?page=rules">Rules</a></li>
							<li><a href="./?page=donater">Donations</a></li>
							<li class="dropst">Statistics <span> > </span>
								<ul class="drop2">
									<li><a href="./?page=toppvp">Top PVP</a></li>
									<li><a href="./?page=toppk">Top PK</a></li>
									<li><a href="./?page=raidboss">Raid Boss</a></li>
									<li><a href="./?page=castlesiege">Castle Siege</a></li>
									<li><a href="./?page=heroes">Heroes</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<a href="./?page=downloads" class="sp3"></a>
					<a href="./?page=register" class="sp4"></a>
					<div class="sp5">
						<ul class="drop">
							<li><a href="#">Forum</a></li>
							<li><a href="#">Fanpage</a></li>
						</ul>
					</div>
				</nav> <!-- end menu -->


				<div class="conteudo_all">

					<div class="lateral left">
						<div class="cpanel">
							<div class="bloco">
								<?php if (isset($_SESSION['ucp']) && count($_SESSION['ucp']) > 0) { ?>
									<a href="./?page=ucp_changepass"><button type="button" class="btpanel">Change password</button></a>
									<a href="./?page=ucp_destravar"><button type="button" class="btpanel">Unlock Char</button></a>
									<a href="./?logout=true"><button type="button" class="btpanel">Logout</button></a>
								<?php
								} else {
								?>

									<form action="?login=go" method="POST">
										<div class="log"><input type="text" name="login" placeholder="Login" autocomplete="off" maxlength="16" required /></div>
										<div class="pwd"><input type="password" name="senha" placeholder="******" autocomplete="off" maxlength="16" required /></div>

										<div class="go"><input type="submit" value="" /></div>
									</form>

									<p><a href="./?page=register">Não tem conta?</a></p>
									<p><a href="./?page=forgot">esqueceu a senha?</a></p>

								<?php } ?>
							</div>
						</div> <!-- end cpanel -->


						<!-- blocos de menu  -->
						<a href="./?page=castlesiege" class="cs"></a>
						<a href="./?page=raidboss" class="rb"></a>
						<a href="./?page=heroes" class="oh"></a>
						<!-- end blocos de menu -->

						<!-- Gallery -->
						<div class="gallery">
							<!--<div class="title"></div>-->
							<h3>Staff</h3>
							<?php
							$staff = $pdo->query("SELECT char_name, online FROM characters WHERE accesslevel > 0");
							if ($staff->execute()) {
								while ($st = $staff->fetch(PDO::FETCH_OBJ)) {
							?>
									<p<?php if ($st->online == 1) {
											echo " class='on'";
										} else {
											echo " class='off'";
										} ?>><?php echo $st->char_name; ?></p>
								<?php
								} // fim while
							} ?>
						</div>
						<!--
						<div style="margin-top:20px;margin-left:10px;" class="fb-like-box voteBox" data-href="https://www.facebook.com/L2JBrasil" data-width="218" data-height="200" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="true" data-show-border="true"></div>
						-->
						<!-- end Galelry -->


					</div> <!-- end lateral esquerda -->


					<div class="central_area">
						<div class="central425">
							<!-- area 360px largura -->
							<?php
							// http://www.l2jbrasil.com/index.php?/topic/102823-script-de-paginacao-anti-sql-inject/page__hl__string#entry665654
							//Script de paginação anti SQL inject
							// Créditos: Ivan Pires

							$pasta = "pages/";       // Caminho da pasta onde estão os seus arquivos PHP
							$home = "home";         // Página principal
							#======== Não edite daqui para baixo ========#
							$pags_array = array();
							$diretorio = dir($pasta);
							while ($arquivo = $diretorio->read()) {
								if ($arquivo != "." && $arquivo != "..") {
									array_push($pags_array, str_replace(".php", "", $arquivo));
								}
							}
							$diretorio->close();
							$pagina = !empty($_GET["page"]) ? trim($_GET["page"]) : $home;
							if (!in_array($pagina, $pags_array)) {
								$pagina = $home;
							}
							if (isset($pagina)) {
								if (file_exists($pasta . $pagina . '.php')) {
									@include_once($pasta . $pagina . ".php");
								} else {
									session_destroy();
									echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=./'>";
								}
							} else {
								@include_once($pasta . $home . ".php");
							}
							?>
						</div> <!-- fim central 425px -->
					</div><!-- fim central_area -->


					<div class="lateral right">
						<?php


						?>
						<div class="status">
							<div class="serverstatus">
								<div class="sv">
									<p>Login Server:</p>
									<p>Game Server:</p>
									<p>Geodata:</p>
								</div>
								<div class="sinal">
									<?php
									// loginserver
									if ($force_login_status == 'on') {
										echo "<p class='on' style='color: green'>ON</p>";
									} elseif ($force_login_status == 'off') {
										echo "<p class='off' style='color: red'>OFF</p>";
									} else {
										$login = @fsockopen($host, $loginport, $errno, $errstr, 1);
										if ($login == 1) {
											echo "<p class='on' style='color: green'>ON</p>";
										} else {
											echo "<p class='off' style='color: red'>OFF</p>";
										}
									}
									// gameserver
									if ($force_game_status == 'on') {
										echo "<p class='on' style='color: green'>ON</p>";
									} elseif ($force_game_status == 'off') {
										echo "<p class='off' style='color: red'>OFF</p>";
									} else {
										$game = @fsockopen($host, $gameport, $errno, $errstr, 1);
										if ($game == 1) {
											echo "<p class='on' style='color: green'>ON</p>";
										} else {
											echo "<p class='off' style='color: red'>OFF</p>";
										}
									}
									// geodata
									if ($force_geodata_status == 'on') {
										echo "<p class='on' style='color: green'>ON</p>";
									} elseif ($force_geodata_status == 'off') {
										echo "<p class='off' style='color: red'>OFF</p>";
									} else {
										echo "<p class='off' style='color: red'>OFF</p>";
									}
									?>
								</div>
							</div> <!-- fim serverstatus -->
						</div> <!-- fim status -->


						<div class="toppvp">
							<div class="top5">
								<?php
								$i = 1;
								$top5pvp = $pdo->prepare("SELECT char_name, pvpkills, accesslevel FROM characters WHERE accesslevel = 0 ORDER BY pvpkills DESC LIMIT 5");
								if ($top5pvp->execute()) {
									while ($top5 = $top5pvp->fetch(PDO::FETCH_OBJ)) {
								?>

										<div class="char_name">
											<?php echo "<span style='color: #5d432e'>" . $i . "º</span> " . "&nbsp;" . $top5->char_name; ?>
										</div>
										<div class="pvps">
											<?php echo $top5->pvpkills; ?>
										</div>
								<?php $i++;
									} // end while
								} // fim execute()
								?>
							</div> <!-- fim top 5 -->
							<a href="./?page=toppvp" class="viewall">&rarr; View all</a>
						</div> <!-- fim top pvp -->


						<div class="toppk">
							<div class="top5">

								<?php
								$j = 1;
								$top5pk = $pdo->query("SELECT char_name, pkkills FROM characters ORDER BY pkkills DESC LIMIT 5");
								if ($top5pk->execute()) {
									while ($top = $top5pk->fetch(PDO::FETCH_OBJ)) {
								?>

										<div class="char_name">
											<?php echo "<span style='color: #5d432e'>" . $j . "º</span> " . "&nbsp;" . $top->char_name; ?>
										</div>
										<div class="pvps">
											<?php echo $top->pkkills; ?>
										</div>
								<?php $j++;
									} // end while
								} // fim execute()
								?>
							</div> <!-- fim top pk 5 -->
							<a href="./?page=toppk" class="viewall">&rarr; View all</a>
						</div> <!-- fim top pk -->

						<div class="vote">
							<a href="#" title="Vote e ganhe Itens!"></a>
						</div> <!-- end votesystem -->

					</div> <!-- fim  lateral direita -->

				</div> <!-- fim conteudo_all -->

			</div> <!-- fim area 935px -->

		</div> <!-- fim conteudo -->

	</div> <!-- fim all -->


	<footer>
		<p>Lineage2 Bhascara &copy; Private Server &rarr; Todos os direitos reservados!</p>
		<p>Desenvolvidor por &rarr; PAULO GUERRA - 2024.</p>
	</footer>


</body>

</html>