function getObj(id){
	return document.getElementById(id);
}

function openDiv(id){	
	var ob = getObj(id);
	
	if (ob){
		if (ob.style.display == "none"){
			ob.style.display = "";
		}
		else{
			ob.style.display = "none";
		}
	}
}

var timer = "";
function update_onuser(){
	if (timer != ""){
		clearTimeout(timer);
	}
	getObj("onuserframe").src = "getdata.aspx?type=updateonuser";
	//checkkickout();	
	timer = setTimeout("update_onuser()", 30000);
}
//Hanh adds for kick out onuser
var timer2 = "";
function checkkickout()
{	
	if (onuserframe.iskickedout){
		//alert("... Another session has been logged in ...\n Your session will be terminated!!! \n If that is not you, please contact your upline!!!");
		var str = document.getElementById("lblSessionLogged").value.replace("{1}","\n");
		str = str.replace("{1}","\n");
		alert(str);
		window.top.location.href = "default.aspx";
	}
}