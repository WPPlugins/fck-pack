<?
echo '<div class="wrap">';
echo '<div id="icon-options-general" class="icon32"><br /></div>';
echo '<h2>Shortcodes</h2>';
echo '<h3>Classificacions</h3>';
echo 'Pots afegir la taula de la classificaci&oacute; d\'un equip del teu club afegint el shortcode <em>[classificacio]</em> a la p&agrave;gina o entrada que desitgis. Per defecte es mostrar&agrave; la classificaci&oacute; de la Lliga Nacional, per&ograve; pots triar la categoria que prefereixis modificant el shortcode amb el par&agrave;metre "cat" de la seg&uuml;ent manera: <blockquote><strong>[classificacio cat="2"]</strong></blockquote>El valor d\'aquest par&agrave;metre pot ser:<br /><br />';
?>
<table width="200" border="1" cellpadding="3" cellspacing="0">
	<tr>
		<th>Valor</th><th>Categoria mostrada</th>
	</tr>
	<tr><td align="center">1</td><td>Lliga Nacional</td>
	<tr><td align="center">2</td><td>Segona divisi&oacute;</td>
	<tr><td align="center">3</td><td>Tercera divisi&oacute;</td>
	<tr><td align="center">J</td><td>Lliga j&uacute;nior</td>
</table>
<?
echo '</div>';
?>