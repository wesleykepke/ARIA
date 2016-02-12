jQuery(document).ready(function($) {
//	alert("in public");
	// ---- only load on specific page (if statement with student level?)
	
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
		//	alert(temp);
			idResult = JSON.parse(temp);
		});
		return idResult;
	
	}

	function CalculateSig(stringToSign, privateKey){
		var hash = CryptoJS.HmacSHA1(stringToSign, privateKey);
		var base64 = hash.toString(CryptoJS.enc.Base64);
		return encodeURIComponent(base64);
	}// end of CalcSig

	function get_songs( level, levelID ){

        	var d = new Date,
	        expiration = 3600,
        	unixtime = parseInt( d.getTime() / 1000 ),
	        future_unixtime = expiration + unixtime,
		public_key = "1ff591984b",
	        private_key = "c4efb4676e0d6a6",
        	method = "GET",
	        route = "forms/" + music_form_id + "/entries";
        	stringToSign = public_key + ":" + method + ":" + route + ":" + future_unixtime;

        	sig = CalculateSig( stringToSign, private_key );
        	url = "http://aria.cse.unr.edu/gravityformsapi/" + route;
		url += "/?api_key=" + public_key;
		url += "&signature=" + sig + "&expires=" + future_unixtime;

		//NOTE: key in search is just field ID not formID.fieldID
		// search for entry[levelID] == level
		
		var search;

		if( level != 11 )
		{
			search = {
				field_filters : [
					{
					key: levelID,
					operator: 'is',
					value: level
					}
				],
				mode : 'any'
			}
		}
		else
		{
			search = {
/*				field_filters : 
				[
					{
					key: levelID,
					operator: 'is',
					value: 9
					}
					{
					key: levelID,
					operator: 'is',
					value: 10
					}
				],*/				
				field_filters : { 
					mode: 'any', 
					0:  
						{
						key: levelID,
						operator: 'is',
						value: 9
						},
					1:
						{
						key: levelID,
						operator: 'is',
						value: 10
						}
					}
			}
		
		}
	
		
		var searchJSON = JSON.stringify( search );
		alert( searchJSON );

		//NOTE: paging requires &
		//NOTE: max page size?
		url += '&paging[page_size]=300' + '&search=' + searchJSON;
		url += '&sorting[key]=3&sorting[direction]=ASC';

		var returnedValue;
		var test;
		$.ajax({
	            type: "GET",
	            url: url,
	            async: false,

	            success: function(result) {
	                test = result['response']['entries'];
//			alert( "successful get" );
	            }
	        }).then( function(){
	        	returnedValue = test;
	        });
		return returnedValue;
	}// end of getMusic function

	function get_music_form_id( ){

        	var d = new Date,
	        expiration = 3600,
        	unixtime = parseInt( d.getTime() / 1000 ),
	        future_unixtime = expiration + unixtime,
		public_key = "1ff591984b",
	        private_key = "c4efb4676e0d6a6",
        	method = "GET",
	        route = "forms";
        	stringToSign = public_key + ":" + method + ":" + route + ":" + future_unixtime;

        	sig = CalculateSig( stringToSign, private_key );
        	url = "http://aria.cse.unr.edu/gravityformsapi/" + route;
		url += "/?api_key=" + public_key;
		url += "&signature=" + sig + "&expires=" + future_unixtime;

		//NOTE: key in search is just field ID not formID.fieldID
		// search for entry[levelID] == level
		var returnedValue;
		var test;
		$.ajax({
	            type: "GET",
	            url: url,
	            async: false,

	            success: function(result) {
			for(key in result['response'])
			{
				// !!! base off stored name instead of hard coded
				if( result['response'][key]['title'] == "NNMTA Music Database" ){
					test = result['response'][key]['id'];
				}
			}
	            }
	        }).then( function(){
	        	returnedValue = test;
	        });
		return returnedValue;
	}// end of get form id function

	// !!! get form ids
	var teacher_form = $('.gform_fields').attr('id');
	var teacher_form_id = teacher_form.split('_');
	teacher_form_id = teacher_form_id[teacher_form_id.length -1];
//	alert( teacher_form_id ); //var teacher_form_id = '252';
	
	// !!! how to get this?
	var music_form_id = get_music_form_id();

	// get field ids
        var field_id_arr = get_ids();
		//alert( field_id_arr['name'] );

	// get student level
	var input_pre = '#input_' + teacher_form_id + '_';
	
	var st_level_field = input_pre + field_id_arr['student_level'];
	var st_level;
//	alert(st_level_field);
	$(st_level_field).live("change", function() {
		st_level = $(st_level_field).val();
//			alert( st_level );
			get_songs(st_level, levelField);
	});

	// request for all songs of given level
	var levelField = field_id_arr['song_level'];
	var music = get_songs(st_level, levelField);

		// if level 11, request for 9 and 10
		
});
