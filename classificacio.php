<?php
global $wpdb;  
$table_name = $wpdb->prefix . "fck_pack";
$club_sel = $wpdb->get_var("SELECT valor FROM ".$table_name." WHERE descripcio='club'" );
//Dades a mostrar?
include("connexio.php");

if($cat == 1 || $cat == 2 || $cat == 3 || $cat == 'J'){
	$contant = mysql_query("SELECT * FROM clasificaciones WHERE categoria='{$cat}'", $db);
	$filas = mysql_num_rows($contant);
	if($filas > 0){
		$classificacio = '<table cellpadding="0" cellspacing="0">';
		$classificacio .= '<tr><th></th><th>Equip</th><th>PJ</th><th>PG</th><th>PE</th><th>PP</th><th>CF</th><th>CC</th><th>Punts</th></tr>';
		$pos = 1;
		$result = mysql_query("SELECT * FROM clasificaciones WHERE categoria='{$cat}' ORDER BY puntos DESC, manual, pj, dif DESC", $db);
		if($myrow = mysql_fetch_array($result)){
			do{
				$result_e = mysql_query("SELECT * FROM equipos WHERE id='".$myrow["equipo"]."'", $db);
				$myrow_e = mysql_fetch_array($result_e);
				
				if($myrow_e["club"] == $club_sel){echo '<tr style="background-color:#CCC;">';}else{echo "<tr>";}
				$classificacio .=  '<td width="20" align="center">'.$pos.'</td>';
				$classificacio .=  '<td width="200">'.$myrow_e["nombre"].'</td>';
				$classificacio .=  '<td width="20">'.$myrow["pj"].'</td>';
				$classificacio .=  '<td width="20">'.$myrow["pg"].'</td>';
				$classificacio .=  '<td width="20" align="center">'.$myrow["pe"].'</td>';
				$classificacio .=  '<td width="20" align="center">'.$myrow["pp"].'</td>';
				$classificacio .=  '<td width="20" align="center">'.$myrow["cf"].'</td>';
				$classificacio .=  '<td width="20" align="center">'.$myrow["cc"].'</td>';
				$classificacio .=  '<td width="20" align="center">'.$myrow["puntos"].'</td>';
				$classificacio .=  '</tr>';
				$pos++;
			}while($myrow = mysql_fetch_array($result));
		}
		$classificacio .=  '</table>';
	}else{
		$classificacio = 'Encara no hi ha dades';
	}
}else{
	$classificacio = 'Par&agrave;metre <strong>'.$cat.'</strong> no v&agrave;lid per al shortcode <strong>[classificacio cat="'.$cat.'"]</strong>';
}
?>