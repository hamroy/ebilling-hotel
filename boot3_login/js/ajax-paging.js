///////////////////////////////
/*
Programer : Agus Sumarna
Blog      : http://ri32.wordpress.com
Web       : http://labhouse.co.cc
*/
//////////////////////////////

var xmlhttp = false;

try {
	xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}

if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
	xmlhttp = new XMLHttpRequest();
}

function shout(){
	var nama= document.getElementById('nama').value;
	var web= document.getElementById('web').value;
	var pesan= document.getElementById('pesan').value;
	
	var obj=document.getElementById("box");
	var url='proses-shoutbox.php?mode=box';
	url=url+'&nama='+nama+'&web='+web+'&pesan='+pesan
	
	xmlhttp.open("GET", url);
	
	xmlhttp.onreadystatechange = function() {
		if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
			obj.innerHTML = xmlhttp.responseText;
		} else {
			obj.innerHTML = "<div align ='center'><img src='waiting.gif' alt='Loading' /></div>";
		}
	}
	xmlhttp.send(null);
}

function view(id){
	var obj=document.getElementById("box");
	var url='proses-shoutbox.php?mode=view&id='+id;
	
	xmlhttp.open("GET", url);
	
	xmlhttp.onreadystatechange = function() {
		if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
			obj.innerHTML = xmlhttp.responseText;
		} else {
			obj.innerHTML = "<div align ='center'><img src='waiting.gif' alt='Loading' /></div>";
		}
	}
	xmlhttp.send(null);
}
