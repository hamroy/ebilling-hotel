///////////////////////////////
/*
Sumber : AJAX for dummies
by Masterpra
*/
//////////////////////////////

	function getDataReturnText(url, callback) {
		var XMLHttpRequestObject = false;
		
		if (window.XMLHttpRequest){
			XMLHttpRequestObject = new XMLHttpRequest();
		}else if (window.ActiveXObject){
			XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		if (XMLHttpRequestObject){
			XMLHttpRequestObject.open("GET", url);
			
			XMLHttpRequestObject.onreadystatechange = function (){
				if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
					callback (XMLHttpRequestObject.responseText);
					delete XMLHttpRequestObject;
					XMLHttpRequestObject = null;
				}
			}
			
			XMLHttpRequestObject.send(null);
		}
	}

	function getDataReturnXML(url, callback) {
		var XMLHttpRequestObject = false;
		
		if (window.XMLHttpRequest){
			XMLHttpRequestObject = new XMLHttpRequest();
		}else if (window.ActiveXObject){
			XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		if (XMLHttpRequestObject){
			XMLHttpRequestObject.open("GET", url);
			
			XMLHttpRequestObject.onreadystatechange = function (){
				if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
					callback (XMLHttpRequestObject.responseXML);
					delete XMLHttpRequestObject;
					XMLHttpRequestObject = null;
				}
			}
			
			XMLHttpRequestObject.send(null);
		}
	}
	
	function postDataReturnText(url, data, callback) {
		var XMLHttpRequestObject = false;
		
		if (window.XMLHttpRequest){
			XMLHttpRequestObject = new XMLHttpRequest();
		}else if (window.ActiveXObject){
			XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		if (XMLHttpRequestObject){
			XMLHttpRequestObject.open("POST", url);
			XMLHttpRequestObject.setRequestHeader('Content-type','application/x-www-form-urlencoded');
			
			XMLHttpRequestObject.onreadystatechange = function (){
				if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
					callback (XMLHttpRequestObject.responseText);
					delete XMLHttpRequestObject;
					XMLHttpRequestObject = null;
				}
			}
			
			XMLHttpRequestObject.send(data);
		}
	}

	function postDataReturnXml(url, data, callback) {
		var XMLHttpRequestObject = false;
		
		if (window.XMLHttpRequest){
			XMLHttpRequestObject = new XMLHttpRequest();
		}else if (window.ActiveXObject){
			XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
		}
		
		if (XMLHttpRequestObject){
			XMLHttpRequestObject.open("POST", url);
			XMLHttpRequestObject.setRequestHeader('Content-type','application/x-www-form-urlencoded');
			
			XMLHttpRequestObject.onreadystatechange = function (){
				if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
					callback (XMLHttpRequestObject.responseXML);
					delete XMLHttpRequestObject;
					XMLHttpRequestObject = null;
				}
			}
			
			XMLHttpRequestObject.send(data);
		}
	}