$(function(){

	//获取收货人标签
	var address = $(".insertbody_from_user");
	//获取手机标签
	var	phone_address = $(".insertbody_from_phone");
	//获取详细地址
	var user_minute = $(".insertbody_from_smailadd");
	//获取所在地区
	var info_select = $(".info_select");
	var info_city = $(".info_city");
	var info_county = $(".info_county");
	//获取警告栏
	var hint = $(".insertbody_caution");
	$(".insertbody_sub_from").click(function judge(){
	if(address.val().length == 0){
			hint.html("请填写收货人");	
			hint.css({"display":"block"});
			address.addClass("body_insite_error");
			phone_address.addClass("body_insite_error");
			user_minute.addClass("body_insite_error");
			return false;

	}

	if(phone_address.val().length == 0){
			hint.html("请填写手机号码");
			hint.css({"display":"block"});
			address.removeClass("body_insite_error");
			user_minute.addClass("body_insite_error");
			phone_address.addClass("body_insite_error");
			return false;
	}else{
		if(phone_address.val().match(/^1[34578]\d{9}$/) == null){
			hint.html("手机号码格式错误");
			hint.css({"display":"block"});
			address.removeClass("body_insite_error");
			user_minute.addClass("body_insite_error");
			phone_address.addClass("body_insite_error");
			return false;
		}
	}
	if(user_minute.val().length == 0){
			hint.html("请填写地址");	
			hint.css({"display":"block"});
			phone_address.removeClass("body_insite_error");
			user_minute.addClass("body_insite_error");
			return false;
	}



	if(info_select.val() == "省份"){
			hint.html("收货人省区信息不能为空");
			hint.css({"display":"block"});
			return false;
	}

	if(info_city.val() == "地级市"){
		hint.html("收货人城市信息不能为空");
		hint.css({"display":"block"});
		return false;
	}

	if(info_county.val() == "市、县级市"){
		hint.html("收货人市、县级市信息不能为空");
		hint.css({"display":"block"});
		return false;
	}
	return true;
	});

})