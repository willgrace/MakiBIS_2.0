function lookUpUsername(name){
    $.post( 
        'http://NewMakiBIS/application/controller/ajax_lookUpUsername',
         { userfile: name },
         function(response) {  
            if (response == 1) {
               alert('username available');
            } else {
               alert('username taken');
            }
         }  
    );
}

function alert_user() {
	alert('hi');
}