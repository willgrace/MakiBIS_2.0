
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

/*search box----------------------------------------------*/

#searchbox
{
  background: #eaf8fc;
  background-image: -moz-linear-gradient(#fff, #d4e8ec);
  background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, #d4e8ec),color-stop(1, #fff));
  
  -moz-border-radius: 35px;
  border-radius: 35px;
  
  border-width: 1px;
  border-style: solid;
  border-color: #c4d9df #a4c3ca #83afb7;            
  width: 300px;
  height: 25px;
  padding: 10px;
  margin: 0px 10px 10px;
  overflow: hidden; /* Clear floats */
  float: right;
}

#search, #submit
{
  float: left;
}

#search
{
  padding: 5px 9px;
  height: 15px;
  width: 180px;
  border: 1px solid #a4c3ca;
  font: normal 13px 'trebuchet MS', arial, helvetica;
  background: #f1f1f1;
  
  -moz-border-radius: 50px 3px 3px 50px;
   border-radius: 50px 3px 3px 50px;
   -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25) inset, 0 1px 0 rgba(255, 255, 255, 1);
   -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25) inset, 0 1px 0 rgba(255, 255, 255, 1);
   box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25) inset, 0 1px 0 rgba(255, 255, 255, 1);            
}

/* ----------------------- */

#submit
{   
  background: #6cbb6b;
  background-image: -moz-linear-gradient(#95d788, #6cbb6b);
  background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, #6cbb6b),color-stop(1, #95d788));
  
  -moz-border-radius: 3px 50px 50px 3px;
  border-radius: 3px 50px 50px 3px;
  
  border-width: 1px;
  border-style: solid;
  border-color: #7eba7c #578e57 #447d43;
  
   -moz-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
   -webkit-box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;
   box-shadow: 0 0 1px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.3) inset;      

  height: 27px;
  margin: 0 0 0 10px;
        padding: 0;
  width: 90px;
  cursor: pointer;
  font: bold 14px Arial, Helvetica;
  color: #23441e;
  
  text-shadow: 0 1px 0 rgba(255,255,255,0.5);
}

#submit:hover
{   
  background: #95d788;
  background-image: -moz-linear-gradient(#6cbb6b, #95d788);
  background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, #95d788),color-stop(1, #6cbb6b));
} 

#submit:active
{   
  background: #95d788;
  outline: none;
   
   -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
   -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
   box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;    
}

#submit::-moz-focus-inner
{
       border: 0;  /* Small centering fix for Firefox */
}
</style>