	jQuery(document).ready(function($) {
		function getInput(){
			var stLevel;
			$('#input_15_3').live("change", function() {
				stLevel = $('#input_15_3').val();	
			});
			$('#input_15_6').live("change", function() {
	//			alert("You chose " + $('#input_15_3').val());
				var periodStr = $('#input_15_6').val();
				var periodInt;
				if( periodStr == 'Baroque'){
					periodInt = '1';
				}
				else if( periodStr == 'Classical'){
					periodInt = '2';
				}
				else if( periodStr == 'Romantic'){
					periodInt = '3';
				}
				else if( periodStr == 'Contemporary'){
					periodInt = '4';
				} 
				alert("You chose " + periodStr + ": " + periodInt);
				testGet( periodInt, stLevel );
			});
		}
		getInput();
		
		function CalculateSig(stringToSign, privateKey){
			var hash = CryptoJS.HmacSHA1(stringToSign, privateKey);
			var base64 = hash.toString(CryptoJS.enc.Base64);
			return encodeURIComponent(base64);
		}

		function testPost(){

                        var d = new Date,
                        expiration = 3600,
                        unixtime = parseInt( d.getTime() / 1000 ),
                        future_unixtime = expiration + unixtime,
                        //nnmta_public_key = "0035d1a323",
			//nnmta_private_key = "f2d4546aab2c06a",
			public_key = "1ff591984b",
                        private_key = "c4efb4676e0d6a6",
                        route = "forms/2/entries";
			$.post( "http://aria.cse.unr.edu/wp-content/plugins/aria_dynamic.php", {name: 'Successeded'} );
			
			/*$.ajax({
				url: 'http://aria.cse.unr.edu/wp-content/plugins/aria_dynamic.php',
				type: 'POST',
				dataType:'json', // add json datatype to get json
				data: ({'name': 145})
			});
			*/

		}
		


		function testGet(input, stLevel){

			//$.get( "http://aria.cse.unr.edu/wp-content/plugins/test.html" );

                        var d = new Date,
                        expiration = 3600,
                        unixtime = parseInt( d.getTime() / 1000 ),
                        future_unixtime = expiration + unixtime,
                        //nnmta_public_key = "0035d1a323",
			//nnmta_private_key = "f2d4546aab2c06a",
			public_key = "1ff591984b",
                        private_key = "c4efb4676e0d6a6",
                        method = "GET",
                        route = "forms/184/entries";

                        stringToSign = public_key + ":" + method + ":" + route + ":" + future_unixtime;

                        sig = CalculateSig( stringToSign, private_key );
                        url = "http://aria.cse.unr.edu/gravityformsapi/" + route;
			url += "/?api_key=" + public_key;
			url += "&signature=" + sig + "&expires=" + future_unixtime;
	//		ajax_url = "/wp/gravityformsapi/" + route + "?api_key=" + public_key;
	//		ajax_url += "&signature=" + sig + "&expires=" + future_unixtime;
			/*$.get( url, function(data){
				alert( "get worked" + data );
			});*/
			var ajax_url = "http://www.nnmta.org/gravityformsapi/forms/2/entries/?api_key=0035d1a323&signature=wFjsQ344wRxI2WKO5sQLcJ4WqfM%3D&expires=1454375957";
			/*
			$.ajax({
				url: ajax_url,
				type: 'GET'
			});
			*/

			/* GET entries and alert name of students with teacher Smith, Denise */
		/*	var search = [ {key: 'mode', value: 'all'}, 
					[{ key: 'key', value: '184.5'}, 
					{key: 'operator', value: 'is'}, 
					{key: 'value', value: input }]];
		*/
			//NOTE: key in search is just field ID not formID.fieldID
			var search = {
					field_filters : [
						{key: '5',
						operator: 'is',
						value: input 
						},
						{
						key: '4',
						operator: 'is',
						value: stLevel
						}
					],

					mode : 'all'
				}
			var searchJSON = JSON.stringify( search );
			//NOTE: paging requires &
			url += '&paging[page_size]=200' + '&search=' + searchJSON;// + '?paging[page_size]=200';
			url += '&sorting[key]=3&sorting[direction]=ASC';
			$.get( url,  function( result ){
				var str = JSON.stringify( result );
				var parsed = JSON.parse(str);
				//alert (JSON.stringify(parsed['response']['entries']));	
				
				/*parsed['response']['entries'].forEach( function(entry){
						if( entry['15'] == "Smith, Denise" ){
							alert( JSON.stringify(entry['1.3']) );
						}
					});//alert(result["response"]);
				*/
				var html = '';
				var option;
				result['response']['entries'].forEach( function(entry){
					option = entry['3'];
					if( html.indexOf( option ) == -1)
					{
						html += '<option value="' + entry['3'] + '">' + entry['3'] + '</option>';
					}
				});	
				$('#input_15_4').empty();
				$('#input_15_4').append(html);
				});

		}// end of testGet function
		//testGet();	

        });	










