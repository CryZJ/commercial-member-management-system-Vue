//商标图样（黑白）
function selectImage1(file) {
        if (!file.files || !file.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            document.getElementById('hbty').src = evt.target.result;
           	var hbty = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
}
//商标图样（彩色）
function selectImage2(file) {
        if (!file.files || !file.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            document.getElementById('csty').src = evt.target.result;
            var csty = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
}
//身份证原件
function selectImage3(file) {
        if (!file.files || !file.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            document.getElementById('idyj').src = evt.target.result;
            var idyj = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
}
//身份证翻译件
function selectImage4(file) {
        if (!file.files || !file.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            document.getElementById('idfyj').src = evt.target.result;
            var idfyj = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
}
//营业执照原件
function selectImage5(file) {
        if (!file.files || !file.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            document.getElementById('SPic').src = evt.target.result;
            var SPic = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
}
//营业执照翻译件
function selectImage6(file) {
        if (!file.files || !file.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            document.getElementById('yyfyj').src = evt.target.result;
            var yyfyj = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
}

//重新选择申请人时清除信息
function Clear_msg(){
	$("#file_list span").html("");
	$("#file_list em").html("");
//	for(i=0;i<4;i++){
//		$("#file_list span:eq("+i+")").html("");
//		$("#file_list em:eq("+i+")").html("");
//	}
}

//由申请人的身份文件获取显示
function Show_idpicture(id_img,src_img){
	$("#"+id_img).attr("src",src_img);
	path_info = src_img.split("/");
//	$emobj = $("#file_list em:eq(0)").html(path_info[path_info.length-1]);
	switch(id_img){
		case "idyj":
			$("#file_list span:eq(0)").html(src_img);
			$("#file_list em:eq(0)").html(path_info[path_info.length-1]);
			break;
		case "SPic":
			$("#file_list em:eq(1)").html(path_info[path_info.length-1]);
			$("#file_list span:eq(1)").html(src_img);
			break;
		case "yyfyj":
			$("#file_list em:eq(2)").html(path_info[path_info.length-1]);
			$("#file_list span:eq(2)").html(src_img);
			break;
		case "idfyj":
			$("#file_list em:eq(3)").html(path_info[path_info.length-1]);
			$("#file_list span:eq(3)").html(src_img);
			break;
		default:
			return;
	}
}
