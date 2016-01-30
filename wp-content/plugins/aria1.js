	jQuery(document).ready(function($) {
		function getInput(){
			//var inp = $('#input_2').val();
			//alert(inp);
	//		alert("before function");
	//		$('#input_2').live("change", function() {
	//			alert("in function");
	//			alert("You chose " + $('#input_2').val());
/*	
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
                        route = "forms/17/entries";

                        stringToSign = public_key + ":" + method + ":" + route + ":" + future_unixtime;

                        sig = CalculateSig( stringToSign, privateKey );
                        url = "http://localhost/wp/gravityformsapi/" + route + "?api_key=" + public_key + "

                        $('#input_15_2').change( function() {
                                //alert("in function");
                                alert("You chose " + $('#input_15_2').val());
                        //      $('#input_15_2').append( $("<option>")
                        //              .val("another")
                        //              .html("added another one")


                        //        $.get("
                                );
                        });
        //      }
*/
/*
			$( document ).ajaxError(function() {
				$( ".log" ).text( "Triggered ajaxError handler." );
				alert("error");
			});
			alert( "before" );
			$.get( "http://aria.cse.unr.edu/wp-content/plugins/test.html" );

			function(data) {
						//$( ".result" ).html( data );
						alert( "Load was performed." );
					});
			}
*/
			alert( "made it in func" );
			}

			alert( "made it" );
			$.get( "http://aria.cse.unr.edu/wp-content/plugins/test.html", function(data){
				alert("hi" + data);
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
			ajax_url = "http://aria.cse.unr.edu/gravityformsapi/forms/17/?api_key=1ff591984b&signature=q6ly7fd8180nx3%2FKvC9XIs6yIU8%3D&expires=1454114531";
			$.ajax({
				url: ajax_url,
				type: 'GET'
			});

        });	










