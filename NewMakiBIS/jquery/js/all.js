//THIS IS FOR THE TAXON TREE
var plus = "http://localhost/NewMakiBIS/images/plus.gif";
var minus = "http://localhost/NewMakiBIS/images/minus.gif";
var plus_lines = "http://localhost/NewMakiBIS/images/pluslines.gif";
var minus_lines = "http://localhost/NewMakiBIS/images/minuslines.gif";
var minus_bottom = "http://localhost/NewMakiBIS/images/minusbottom.gif";
var plus_bottom = "http://localhost/NewMakiBIS/images/plusbottom.gif";

$(document).ready(function(){
$(".flip_domain").click(function(){
	var domainID =($(this).attr('id'));
    $("#"+domainID+".kingdom").toggle("fast");
	$("."+domainID+"").hide("fast");
	$(this).attr('src', $(this).attr('src') == minus ? plus : minus);
  });
$(".flip_kingdom").click(function(){
	var kingdomID =($(this).attr('id'));
    $("#"+kingdomID+".phylum").toggle("fast");
	$("."+kingdomID+"").hide("fast");
	$(this).attr('src', $(this).attr('src') == minus_lines ? plus_lines : $(this).attr('src') == minus_bottom ? plus_bottom : $(this).attr('src') == plus_bottom ? minus_bottom : minus_lines);
  });
$(".flip_phylum").click(function(){
	var phylumID =($(this).attr('id'));
    $("#"+phylumID+".class").toggle("fast");
	$("."+phylumID+"").hide("fast");
	$(this).attr('src', $(this).attr('src') == minus_lines ? plus_lines : $(this).attr('src') == minus_bottom ? plus_bottom : $(this).attr('src') == plus_bottom ? minus_bottom : minus_lines);
  });
$(".flip_class").click(function(){
	var classID =($(this).attr('id'));
    $("#"+classID+".order").toggle("fast");
	$("."+classID+"").hide("fast");
	$(this).attr('src', $(this).attr('src') == minus_lines ? plus_lines : $(this).attr('src') == minus_bottom ? plus_bottom : $(this).attr('src') == plus_bottom ? minus_bottom : minus_lines);
  });
$(".flip_order").click(function(){
	var orderID =($(this).attr('id'));
    $("#"+orderID+".family").toggle("fast");
	$("."+orderID+"").hide("fast");
	$(this).attr('src', $(this).attr('src') == minus_lines ? plus_lines : $(this).attr('src') == minus_bottom ? plus_bottom : $(this).attr('src') == plus_bottom ? minus_bottom : minus_lines);
  });
$(".flip_family").click(function(){
	var familyID =($(this).attr('id'));
    $("#"+familyID+".genus").toggle("fast");
	$("."+familyID+"").hide("fast");
	$(this).attr('src', $(this).attr('src') == minus_lines ? plus_lines : $(this).attr('src') == minus_bottom ? plus_bottom : $(this).attr('src') == plus_bottom ? minus_bottom : minus_lines);
  });
$(".flip_genus").click(function(){
	var genusID =($(this).attr('id'));
    $("#"+genusID+".species").toggle("fast");
	$(this).attr('src', $(this).attr('src') == minus_lines ? plus_lines : $(this).attr('src') == minus_bottom ? plus_bottom : $(this).attr('src') == plus_bottom ? minus_bottom : minus_lines);
  });

});

//CALENDAR
$(function() {
	
	// Accordion
	$("#accordion").accordion({ header: "h3" });
	
	$( "#datepicker" ).datepicker();
});

//SLIDES SHOW
$(function(){
	$('#slides').slides({
		preload: true,
		preloadImage: 'img/loading.gif',
		play: 5000,
		pause: 2500,
		hoverPause: true,
		animationStart: function(current){
			$('.caption').animate({
				bottom:-35
			},100);
			if (window.console && console.log) {
				// example return of current slide number
				console.log('animationStart on slide: ', current);
			};
		},
		animationComplete: function(current){
			$('.caption').animate({
				bottom:0
			},200);
			if (window.console && console.log) {
				// example return of current slide number
				console.log('animationComplete on slide: ', current);
			};
		},
		slidesLoaded: function() {
			$('.caption').animate({
				bottom:0
			},200);
		}
	});
});

//THIS IS FOR THE MULTIPLE AUTHOR
var counter = 1;
var limit = 10;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML =  "<b>Author</b> " + "<b>"+(counter + 1)+"</b>" + ": <input type='text' name='author[]' class='text ui-widget-content ui-corner-all myinput '>";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}

var counter2 = 1;
var limit2 = 10;
function addInput2(divName){
     if (counter2 == limit2)  {
          alert("You have reached the limit of adding " + counter2 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML =  " <b>Chapter Author</b> " + "<b>"+(counter2 + 1)+"</b>" + ": <input type='text' name='chapter_author[]' class='text ui-widget-content ui-corner-all myinput '>";
          document.getElementById(divName).appendChild(newdiv);
          counter2++;
     }
}

var counter3 = 1;
var limit3 = 10;
function addInput3(divName){
     if (counter3 == limit3)  {
          alert("You have reached the limit of adding " + counter3 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML =  "<b>Book Author</b> " + "<b>"+(counter3 + 1)+"</b>" + ": <input type='text' name='book_author[]' class='text ui-widget-content ui-corner-all myinput '>";
          document.getElementById(divName).appendChild(newdiv);
          counter3++;
     }
}

var counter4 = 1;
var limit4 = 10;
function addInput4(divName){
     if (counter4 == limit4)  {
          alert("You have reached the limit of adding " + counter4 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML =  "<b>Journal Author</b> " + "<b>"+(counter4 + 1)+"</b>" + ": <input type='text' name='journal_author[]' class='text ui-widget-content ui-corner-all myinput '>";
          document.getElementById(divName).appendChild(newdiv);
          counter4++;
     }
}

var counter5 = 1;
var limit5 = 10;
function addInput5(divName){
     if (counter5 == limit5)  {
          alert("You have reached the limit of adding " + counter5 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML =  "<b>Thesis Author</b> " + "<b>"+(counter5 + 1) +"</b>"+ ": <input type='text' name='thesis_author[]' class='text ui-widget-content ui-corner-all myinput '>";
          document.getElementById(divName).appendChild(newdiv);
          counter5++;
     }
}

var counter6 = 1;
var limit6 = 10;
function addInput6(divName){
     if (counter6 == limit6)  {
          alert("You have reached the limit of adding " + counter6 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML =  "<b>Proceedings Author</b> " + "<b>"+(counter6 + 1)+"</b>" + ": <input type='text' name='proceedings_author[]' class='text ui-widget-content ui-corner-all myinput '>";
          document.getElementById(divName).appendChild(newdiv);
          counter6++;
     }
}

var counter7 = 1;
var limit7 = 10;
function addInput7(divName){
     if (counter7 == limit7)  {
          alert("You have reached the limit of adding " + counter7 + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML =  "<b>Project Report Author</b> " + "<b>"+(counter7 + 1)+"</b>" + ": <input type='text' name='project_report_author[]' class='text ui-widget-content ui-corner-all myinput '>";
          document.getElementById(divName).appendChild(newdiv);
          counter7++;
     }
}

function confirmDelete(){
		  var temp = confirm("Are you sure you want to delete this species?");
		  if(temp){
			window.location = "http://localhost/NewMakiBIS";
			 document.messages.submit();
		  }
		  else{
			//alert("Thanks for sticking around!");
			window.location = "http://localhost/NewMakiBIS";
			
			
		  }
		  return false;
}

$(document).ready(function(){
        $('.delete').click(function(){
            var answer = confirm('Are you sure you want to delete '+ jQuery(this).attr('title')+'?');
                        // jQuery(this).attr('title') gets anchor title attribute
            return answer; // answer is a boolean
            }); 
    });  




//THIS IS FOR THE DATEPICKER
$(function() {
	$( "#date" ).datepicker();
	$( "#date" ).datepicker( "option", slide, $( this ).val() );
	
});







