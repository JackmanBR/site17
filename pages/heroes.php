<h1>Heroes</h1>
<h4>Current Heroes</h4>

<div class="scroll">
	<table class="rank">
		<tr class="destaque">
			<td>Nome</td>
			<td>Victories</td>
			<td>Clan</td>
			<td>Class</td>
		</tr>
		<?php
			$ij	= 1;
				$oly = $pdo->query("SELECT H.char_name, H.count as qtd, CT.ClassName, CD.clan_name FROM heroes H
								LEFT JOIN char_templates CT ON CT.ClassId = H.class_id
								LEFT JOIN characters CH ON CH.obj_Id = H.char_id 
								LEFT JOIN clan_data CD ON CD.clan_id = CH.clanid");
				
				if($oly->execute()){
				while($o = $oly->fetch(PDO::FETCH_OBJ)){ 
		?>
				<tr<?php if($ij % 2 == 0) { echo " <class=\"one\""; } else { echo " <class=\"two\""; }?>>
					<td><?php echo $o->char_name; ?></td>
					<td><?php echo $o->qtd; ?></td>
					<td><?php if($o->clan_name == '') { echo "-"; } else { echo $o->clan_name; } ?></td>
					<td><?php echo $o->ClassName; ?></td>
				</tr>
		<?php
		$ij++;
				} // fim while
		} // fim execute
		?>

	</table>
</div>