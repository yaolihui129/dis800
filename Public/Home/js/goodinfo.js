$(function(){
	setInterval(function(){
		if($(document).scrollTop()>=710){
			$("#left_fixed").css({"display":"block"})
		}else{
			$("#left_fixed").css({"display":"none"})
		}
	},100);
	$(".chicun").click(function(){
		$(".chicun").css({border:"1px solid #ccc"});
		$(this).css({border:"1px solid red"});
		$(this).siblings().css({border:"1px solid #ccc"});
		$(".bianma_size").html($(this).html());
	});
		$(".chicun_color").click(function(){
		$(".chicun_color").css({border:"1px solid #ccc"});
		$(this).css({border:"1px solid red"});
		$(this).siblings().css({border:"1px solid #ccc"});
		$(".bianma_color").html($(this).html());
	});

		$(".submetb").click(function(){
		if($(".bianma_id").attr('id') == ''){
			alert("亲！请先登录");
			return false;
		}else if($(".bianma_size").html() == ''){
			alert("亲！请选择尺寸");
			return false;
		}else if($(".bianma_color").html() == ''){
			alert("亲！请选择颜色");
			return false;
		}else if($("#good_number").html() =='暂无库存'){
			alert("亲！此商品暂时没货噢！");
			return false;
		}
		//商品ID
		$(".gid").val($("#good_gid").html());
		//商品名称
		$('.name').val($('.bianma_name').next().html());
		//商品颜色
		$('.color').val($('.bianma_color').html());
		//商品尺寸
		$('.size').val($('.bianma_size').html());
		//商品单价
		$('.money').val($('.money').html());
		//商品图片
		$(".cartpic").val($("#datua").attr('src'));
		//商品库存
		$(".goodnumber").val($("#good_number").html());



		});
});