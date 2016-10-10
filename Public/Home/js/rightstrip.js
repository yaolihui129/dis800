$(function(){
	var rightfloat = $(".rightfloat_headerpic").parent().children();
	rightfloat.hover(function(){
		$(this).addClass("rightfloat_headerpic_js");
		$(".rightfloat_jumppic").removeClass("rightfloat_headerpic_js");
	},function(){
		$(this).removeClass("rightfloat_headerpic_js");
	});
	//意见反馈JS
	$(".rightfloat_opinion").hover(function(){
		$(".flewidea").css({"display":"block"});
		$(".flewidea").animate({"right":"1px"},500);
	},function(){
		$(".flewidea").css({"display":"none"});
		$(".flewidea").animate({"right":"10px"},500);
	});

	//返回顶部JS
	setInterval(function(){
	if($(document).scrollTop()>1){
		$(".rightfloat_top").css({"display":"block"});
	}else{
		$(".rightfloat_top").css({"display":"none"});
	}
	},100);

	$(".rightfloat_top").click(function(){
		$(document).scrollTop() = 0;
	})

	$(".rightfloat_top").hover(function(){
		$(".rightfloat_top_flew").css({"display":"block"});
		$(".rightfloat_top_flew").animate({"right":"1px"},500);
	},function(){
		$(".rightfloat_top_flew").css({"display":"none"});
		$(".rightfloat_top_flew").animate({"right":"10px"},500);
	});
	//返回顶部结束JS

	//常见问题JS
		$(".rightfloat_question").hover(function(){
		$(".opinion_issue_flew").css({"display":"block"});
		$(".opinion_issue_flew").animate({"right":"1px"},500);
	},function(){
		$(".opinion_issue_flew").css({"display":"none"});
		$(".opinion_issue_flew").animate({"right":"10px"},500);
	});
	//常见问题结束JS

	//我的优惠劵JS
		$(".rightfloat_shop_roll").hover(function(){
		$(".rightfloat_shop_roll_flew").css({"display":"block"});
		$(".rightfloat_shop_roll_flew").animate({"right":"1px"},500);
	},function(){
		$(".rightfloat_shop_roll_flew").css({"display":"none"});
		$(".rightfloat_shop_roll_flew").animate({"right":"10px"},500);
	});
	//我的优惠劵JS结束

	//我的订单JS
		$(".rightfloat_shop_order").hover(function(){
		$(".rightfloat_shop_order_flew").css({"display":"block"});
		$(".rightfloat_shop_order_flew").animate({"right":"1px"},500);
	},function(){
		$(".rightfloat_shop_order_flew").css({"display":"none"});
		$(".rightfloat_shop_order_flew").animate({"right":"10px"},500);
	});
	//我的订单JS结束

	//飞入二维码JS
		$(".rightfloat_sweep").hover(function(){
		$(".rightfloat_sweep_flew").css({"display":"block"});
		$(".rightfloat_sweep_flew").animate({"right":"10px"},500);
	},function(){
		$(".rightfloat_sweep_flew").css({"display":"none"});
		$(".rightfloat_sweep_flew").animate({"right":"10px"},500);
	});
	//飞入二维码结束JS

	//飞入消费保障JS
		$(".rightfloat_safeguard").hover(function(){
		$(".rightfloat_safeguard_flew").css({"display":"block"});
		$(".rightfloat_safeguard_flew").animate({"right":"1px"},500);
	},function(){
		$(".rightfloat_safeguard_flew").css({"display":"none"});
		$(".rightfloat_safeguard_flew").animate({"right":"10px"},500);
	});
	//飞入消费保障结束JS

	//小栏目登录JS
		$(".rightfloat_headerpic").click(function(){
			$(".box").css({"display":"block"});
			$(".smallshade").css({"display":"block"});
		});
		$(".box_fork").click(function(){
			$(".box").css({"display":"none"});
			$(".smallshade").css({"display":"none"});
		})
	//小栏目登录结束JS


});