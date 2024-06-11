<?php
	//if(file_exists('./configs.php')) { require_once './configs.php'; } else { require_once '../configs.php'; }

	// função enviar email ao trocar de senha
	function changePassSendEmail($email, $server_name, $server_email, $acc)
	{

		$data = date('d/m/Y H:m:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		$send = "
				The account $acc password was changed successfully in: $data
				<br /><br />
				IP: $ip
				";
				
		$recipient = $email;
		$subject = "Password changed in " . $server_name;
		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: text/html; charset=UTF-8\r\n";
		$header .= "From: $server_email\r\n";
		
		mail($recipient, $subject, $send, $header);
	}
	
	
	// funcao ativar acc
	function activeAccount($email, $login, $server_name, $server_email, $server_site)
	{
		$data = date('d/m/Y H:m:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		$send = "
				Thank you for register in $server_name <br />
				<br />
				Your account is inactive, to activate it, please click the link below:<br />
				<a href='$server_site?page=activeAccount&login=$login&email=$email' target='_blank'>Active Account now!</a> <br /><br /><br /><br />
				
				Att, Staff $server_name<br />
				IP: $ip
				";
				
		$recipient = $email;
		$subject = "Password changed in " . $server_name;
		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: text/html; charset=UTF-8\r\n";
		$header .= "From: $server_email\r\n";
		
		if(mail($recipient, $subject, $send, $header)){
			return "<div class='green'>Within moments you will receive an email to activate your account</div>";
		}
		
	}
	
	function randPassword($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = true)
	{		
		// Caracteres de cada tipo
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%*-';

		// Variáveis internas
		$retorno = '';
		$caracteres = '';

		// Agrupamos todos os caracteres que poderão ser utilizados
		$caracteres .= $lmin;
		if ($maiusculas) $caracteres .= $lmai;
		if ($numeros) $caracteres .= $num;
		if ($simbolos) $caracteres .= $simb;

		// Calculamos o total de caracteres possíveis
		$len = strlen($caracteres);

		for ($n = 1; $n <= $tamanho; $n++) {
		// Criamos um número aleatório de 1 até $len para pegar um dos caracteres
		$rand = mt_rand(1, $len);
		// Concatenamos um dos caracteres na variável $retorno
		$retorno .= $caracteres[$rand-1];
		}

		return $retorno;
		
	}
	
	// função esqueci minha senha - FORGOT Password
	function forgotPassword($email, $login, $server_name, $server_email, $server_site, $token)
	{
				
		$data = date('d/m/Y H:m:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		$send = "
				Forgot Password in $server_name <br />
				<br />
				To reset your password, please click the link below and follow the instructions:<br />
				<a href='$server_site?page=forgotPassword_go&login=$login&email=$email&tk=$token' target='_blank'>Reset Password!</a> <br /><br /><br /><br />
				
				Att, Staff $server_name<br />
				IP: $ip
				";
				
		$recipient = $email;
		$subject = "Forgot Password in " . $server_name;
		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: text/html; charset=UTF-8\r\n";
		$header .= "From: $server_email\r\n";
		
		if(mail($recipient, $subject, $send, $header)){
			return "<div class='green'>Within moments you will receive an email to reset your password.</div>";
		}	
	}









?>