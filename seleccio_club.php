<?
echo '<div class="wrap">';
echo '<div id="icon-options-general" class="icon32"><br /></div>';
echo '<h2>Formulari de selecci&oacute; de club</h2>';
if(!($db = mysql_connect("localhost", "wpuser", "HCYiBug2"))){
	echo 'Base de dades no disponible!<br />'; 
	exit(); 
}
if(!(mysql_select_db('fck1213',$db))){
	echo 'Base de dades no disponible!<br />'; 
	exit(); 
}
?>
<form method="post">
	<table class="form-table">
		<tr>
			<th><label>Selecciona el teu club</label></th>
			<td>
				<select name="club_inserta">
					<option value="0" style="background:#FCC;">--No utilitzar dades de clubs--</option>
					<?
					$result = mysql_query("SELECT * FROM clubs WHERE actius='S' ORDER BY nombre", $db);
					if($myrow = mysql_fetch_array($result)){
						do{
							echo '<option value="'.$myrow["id"].'" ';
							if($club_sel == $myrow["id"]){echo 'selected';}
							echo '>'.$myrow["nombre"].'</option>';
						}while($myrow = mysql_fetch_array($result));
					}
					?>
				</select><br />
				<span class="description">Selecciona el teu club.</span>
			</td>
		</tr>
		<!--
		<tr>
			<th><label>Activar avisos als jugadors</label></th>
			<td>
				<input type="checkbox" name="gestio_avisos" value="1" <? if($avisos_sel == 1){echo 'checked="checked"';} ?> />
			</td>
		</tr>
		-->
	</table>
	<br />
	<?
	/*
	AVISOS ALS JUGADORS  
	*/
	if($avisos_sel == 1){
		echo '<h3>Avisos als jugadors</h3>';
		echo 'Avisos activats<br />';
	}
	?>
	<br />
	<input type="submit" name="enviar" value="Actualitzar" class="button-primary" />
</form>
<?
echo '</div>';
?>