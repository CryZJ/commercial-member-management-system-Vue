//图样预览,软件
	 var rjyl = '';
	 var zzyl = '';
    function selectImage(file) {
        if (!file.files || !file.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            document.getElementById('rjyl').src = evt.target.result;
            rjyl = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
}
    
    //著作案件
    function selectzzaj(file) {
        if (!file.files || !file.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            document.getElementById('zzyl').src = evt.target.result;
            zzyl = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
}
