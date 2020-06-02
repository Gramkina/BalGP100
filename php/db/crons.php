<?php
	$mysqli = new mysqli('localhost', 'andrikz0_polik', 'Asdfg123', 'andrikz0_polik');
	$mysqli->query('DELETE FROM vr_reg WHERE time < '.time());
	$mysqli->query('DELETE FROM Change_Password WHERE Time < '.time());
	$mysqli->query('DELETE FROM tokens WHERE time < '.time());
	$mysqli->query('DELETE FROM vr_zapisi WHERE timeDelete < '.time());
	$mysqli->close();
?>