jQuery(document).ready(function($) {
	// Get music form ID - Need to make this dynamic
	var musicFormID = '184';

	// Get field IDs - Combine these into one function?
	var levelID = getLevelFieldID();
	var periodID = getPeriodID();
	var composerID = getComposerID();
	var nameID = getNameID();

	// Hard coded
	levelID = '4';
	periodID = '5';
	composerID = '3';
	nameID = '2';

	// Get student level
	var level = $('#input_15_3').val();	

	// Get song entries from level
	getMusic( musicFormID, level, levelID);

	// Song 1

		// If period changes

			// (Re)load composers

			// Clear songs

		// If composer changes

			// (Re)load songs

	// Song 2

			// If period changes

			// (Re)load composers

			// Clear songs

		// If composer changes

			// (Re)load songs


	// Function defs
	function getMusic( musicFormID, level, levelID){

        var d = new Date,
        expiration = 3600,
        unixtime = parseInt( d.getTime() / 1000 ),
        future_unixtime = expiration + unixtime,
        //nnmta_public_key = "0035d1a323",
		//nnmta_private_key = "f2d4546aab2c06a",
		public_key = "1ff591984b",
        private_key = "c4efb4676e0d6a6",
        method = "GET",
        route = "forms/" + musicFormID + "/entries";

        stringToSign = public_key + ":" + method + ":" + route + ":" + future_unixtime;

        sig = CalculateSig( stringToSign, private_key );
        url = "http://aria.cse.unr.edu/gravityformsapi/" + route;
		url += "/?api_key=" + public_key;
		url += "&signature=" + sig + "&expires=" + future_unixtime;

		//NOTE: key in search is just field ID not formID.fieldID
		// search for entry[levelID] == level
		var search = {
				field_filters : [
					{
					key: levelID,
					operator: 'is',
					value: level
					}
				],
				mode : 'all'
		}
		
		var searchJSON = JSON.stringify( search );

		//NOTE: paging requires &
		//NOTE: max page size?
		url += '&paging[page_size]=300' + '&search=' + searchJSON;
		url += '&sorting[key]=3&sorting[direction]=ASC';

		$.get( url,  function( result ){
			var html = '';
			var option;
			// Populate with composers
			result['response']['entries'].forEach( function(entry){
				var composer = entry[composerID];
				if( html.indexOf( composer ) == -1 && entry[levelID] == level && )
				{
					html += '<option value="' + composer + '">' + composer + '</option>';
				}
			});	

			// Clear options and append new options
			$('#input_15_4').empty();
			$('#input_15_4').append(html);
		});

	}// end of getMusic function


	function getLevelFieldID(){
			dataString = 'student_level'; 
			var returnedValue;
			$.ajax({
	            type: "POST",
	            url: "http://aria.cse.unr.edu/wp-content/plugins/aria_dynamic.php",
	            data: {data : dataString}, 
	            cache: false,

	            success: function(result) {
	                returnedValue = result;
	            }
	        });

	        // NOTE: HARDCODED FOR TESTING
	        returnedValue = '4';
	        return returnedValue;
	}// end of getLevelFieldID

});