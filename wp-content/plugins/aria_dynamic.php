<?php
require_once('aria_testing_for_form.php'); 
$arr = aria_teacher_field_id_array();
$data = $arr[$_POST['data']];
echo $data;
?>