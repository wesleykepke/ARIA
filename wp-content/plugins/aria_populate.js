jQuery(document).ready(function($) {
	// Get music form ID - Need to make this dynamic
	var musicFormID = '184';
	var currFormID = '15';

	// Get field IDs - Combine these into one function?
	// From current form
	var levelField = '3';//= getLevelFieldID();
	var periodField1 = '6';
	var periodField2;
	var compField1 = '4';
	var compField2;
	var songField1 = '7';
	var songField2;

	// From music data
	var dataLevelField = '4';
	var dataPeriodField = '5'; // = getPeriodID();
	var dataCompField = '3';// getComposerID();
	var dataSongField = '2';//getNameID();

	// Hard coded
/*	levelID = '4';
	periodID = '5';
	composerID = '3';
	nameID = '2';*/

	// Get student level
	var level = '1';//$('#input_15_3').val();	

	// Get song entries from level
		var resultMusic;
	getMusic( musicFormID, level, dataLevelField);

	// Song 1

		// If period changes
		var inputPeriod1 = '#input_' + currFormID + '_' + periodField1;
		var valPeriod1;
			$(inputPeriod1).live("change", function() {
				valPeriod1 = $(inputPeriod1).val();	
				alert( typeof(music));

				// (Re)load composers
				loadComposers(music, valPeriod1);

			// Clear songs
			});

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
			resultMusic = result['response']['entries'];
		}, 'json');
			alert(typeof(resultMusic));
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

	function CalculateSig(stringToSign, privateKey){
		var hash = CryptoJS.HmacSHA1(stringToSign, privateKey);
		var base64 = hash.toString(CryptoJS.enc.Base64);
		return encodeURIComponent(base64);
	}// end of CalcSig

	function loadComposers(musicData, period){
		var inputComposer = '#input_' + currFormID + '_' + compField1;// !!Need to change from hard coded
		var html = '';

		// Populate with composers
		musicData.forEach( function(entry){
			var composer = entry[dataCompField];
			if( entry[dataPeriodField] == period && html.indexOf( composer ) == -1 )
			{
				html += '<option value="' + composer + '">' + composer + '</option>';
			}
		});	

		// Clear options and append new options
		$(inputComposer).empty();
		$(inputComposer).append(html);
	}// end of loadComposers
});