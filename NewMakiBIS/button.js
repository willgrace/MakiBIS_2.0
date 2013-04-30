function lookUpUsername(){
    var name = 'images/species/3rakdj.jpg';
        $.post( 
	        'localhost://NewMakiBIS/application/controller/version2/ajax_lookUpUsername',
	         { userfile: name },
	         function(response) {  
	          if (response == 1) {
	               alert('username available');
	            } else {
	               alert('username taken');
	            }
	         }  
	    );
	//alert('hi');
}

function alert_user() {
	alert('hi');
}