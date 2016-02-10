<?php
	require_once("class-aria-create-competition.php");
	$teacher_fields = ARIA_Create_Competition::aria_teacher_field_id_array();
	echo json_encode($teacher_fields);
?>
