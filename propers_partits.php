<?php
$avui = date("Y-m-d");
global $wpdb;
$table_name = $wpdb->prefix."fck_pack";

$club_sel = $wpdb->get_var("SELECT valor FROM ".$table_name." WHERE descripcio='club'" );
echo '<ul>';
include("connexio.php");
$result = mysql_query("SELECT * FROM equipos WHERE club=$club_sel AND actius='S'", $db);
if($myrow = mysql_fetch_array($result)){
	do{
		$id_del_equip = $myrow["id"];
		$result_next = mysql_query("SELECT * FROM partido WHERE (local=$id_del_equip OR visitante=$id_del_equip) AND fecha>='$avui' ORDER BY fecha", $db);
		echo '<li style="list-style-image: url('.plugin_dir_url(__FILE__).'/imatges/fletxa.gif);"><strong>';
		$result_cat = mysql_query("SELECT * FROM categoria WHERE nova='".$myrow["nova"]."'", $db);
		$myrow_cat = mysql_fetch_array($result_cat);
		echo $myrow_cat["nom"].'</strong><br />';
		if($myrow_next = mysql_fetch_array($result_next)){
			if($myrow_next["local"] == $id_del_equip){
				$local = '<strong>'.$myrow["sigles"].'</strong>';
			}else{
				$result_l = mysql_query("SELECT * FROM equipos WHERE id=".$myrow_next["local"], $db);
				$myrow_l = mysql_fetch_array($result_l);
				$local = $myrow_l["nombre"];
			}
			if($myrow_next["visitante"] == $id_del_equip){
				$visitant = '<strong>'.$myrow["sigles"].'</strong>';
			}else{
				$result_v = mysql_query("SELECT * FROM equipos WHERE id=".$myrow_next["visitante"], $db);
				$myrow_v = mysql_fetch_array($result_v);
				$visitant = $myrow_v["nombre"];
			}
			echo $local.' - '.$visitant;
		}else{
			echo 'Sense partits a la vista!';
		}
		echo '</li>';
	}while($myrow = mysql_fetch_array($result));
}
echo '</ul>';
?>