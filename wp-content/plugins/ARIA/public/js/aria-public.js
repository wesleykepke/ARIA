jQuery(document).ready(function($) {
//	alert("in public");
	
	// get field IDs function
        function get_ids(){
		var idResult, temp;	
		$.ajax({
			type: "GET",
			url: "http://aria.cse.unr.edu/wp-content/plugins/ARIA/includes/aria_get_ids.php",
			async: false,

			success: function(result){
				temp = result;
			}

		}).then( function(){
			idResult = JSON.parse(temp);
		});
		return idResult;
	
	}

	// !!! get form ids
	var teacher_form_id = '252';
	var music_form_id = '';

	// get field ids
        var field_id_arr = get_ids();
		//alert( field_id_arr['name'] );

	// get student level
	var input_pre = '#input_' + teacher_form_id + '_';
	
	var st_level_field = input_pre + field_id_arr['student_level'];
	var st_level;
	alert(st_level_field);
	$(st_level_field).live("change", function() {
		st_level = $(st_level_field).val();
			alert( st_level );
	});
	// request for all songs of given level

		// if level 11, request for 9 and 10
});
