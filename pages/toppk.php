<h1>Top PK</h1>
<h4>Below are listed the more than <?php echo $limit; ?> players have pvp point!</h4>

<div class="scroll">
	<table class="rank">
		<tr class="destaque">
			<td>Pos</td>
			<td>Nome</td>
			<td>Clan</td>
			<td>PK's</td>
		</tr>
		<?php
			$ij	 = 1;
			$tpk = $pdo->query("SELECT C.char_name, C.pkkills, CL.clan_name FROM characters C
				LEFT JOIN clan_data CL ON CL.clan_id = C.clanid
				WHERE C.accesslevel = 0 ORDER BY C.pkkills DESC LIMIT $limit");
			while($l = $tpk->fetch(PDO::FETCH_OBJ)){	
		?>
		<tr<?php if($ij % 2 == 0) { echo " <class=\"one\""; } else { echo " <class=\"two\""; }?>>
			<td><?php echo $ij . " º "; ?></td>
			<td><?php echo $l->char_name; ?></td>
			<td><?php if($l->clan_name == '') { echo "-"; } else { echo $l->clan_name; } ?></td>
			<td><?php if($l->pkkills > 0) { echo $l->pkkills; } else { echo "0"; } ?></td>
		</tr>
		<?php
		$ij++;
		}
		?>

	</table>
</div>