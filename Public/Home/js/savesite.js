$(function(){
	$(".savesite_information_update").click(function(){
		//获取订货地址ID
		var id = $(this).parent().prev().children().attr("id");
		//用ajax的post传值方法传id
		$.ajax({
			'type':'post',
			'url':'getaddress',
			'data':'id='+id,
			'datatype':'json',
			success:function(data){
				var dataObj = eval("("+data+")");
				//用户名
				$(".updatebody_from_user").val(dataObj.name);
				//用户电话
				$(".updatebody_from_phone").val(dataObj.tel);
				//用户邮箱
				$(".updatebody_from_email").val(dataObj.email);
				//用户邮编
				$(".updatebody_from_postcode").val(dataObj.postcode);
				$(".updatebody_from_addid").val(dataObj.id);
				
				if(dataObj.defaultadd ==1){
					$(".updatebody_form_selected").attr('checked','true');
				}
				var address = dataObj.address;
				var add = address.split("/");

				$(".info_select").val(add[0]);
				$(".info_city").val(add[1]);
				$(".info_county").val(add[2]);

				$(".updatebody_from_smailadd").val(add[3]);

				$(".updatebody").fadeIn(1000);
				$(".smallshade").css({"display":"block"});
			}
		})

	});




});