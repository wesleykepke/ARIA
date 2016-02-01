	jQuery(document).ready(function($) {
		function getInput(){
			$('#input_15_2').live("change", function() {
				alert("You chose " + $('#input_2').val());
				testPost();
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
                        public_key = "0035d1a323",
			private_key = "f2d4546aab2c06a",
			//aria_public_key = "1ff591984b",
                        //aria_private_key = "c4efb4676e0d6a6",
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
		


		function testGet(){

			//$.get( "http://aria.cse.unr.edu/wp-content/plugins/test.html" );

                        var d = new Date,
                        expiration = 3600,
                        unixtime = parseInt( d.getTime() / 1000 ),
                        future_unixtime = expiration + unixtime,
                        public_key = "0035d1a323",
			private_key = "f2d4546aab2c06a",
			//aria_public_key = "1ff591984b",
                        //aria_private_key = "c4efb4676e0d6a6",
                        method = "GET",
                        route = "forms/2/entries";

                        stringToSign = public_key + ":" + method + ":" + route + ":" + future_unixtime;

                        sig = CalculateSig( stringToSign, private_key );
                        url = "http://www.nnmta.org/gravityformsapi/" + route + "/?api_key=" + public_key;
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
			
			$.get( url, function( result ){
				var str = JSON.stringify( result );
				var parsed = JSON.parse(str);
				//alert (JSON.stringify(parsed['response']['entries']));	
				parsed['response']['entries'].forEach( function(entry){
						if( entry['15'] == "Smith, Denise" ){
							alert( JSON.stringify(entry['1.3']) );
						}
					});//alert(result["response"]);
				});

		}// end of testGet function
		//testGet();	

        });	










