$(function(){
	setInterval(function(){
		if($(document).scrollTop()>=510){
			$("#leftstrip_mune").css({"display":"block"})
		}else{
			$("#leftstrip_mune").css({"display":"none"})
		}
	},100)
	


});