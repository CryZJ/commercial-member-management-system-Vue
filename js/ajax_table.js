var XMLHttpRequestObject = false;

if (window.XMLHttpRequest){
	XMLHttpRequestObject = new XMLHttpRequest();
}else if(window.ActiveXObject){
	XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function postData(dataSource,ID)
{
	if (XMLHttpRequestObject){
		var obj = document.getElementById(ID);
		XMLHttpRequestObject.open("POST",dataSource);
		
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
				obj.innerHTML = XMLHttpRequestObject.responseText;
			}
		}
		XMLHttpRequestObject.send(null);
	}
}
