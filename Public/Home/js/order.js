$(function(){

	$(".actives").click(function(){
		$(this).attr({"style":"border-bottom:2px solid #E01914"});
		$(this).siblings().attr({"style":"border-bottom:2px solid #D3D3D3"});
	});
});