jQuery(document).ready(function($) {
//	alert("in public");
	// get field IDs
        function getIDs(){
		
		$.ajax({
			type: "GET",
			url: "http://aria.cse.unr.edu/wp-content/plugins/ARIA/includes/aria_get_ids.php",
			success: function(result){
				alert("success "+result);
			}

		});
	}
        getIDs();
});
