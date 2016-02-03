<?php
function aria_teacher_field_id_array() {
  // CAUTION, This array is used as a source of truth. Changing these values may
  // result in catastrophic failure. If you do not want to feel the bern, 
  // consult an aria developer before making changes to this portion of code.
  $arr = array(
  'name' => 1,
  'email' => 2,
  'phone' => 3,
  'volunteer_preference' => 4,
  'volunteer_time' => 5,
  'student_name' => 6,
  'song_1_period' => 7,
  'song_1_composer' => 8,
  'song_1_selection' => 9,
  'song_2_period' => 10,
  'song_2_composer' => 11,
  'song_2_selection' => 12,
  'theory_score' => 13,
  'alternate_theory' => 14,
  'competition_format' => 15,
  'timing_of_pieces' => 16
  );
  return $arr;
}
function aria_get_music_database_form_id() {
	$nnmta_music_database_form_name = 'NNMTA Music Database';
	$nnmta_music_database_form_id = NULL;
	$all_active_forms = GFAPI::get_forms(); 

	foreach ($all_active_forms as $form) {
		if ($form['title'] === $nnmta_music_database_form_name) {
			$nnmta_music_database_form_id = $form['id']; 
		}
	}

	if (!isset($nnmta_music_database_form_id)) {
		wp_die('Form ' . $nnmta_music_database_form_name . ' does not exist. Please create it and try again.');
	}

	return $nnmta_music_database_form_id; 
}
$arr = aria_teacher_field_id_array();
$data = isset($_POST['data']) ? $arr[$_POST['data']] : '';
$data = aria_get_music_database_form_id();
echo $data;
?>