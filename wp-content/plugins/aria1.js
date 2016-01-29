	jQuery(document).ready(function($) {
		function getInput(){
			//var inp = $('#input_2').val();
			//alert(inp);
			alert("before function");
			$('#input_2').live("change", function() {
				alert("in function");
				alert("You chose " + $('#input_2').val());
			});
		}
	});
