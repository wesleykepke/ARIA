jQuery(document).ready(function($) {
//	alert("in public");
	// ---- only load on specific page (if statement with student level?)
	
	/* Page load functions */

	// get teacher  form id from current form
	var teacher_form = $('.gform_fields').attr('id');
	var teacher_form_id = teacher_form.split('_');
	teacher_form_id = teacher_form_id[teacher_form_id.length -1];
	
	// get music DB form id from Gravity Forms
	var music_form_id = get_music_form_id();

	// get field ids
        var field_id_arr = get_ids();
	
	// get student level
	var input_prefix = '#input_' + teacher_form_id + '_';
	var fields;

	for( var field in field_id_arr ){
		//alert( field );
//		fields[ input_prefix + field ] = field_id_arr[field];
	}


	var st_level_field = input_prefix + field_id_arr['student_level'];
	var st_level = $(st_level_field).val();
	
	// For testing purposes, allow change in level
	$(st_level_field).live("change", function() {
		st_level = $(st_level_field).val();
//			alert( st_level );
			get_songs(st_level, levelField);
	});

	// request for all songs of given level
	var levelField = field_id_arr['song_level'];
	var music = get_songs(st_level, levelField);

	/* Song 1 Selection */
	
	// user selects period 
	var period_arr = {
		selected_val: { 1: '', 2: '' },
		selected_text: { 1: '', 2: '' },
		stored_val: { 1: '', 2: '' },
		stored_text: { 1: '', 2: '' }
	};
	
	var period_field_1 = input_prefix + field_id_arr['song_1_period'];
	var period_field_2 = input_prefix + field_id_arr['song_2_period'];
	var song_field_1 = input_prefix + field_id_arr['song_1_selection'];
	var song_field_2 = input_prefix + field_id_arr['song_2_selection'];
	
	$(period_field_1).live("change", function() {
		
		period_arr[ 'selected_val' ][1] = $(period_field_1).val();
		period_arr[ 'selected_text' ][1] = $(period_field_1 + '  option:selected').text();
		
		// if applicable, replace previous period in song 2
		if( period_arr[ 'stored_val' ][2] != '' )
		{
			//alert( "replacing " + period_arr['stored_text'][2]+ period_arr['stored_val'][2] + "into " + period_field_2);
			$(period_field_2).append('<option value="' + period_arr['stored_val'][2] + '">'
							+ period_arr['stored_text'][2] + '</option>');	
		}
	
		// remove period from song 2 options
		$(period_field_2 + " option[value='" + period_arr['selected_val'][1]  + "']").remove( );
		period_arr['stored_val'][2] = period_arr['selected_val'][1];
		period_arr['stored_text'][2] = period_arr['selected_text'][1];

		// disable song selection
		$(song_field_1).empty();
		$(song_field_1).attr('disabled', true);
		
		// populate period composers
		load_composers( period_arr[ 'selected_val' ][1], '1' );
	});

	// user selects composer
	var composer_field_1 = input_prefix + field_id_arr['song_1_composer'];
	var composer_val_1 = $(composer_field_1).val();
	$(composer_field_1).live("change", function(){

		composer_val_1 = $(composer_field_1).val();
		// enable song selection
		load_songs( composer_val_1, '1' );
		// populate song selection
		$(song_field_1).removeAttr('disabled');
	});
	/* Song 2 Selection */

	// user selects period

		// if applicable, replace previous period in song 1
		// remove period from song 1 options

		// populate period composers

		// disable song selection



	/**** Function Definitions *****/
	
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
	
	function load_composers( period, song ){
		var html = '';
		var composer_field = input_prefix + field_id_arr['song_' + song + '_composer'];
		//alert( composer_field );
		var data_composer_field   = '' +  field_id_arr['song_composer'];
		var data_period_field = '' + field_id_arr['song_period'];
		//var data_composer_field = data_composer_field_int.toString();
		music.forEach( function(entry){
			var composer = entry[ data_composer_field ];
			//alert( composer );
			if( entry[data_period_field] == period && html.indexOf( composer ) == -1 ){
				//alert( composer );
				html += '<option value="' + composer + '">' + toTitleCase(composer) + '</option>';
			}
		});

		$(composer_field).empty();
		$(composer_field).append(html);
	}

	function load_songs( composer, song_num ){
		var html = '';
		var song_field = input_prefix + field_id_arr['song_' + song_num + '_selection'];
		//alert( composer_field );
		var data_composer_field   = '' +  field_id_arr['song_composer'];
		var data_song_field = '' + field_id_arr['song_name'];
	//	alert(song_field);
		//var data_composer_field = data_composer_field_int.toString();
		music.forEach( function(entry){
			var song  = entry[ data_song_field ];
			//alert( composer );
			if( entry[data_composer_field] == composer && html.indexOf( song ) == -1 ){
				//alert( composer );
				html += '<option value="' + song + '">' + toTitleCase(song) + '</option>';
			}
		});

		$(song_field).empty();
		$(song_field).append(html);
	}

	function toTitleCase( str ){
		return str.replace( /\w\S*/g, function(txt){
			return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
	}
});
