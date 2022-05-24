$(document).ready(function(){
	$("#kk").focus();
	$('body').keypress(function(event){
		var e = (event.keyCode ? event.keyCode : event.which);
		if(e == '13'){
			goa();
		}
	});
});
function goa(){
	
	var ss = $(location).attr('search').split("=")[1];
	var kk = $("#kk").val();
	var uu = $("#uu").val().replace("https://","").replace("http://","").replace("www.","");
	var gourl = '';
	
	if(!kk){ $("#kk").focus();return false; }
	if(!uu){ $("#kk").focus();return false; }
	
	if(uu.indexOf('/') > -1){
		var r = uu.split('/');
		console.log(r);
		for(i=0;i<r.length;i++){
			if((r[i].indexOf('.')) > -1){
				gourl = r[i];
				i = r.length;
			}
		}
	}else{
		gourl = uu;
	}
	
	if(!ss){ $("#si").html("[ Miss GET ?s=? ]");$("#kk").focus();return false; }
	if(!gourl){ $("#kk").focus();return false; }
	console.log(gourl);
	
	$.ajax({
		type: "GET",
		url: "aj.php?k="+kk+"&u="+gourl+"&s="+ss,
		dataType: "text",
		beforeSend: function(){
			$("#aj").show();
			$("#aj2").show();
			$("form h1").hide();
			$("form span").hide();
			$("form input").hide();
			$("#si").html(gourl+"<br>[ "+kk+" ]<br>Result # <span></span>");
		},
		complete: function(){
			$("#aj").hide();
			$("#aj2").hide();
			$("form h1").show();
			$("form span").show();
			$("form input").show();
		},
		success:function (msg){
			console.log(msg);
			if(msg == 'urlerror'){
				$("#si span").html("網址錯誤");
			}else if(msg == ''){
				$("#si span").html("發生錯誤");
			}else{
				$("#si span").html(msg);
			}
		}
	});
}