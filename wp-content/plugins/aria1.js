	jQuery(document).ready(function($) {
		function getInput(){
	//		$('#input_2').live("change", function() {
	//			alert("in function");
	//			alert("You chose " + $('#input_2').val());
/*
			$( document ).ajaxError(function() {
				$( ".log" ).text( "Triggered ajaxError handler." );
				alert("error");
			});
			$.get( "http://aria.cse.unr.edu/wp-content/plugins/test.html" );

			function(data) {
						//$( ".result" ).html( data );
						alert( "Load was performed." );
					});
			}
*/
			}

			$.get( "http://aria.cse.unr.edu/wp-content/plugins/test.html", function(data){
			//	alert( data);
			});
	
			function CalculateSig(stringToSign, privateKey){
                                var hash = CryptoJS.HmacSHA1(stringToSign, privateKey);
                                var base64 = hash.toString(CryptoJS.enc.Base64);
                                return encodeURIComponent(base64);
                        }

                        var d = new Date,
                        expiration = 3600,
                        unixtime = parseInt( d.getTime() / 1000 ),
                        future_unixtime = expiration + unixtime,
                        public_key = "1ff591984b",
                        private_key = "c4efb4676e0d6a6",
                        method = "GET",
                        route = "entries";

                        stringToSign = public_key + ":" + method + ":" + route + ":" + future_unixtime;

                        sig = CalculateSig( stringToSign, private_key );
                        //url = "http://aria.cse.unr.edu/gravityformsapi/" + route + "?api_key=" + public_key;
			//url += "&signature=" + sig + "&expires=" + future_unixtime;
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
			$.get( ajax_url, function( result ){
				var str = JSON.stringify( result );
				var parsed = JSON.parse(str);
				alert (JSON.stringify(parsed['response']['entries']));	
				//alert(result["response"]);
				});	

        });	










