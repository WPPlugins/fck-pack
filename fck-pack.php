<?php  
/* 
Plugin Name: FCK Pack
Plugin URI: http://www.korfbal.cat
Description: FCK Pack (a Catalan Korfball Federation utilities pack) is an amount of utilities for the korfball catalan clubs and players, or anyone who wants to show events about the catalan league.
Version: 1.1
Author: Yuanga 
Author URI: http://www.unniks.com 
*/  
?>
<?
//Instalació i desinstalació
function fck_pack_instala(){
    global $wpdb;
	//Creem la taula fc_pack
    $table_name= $wpdb->prefix."fck_pack";
	$sql = "CREATE TABLE $table_name(id mediumint( 9 ) NOT NULL AUTO_INCREMENT , descripcio varchar(20), valor smallint(3) NOT NULL , PRIMARY KEY ( `id` )  ) ;";
    $wpdb->query($sql);
    $sql = "INSERT INTO $table_name (descripcio, valor) VALUES ('club', '0');";
    $wpdb->query($sql);
	$sql = "INSERT INTO $table_name (descripcio, valor) VALUES ('avisos', '0');";
    $wpdb->query($sql);
}
function fck_pack_desinstala(){
    global $wpdb;
    $table_name = $wpdb->prefix."fck_pack";
    $sql = "DROP TABLE $table_name";
    $wpdb->query($sql);
}
//Administrador NOU
function fck_pack_menu() {
	add_menu_page('Configuraci&oacute; FCK Pack', 'FCK Pack', 10, 'fck_pack_menu_id', 'club_select_fck_pack', plugins_url('/imatges/logo_16.png', __FILE__));
	add_submenu_page('fck_pack_menu_id', 'Shortcodes', 'Shortcodes', 10, 'fck_pack_menu_2', 'fck_pack_shortcodes_explanation' );
}
function fck_pack_shortcodes_explanation() {
	include("shortcode_expl.php");
}
//Instal·lació
if (function_exists('add_action')) {
    add_action('admin_menu', 'fck_pack_menu');
	register_activation_hook(__FILE__, 'fck_pack_instala');
	register_uninstall_hook(__FILE__, 'fck_pack_desinstala');
}
//Triar el club
function club_select_fck_pack(){
	//Dades wordpress
    global $wpdb;  
	$table_name = $wpdb->prefix . "fck_pack";
	
	//Insertem les dades noves, si n'hi ha
	if(isset($_POST['club_inserta'])){  
		 $sql = "UPDATE ".$table_name." SET valor = '{$_POST['club_inserta']}' WHERE descripcio='club';";
         $wpdb->query($sql);
		 $sql = "UPDATE ".$table_name." SET valor = '{$_POST['gestio_avisos']}' WHERE descripcio='avisos';";
         $wpdb->query($sql);
	}
	
	//Rescatem dades
    $club_sel = $wpdb->get_var("SELECT valor FROM ".$table_name." WHERE descripcio='club'" );
	$avisos_sel = $wpdb->get_var("SELECT valor FROM ".$table_name." WHERE descripcio='avisos'" );
	
	//Mostrem
	include("seleccio_club.php");
}
//Shortcode Classificació
function shortcode_fck_pack_classificacio($atts) {
	extract(shortcode_atts(array(
		  'cat' => '1',
     ), $atts));
	include("classificacio.php");
	return $classificacio;
}
add_shortcode('classificacio', 'shortcode_fck_pack_classificacio');
//Widget Propers partits
function widget_propers_partits($args) {
	$data = get_option('widget_propers_partits');
	extract($args);

	echo $before_widget;
	echo $before_title;
	if($data['titol_widget'] == ''){
		echo 'Propers partits';
	}else{
		echo $data['titol_widget'];
	}
	echo $after_title;
	include("propers_partits.php");
	echo $after_widget;	
}
function init_widget_propers_partits(){
	$options = array('description' => 'Mostra els seg&uuml;ents partits dels equips del teu club.');
	wp_register_sidebar_widget("propers_partits_ID", "FCKP - Propers partits", "widget_propers_partits", $options);
	wp_register_widget_control("propers_partits_ID", "FCKP - Propers partits", "widget_propers_partits_control");
}
function widget_propers_partits_control(){		
	if(isset($_POST['titol_widget'])){
		$data['titol_widget'] = attribute_escape($_POST['titol_widget']);
		$data['primera_div'] = attribute_escape($_POST['primera_div']);
		//$data['segona_div'] = attribute_escape($_POST['segona_div']);
		update_option('widget_propers_partits', $data);
	}
	$data = get_option('widget_propers_partits');
	?>
	<label for="titol_widget">T&iacute;tol:</label><br /><input name="titol_widget" type="text" value="<?php echo $data['titol_widget']; ?>" /><br /><br />
	<?php
}
add_action("plugins_loaded", "init_widget_propers_partits");
?>