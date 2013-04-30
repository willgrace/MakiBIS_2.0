
<style type="text/css">
* {
    margin:0;
    padding:0;
}

html { 
	background:url(http://localhost/NewMakiBIS/images/light_wool.png);  
}

body {
	background:url(http://localhost/NewMakiBIS/images/light_wool.png);
}

div#menu { 
	margin:0 0 0 0px; 
}

div#copyright { 
	display: none; 
}

/* added by grace */
.species_pic {
	height: 150px;
	width: 150px;
  border: 2px solid #0c0;
  padding: 4px; 

}
/* --- */

/*CSS for Image Gallery*/


div.img
{
  margin: 2px;
  /*border: 1px solid #0000ff;*/
  height: auto;
  width: auto;
  float: left;
  text-align: center;
}	
div.img img
{
  display: inline;
  margin: 3px;
  border: 1px solid #ffffff;
}
div.img a:hover img {border: 1px solid #00FF00;}
div.desc
{
  text-align: center;
  font-weight: normal;
  width: 120px;
  padding-left: 19px;
}

.button {
    border: none;
    background-color: #0c0;
    padding: 2px 8px;
    color: #fff;
 	  font-size: 10;
 	  width: 135px;
 	  height: 31px;
 	 background: url('http://localhost/NewMakiBIS/images/button.jpg') no-repeat top left;
}
.button:hover {
    padding: 2px 8px;
    color: #000;
}
br { clear: left; }


/*Gallery jquery*/
#thumbs{
  overflow: scroll;
  height: 225px;
  padding: 20px 35px;
}

#link {
  width: 125px;
  margin-left: 19px;
  font-size: 19px;
  text-align: center;
  
}

#picbox {
  float:right;
  height: 181px;
  width: 151px;
  margin-right: 55px;
  text-align: center;
}

#genus_link {
  font-size: 30px;
  text-align: center;
  font-style: italic;
}


</style>