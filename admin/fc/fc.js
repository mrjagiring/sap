///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getMouseXY(e) {
  if (IE) { // grab the x-y pos.s if browser is IE
    positionx = event.clientX + document.body.scrollLeft;
    positiony = event.clientY + document.body.scrollTop;
	
  } else {  // grab the x-y pos.s if browser is NS
    positionx = e.pageX;
    positiony = e.pageY;
  }  
  // catch possible negative values in NS4
  if (positionx < 0){ positionx = 0; }
  if (positiony < 0){ positiony = 0; }  
  return true;
}

var IE = document.all?true:false
if (!IE) document.captureEvents(Event.MOUSEMOVE)
var positionx = 0;
var positiony = 0;
document.onmousemove = getMouseXY;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function getXMLHttpRequestObject(){
	var xmlobj;
    // check for existing requests
    if(xmlobj!=null&&xmlobj.readyState!=0&&xmlobj.readyState!=4){
        xmlobj.abort();
    }
    try{
        // instantiate object for Mozilla, Nestcape, etc.
        xmlobj=new XMLHttpRequest();
    }
    catch(e){
        try{
            // instantiate object for Internet Explorer
            xmlobj=new ActiveXObject('Microsoft.XMLHTTP');
        }
        catch(e){
            // Ajax is not supported by the browser
            xmlobj=null;
            return false;
        }
    }
	return xmlobj;
}
var senderXMLHttpObj=getXMLHttpRequestObject();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function submiteditcategory(no,id){
	var name = document.getElementById('editname2'+no).value;
	senderXMLHttpObj.open('POST','ajax_editcategory.php',true);
	senderXMLHttpObj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	senderXMLHttpObj.send('name='+name+'&id='+id);
	senderXMLHttpObj.onreadystatechange=ceksubmiteditcategory;
}
function ceksubmiteditcategory()
{
    // check if request is completed
    if(senderXMLHttpObj.readyState==4){
        if(senderXMLHttpObj.status==200){
			displaysubmiteditcategory(senderXMLHttpObj);			
        }
        else{
            alert('Failed to get response :'+ senderXMLHttpObj.statusText);
        }
    }
}
function displaysubmiteditcategory(reqObj)
{
	var messages=reqObj.responseText;
	document.getElementById('tdsubmiteditcategory').innerHTML=messages;
	parent.frames['main'].document.location = 'admin_category.php' ;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function submiteditbrand(no,id){
	var name = document.getElementById('editname2'+no).value;
	var prior = document.getElementById('editpriority2'+no).value;
	senderXMLHttpObj.open('POST','ajax_editbrand.php',true);
	senderXMLHttpObj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	senderXMLHttpObj.send('name='+name+'&prior='+prior+'&id='+id);
	senderXMLHttpObj.onreadystatechange=ceksubmiteditbrand;
}
function ceksubmiteditbrand()
{
    // check if request is completed
    if(senderXMLHttpObj.readyState==4){
        if(senderXMLHttpObj.status==200){
			displaysubmiteditbrand(senderXMLHttpObj);			
        }
        else{
            alert('Failed to get response :'+ senderXMLHttpObj.statusText);
        }
    }
}
function displaysubmiteditbrand(reqObj)
{
	var messages=reqObj.responseText;
	document.getElementById('tdsubmiteditbrand').innerHTML=messages;
	parent.frames['main'].document.location = 'admin_brand.php';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function editproduct(id){
	bukaeditproduct();
	document.getElementById('tdeditproduct').innerHTML="<table align=left width=400 height=100 border=0 bgcolor=lightblue><tr><td align=center style=\"font-size:16px;font-weight:bolder;font-family:helvetica;\"><img src='images/loading.gif'> Please Wait</td></tr></table>";
	senderXMLHttpObj.open('POST','ajax_editproduct.php',true);
	senderXMLHttpObj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	senderXMLHttpObj.send('id='+id);
	senderXMLHttpObj.onreadystatechange=cekeditproduct;
}
function cekeditproduct(){
    // check if request is completed
    if(senderXMLHttpObj.readyState==4){
        if(senderXMLHttpObj.status==200){
			displayeditproduct(senderXMLHttpObj);			
        }
        else{
            alert('Failed to get response :'+ senderXMLHttpObj.statusText);
        }
    }
}
function displayeditproduct(reqObj){
	var messages=reqObj.responseText;
	document.getElementById('tdeditproduct').innerHTML=messages;
}
function bukaeditproduct(){
		document.getElementById('tableeditproduct').style.display="block";
		document.getElementById('tableeditproduct').style.position="absolute";
		document.getElementById('tableeditproduct').style.top=positiony-100;
		document.getElementById('tableeditproduct').style.left=300;
}
function tutupeditproduct(){
		document.getElementById('tableeditproduct').style.position="absolute";
		document.getElementById('tableeditproduct').style.display="none";
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function saveeditproduct(){
	var id = document.getElementById('id').value;
	var productcategory = document.getElementById('productcategory').value;
	var productname = document.getElementById('productname').value;
	var productdesc = document.getElementById('productdesc').value;
	var productshow = document.getElementById('productshow').value;
	var productevent = document.getElementById('productevent').value;
	senderXMLHttpObj.open('POST','ajax_saveeditproduct.php',true);
	senderXMLHttpObj.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	senderXMLHttpObj.send('id='+id+'&productcategory='+productcategory+'&productname='+productname+'&productshow='+productshow+'&productevent='+productevent+'&productdesc='+productdesc);
	senderXMLHttpObj.onreadystatechange=ceksaveeditproduct;
}
function ceksaveeditproduct(){
    // check if request is completed
    if(senderXMLHttpObj.readyState==4){
        if(senderXMLHttpObj.status==200){
			displaysaveeditproduct(senderXMLHttpObj);			
        }
        else{
            alert('Failed to get response :'+ senderXMLHttpObj.statusText);
        }
    }
}
function displaysaveeditproduct(reqObj){
	var messages=reqObj.responseText;
	document.getElementById('tdsaveeditproduct').innerHTML=messages;
	parent.frames['main'].document.location = 'admin_viewproduct.php?action=view' ;
}