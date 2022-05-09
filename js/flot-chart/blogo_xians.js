var hbty = '';
var csty = '';
var idyj = '';
var idfyj = '';
var yyzz = '';
var yyfyj = '';
//商标图样（黑白）
function selectImage1(file) {
        if (!file.files || !file.files[0]) {
            return;
        }
        var reader = new FileReader();
        reader.onload = function (evt) {
            document.getElementById('hbty').src = evt.target.result;
            hbty = evt.target.result;
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
            csty = evt.target.result;
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
            idyj = evt.target.result;
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
            idfyj = evt.target.result;
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
            document.getElementById('yyzz').src = evt.target.result;
            yyzz = evt.target.result;
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
            yyfyj = evt.target.result;
        }
        reader.readAsDataURL(file.files[0]);
}

