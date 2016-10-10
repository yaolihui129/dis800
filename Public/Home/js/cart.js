	$(function(){




	setInterval(function conversion(date){
		if($(".nonecart_center_cterpic_conversion").attr("class") == 'nonecart_center_cterpic_conversion'){
			$(".nonecart_center_cterpic_conversion").attr({"class":"nonecart_center_cterpic_conversiontwo"});
		}else{
			$(".nonecart_center_cterpic_conversiontwo").attr({"class":"nonecart_center_cterpic_conversion"});
		}
	},1000);

//减数量
	$(".number_subtract").click(function(){
		//数量对象
		var num_size = ($(this).next());

		num_size.html((eval("("+num_size.html()+"-1)")));

		if(num_size.html() < 1){
			num_size.html('1');
		}	

	//小计对象
	var totalprice = ($(this)).parent().next().children();
	//商品id
	var id = totalprice.parent().next().children().attr('id');
	//商品单价
	$gmoney = $(this).parent().prev().children().eq(0).children().eq(1).html();
	//计算商品小计（单价*数量）
	totalprice.html(eval(($gmoney+"*num_size.html()")));


	//共多少件	
	var number = $(".num_size").length;
	var num = 0;
	var allmoney = 0;
	for(var i = 0;i<number;i++){
		num += eval($(".num_size").eq(i).html());
	}
	//计算总价
	for(var i = 0;i<number;i++){
		allmoney += eval($(".totalprice").eq(i).html());
	}
	$(".fixed_bigmoney").html(allmoney);
	$(".fixed_count_nummber").html(num);

	$.post("cartsubtractnum",{"number":num_size.html(),"totalprice":totalprice.html(),"gmoney":$gmoney,'id':id},function(data){
		num_size.html(data.number);
	},'json');

	});

//加数量



	$(".number_add").click(function(){
	//数量对象
	var num_size = ($(this).prev());
	//获取库存
	var $goodnumber = $(this).parent().prev().prev().children().last().children().attr('class');

	num_size.html((eval("("+num_size.html()+"+1)")));
	//判断数量是否超过商品库存
	if(eval(num_size.html()) > eval($goodnumber)){
		alert('亲！库存不足');
		num_size.html(eval($goodnumber));
	}
	//小计对象
	var totalprice = ($(this)).parent().next().children();
	//商品ID
	var id = totalprice.parent().next().children().attr('id');
	//商品单价
	$gmoney = $(this).parent().prev().children().eq(0).children().eq(1).html();
	//小计（单价*数量）
	totalprice.html(eval(($gmoney+"*num_size.html()")));
	//共多少件	
	var number = $(".num_size").length;
	var num = 0;
	var allmoney = 0;
	for(var i = 0;i<number;i++){
		num += eval($(".num_size").eq(i).html());
	}
	//计算总价
	for(var i = 0;i<number;i++){
		allmoney += eval($(".totalprice").eq(i).html());
	}
	$(".fixed_bigmoney").html(allmoney);
	$(".fixed_count_nummber").html(num);


	$.post("cartsubtractnum",{"number":num_size.html(),"totalprice":totalprice.html(),"gmoney":$gmoney,'id':id},function(data){
		num_size.html(data.number);
	},'json');

	});


	//显示
	//共多少件	
	var number = $(".num_size").length;
	var num = 0;
	var allmoney = 0;
	for(var i = 0;i<number;i++){
		num += eval($(".num_size").eq(i).html());
	}
	//计算总价
	for(var i = 0;i<number;i++){
		allmoney += eval($(".totalprice").eq(i).html());
	}
	$(".fixed_bigmoney").html(allmoney);
	$(".fixed_count_nummber").html(num);




	// //修改框
	// //外框
	// $(".content").hover(function(){
	// 	$(".cartsave_first").css({display:"block"});
	// },function(){
	// 	$(".cartsave_first").css({display:"none"});
	// })
	// //内框	
	// $(".cartsave_first").hover(function(){
	// 	$(".cartsave").css({display:"block"});
	// },function(){
	// 	$(".cartsave").css({display:"none"});
	// });

	// $(".cartsave_size").click(function(){
	// 	//点击修改
	// 	$cartsave_first_upda = $(this).parents().eq(1).next();
	// 	$cartsave_first_upda.css({display:"block"});
	// 	$cartsave_first_upda.animate({width:"393px",height:"150px"},1000);


	// })








	//全选
     $("#CheckedAll").click(function(){
			$('[name=items]:checkbox').attr("checked", this.checked );
	 });
 	$('[name=items]:checkbox').click(function(){

			var $tmp=$('[name=items]:checkbox');

			$('#CheckedAll').attr('checked',$tmp.length==$tmp.filter(':checked').length);

	 });

 	//批量删除
 	$(".checked_del").click(function(){
	 	var checknum = $(".checkboxdel").length;
	 	var checkarray = new Array();
	 	var k = 0;
	 	var check = $(".checkboxdel");
	 	var i = 0;
	 	for(k;k<checknum;k++){
	 		if(check.eq(k).attr("checked") == 'checked'){
	 			checkarray[i] = check.eq(k).val();
	 			i++;
	 		}
	 	}
	 	$(".checked_del").attr("href","cartdel?id="+checkarray);
 	});

});