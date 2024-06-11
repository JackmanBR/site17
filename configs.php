<?php
/* Arquivo de configuração do website
	Powered By Augusto César - NanyNha
	
	Visuartstudio Criação de Sites e Sistemas Web
	www.visuartstudio.com.br
*/

## Dados de conexão com o servidor
$host = 'localhost'; // endereço onde o servidor estiver hospedado (se for na mesma máquina do site, use 'localhost', se for num vps, use o IP)
$user = 'root'; // usuário do mysql - padrão: root
$pass = ''; // senha do mysql
$db = 'l2resistencia'; // database usada - padrão: l2jdb
$mysqlport = 3306; // porta mysql - padrão: 3306
$loginport = 2106; // porta do login server - padrão: 2106
$gameport = 7777; // porta do gameserver - padrão: 7777


/* NÃO MEXA NAS 3 PRÓXIMAS LINHAS */
$pdo = new PDO("mysql:host=$host;dbname=$db", "$user", "$pass"); 
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(!$pdo) { echo "Houve uma falha ao conectar com o servidor."; exit(); }



## Status do servidor na página inicial do site
// Forçar site a mostrar o status que você deseja
// Use 'on' para forçar a mostrar ON
// Use 'off' para forçar a mostrar OFF
// Use auto para mostrar automático
$force_login_status = 'on'; // padrão auto
$force_game_status = 'on'; // padrão auto
$force_geodata_status = 'on'; // padrão auto



## Destravar char
// Locs X, Y e Z
$loc_x = "83395"; // Padrão: 83257
$loc_y = "147954"; // Padrão: 149058
$loc_z = "-3409"; // Padrão: -3400




## Configurações gerais do site

## Dados Gerais
$server_name = 'L2BHASCARA';
$server_site = '127.0.0.1';
$serve_email = 'contato@visuartstudio.com.br';
$pagelike = 'https://www.facebook.com/L2JBrasil'; // link da página do facebook


## Manipulação de ACCOUNTS
// Cadastrar conta com mais de 1 email?
$acc_multiple_email = false; // padrão false

// Enviar confirmação da conta por email?
// OBS.: Apenas ATIVE se sua hospedagem tiver SMTP
$acc_confirm_email = true; // padrão false

// Enviar email de notificação quando alterar a senha?
// OBS.: Apenas ATIVE se sua hospedagem tiver SMTP
$acc_changepass_email = true; // padrão true




## TOPS PVP / PK
//limite de chars que aparecerão nos TOPS
$limit = 50; // padrão 50


## GMT
$gmt = 0; // Se o site estiver informando um horário adiantado ou atrasado, altere o GMT. Exemplo: -1 (-1 hora), +3 (+3 horas) e etc


?>