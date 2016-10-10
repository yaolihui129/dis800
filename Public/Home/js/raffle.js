$(function(){
	$(".raffle_out_pic").mouseover(function(){
		$(".raffle_out_pic").animate({"left":"138px"},80,function(){
			$(".raffle_out_pic").css({"display":"none"});
		});
		$(".raffle_out_pic_click").animate({"left":"0px"},80).css({"display":"block"});
	});
	$(".raffle_out_pic_click").mouseout(function(){
		$(".raffle_out_pic_click").animate({"left":"138px"},80,function(){
			$(".raffle_out_pic_click").css({"display":"none"});
		});
		$(".raffle_out_pic").animate({"left":"52px"},80).css({"display":"block"});
	});



});