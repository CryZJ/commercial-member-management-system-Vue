//显示
$(document).ready(function(){
	var aim = $('#NORS').val();
//	alert(typeof aim);
	aim = aim.substr();
	switch (aim) {
		case 'about-1' :
			$('#about-1').addClass('active');
			$('.about-1').addClass('active');
//			alert('001');
			break;
		case 'about-2' :
			$('#about-2').addClass('active');
			$('.about-2').addClass('active');
//			alert('002');
			break;
		case 'about-3' :
			$('#about-3').addClass('active');
			$('.about-3').addClass('active');
//			alert('003');
			break;
		case 'about-4' :
			$('#about-4').addClass('active');
			$('.about-4').addClass('active');
//			alert('004');
			break;
		case 'about-5' :
			$('#about-5').addClass('active');
			$('.about-5').addClass('active');
//			alert('005');
			break;
		case 'about-6' :
			$('#about-6').addClass('active');
			$('.about-6').addClass('active');
//			alert('005');
			break;
		default : 
//			alert('none');
			break;
	}
})

$('.sub-menu-list > li a').click(function(){
//	alert('ok');
	$.ajax({
		type:"get",
		url:"NormalS.php",
		async:true,
		data:{
			aim:'none',
			falg:'NewPage'
		},
		sucess:function(data){
			alert(data);
		}
	});
})

$('.nav-tabs > li a').click(function(){
	var aim = $(this).attr('href');
	aim = aim.substr(1,aim.length);
	$.ajax({
		type:"get",
		url:"NormalS.php",
		async:true,
		data:{
			aim:aim,
			falg:'Index'
		},
		success:function(data){
		}
	});
})