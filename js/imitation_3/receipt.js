//收据预览
function show_receipt(file){
	var prevDiv = document.getElementById('showpic');
	if (file.files && file.files[0]){
		var reader = new FileReader();
		reader.onload = function(evt){
			prevDiv.innerHTML = '<img src="' + evt.target.result + '"  height="300px" width="500px" />';
		}
		reader.readAsDataURL(file.files[0]);
	}
	else{
		prevDiv.innerHTML = '<div class="img" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src=\'' + file.value + '\'"></div>';
	}
}

