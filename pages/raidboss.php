<h1>RaidBoss</h1>
</br></br>

<h4>List of Grand Bosses</h4>
<div class="scroll">
	<div style="height: 280px; overflow: scroll;">
	
	<table class="rank">
		<tr class="destaque">
			<td>Grand Boss</td>
			<td>Level</td>
			<td>Status</td>
			<td>Respawn</td>
		</tr>
		<?php
			$ij = 1;
			$gb = $pdo->query("SELECT NPC.name, NPC.level, GB.respawn_time 
							FROM npc NPC LEFT JOIN grandboss_data GB ON NPC.type = 'L2GrandBoss'
							 WHERE NPC.id = GB.boss_id GROUP BY NPC.name ORDER BY NPC.level");
				if($gb->execute()){
				while($d = $gb->fetch(PDO::FETCH_OBJ)){	
				
						//tempo do grand boss
					if($d->respawn_time > 0) { 
						$rsp = date('d/m/Y H:i',($d->respawn_time/1000));
						$status = "<span class='off'>Dead</span>";
					}else {
						$status = "<span class='on'>Live</span>";
						$rsp = "-";
					}	
			?>
			<tr<?php if($ij % 2 == 0) { echo " <class=\"one\""; } else { echo " <class=\"two\""; }?>>
				<td><?php echo $d->name; ?></td>
				<td><?php echo $d->level; ?></td>
				<td><?php echo $status; ?></td>
				<td><?php echo $rsp; ?></td>
			</tr>
			<?php
			$ij++;
				} // fim while
			} // fim execute()
		?>
	</table>
	</div>
		<!-- Raid Bosses -->
	<h4 style=" margin-top: 20px;">List of Raid Bosses</h4>
	<div style="height: 280px; overflow: scroll;">
	
	<table class="rank">
		<tr class="destaque">
			<td>Raid Boss</td>
			<td>Level</td>
			<td>Status</td>
			<td>Respawn</td>
		</tr>
		<?php
			$ij = 1;
			$rb = $pdo->query("SELECT NPC.name, NPC.level, GB.respawn_time 
						FROM npc NPC LEFT JOIN raidboss_spawnlist GB ON NPC.type = 'L2RaidBoss'
						WHERE NPC.id = GB.boss_id ORDER BY NPC.level DESC");
				if($rb->execute()){
					while($r = $rb->fetch(PDO::FETCH_OBJ)){	
			
					//tempo do grand boss
				if($r->respawn_time > 0) { 
					$rsp = date('d/m/Y H:i',($r->respawn_time/1000));
					$status = "<span class='off'>Dead</span>";
				}else {
					$status = "<span class='on'>Live</span>";
					$rsp = "-";
				}	
		?>
		<tr<?php if($ij % 2 == 0) { echo " <class=\"one\""; } else { echo " <class=\"two\""; }?>>
			<td><?php echo $r->name; ?></td>
			<td><?php echo $r->level; ?></td>
			<td><?php echo $status; ?></td>
			<td><?php echo $rsp; ?></td>
		</tr>
		<?php
		$ij++;
			}// fim while
		} // fim execute() 
		?>

	</table>
	</div>
</div>