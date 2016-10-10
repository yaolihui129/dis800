$(function(){






	var $plateBtn = $('#plateBtn');
	var $result = $('#result');
	var $resultTxt = $('#resultTxt');
	var $resultBtn = $('#resultBtn');
	var $choujiangsize = $(".choujiang_size");
	var $smailone = $('.smail_one').attr("src");
	var $smailtwo = $('.smail_two').attr('src');
	var $smailthree = $('.smail_three').attr('src');
	var $smailfour = $('.smail_four').attr('src');
	$plateBtn.click(function(){


		//判断用户是否在你登陆状态
		if($(this).attr('class') == ''){
			alert("亲~请先登陆！");
			return false;
		}

		if($choujiangsize.html() == '0'){
			alert("亲~请再次购买商品,增加你的次数");
			return false;
		}
		
		$choujiangsize.html(eval($choujiangsize.html()+"-1"));




		var data = [0, 1, 2, 3, 4, 5, 6, 7];
		data = data[Math.floor(Math.random()*data.length)];
		switch(data){
			case 1: 
				rotateFunc(1,157,'恭喜你中了 一等奖');
				break;
			case 2: 
				rotateFunc(2,65,'恭喜你中了 二等奖');
				break;
			case 3: 
				rotateFunc(3,335,'恭喜你中了 三等奖');
				break;
			case 4: 
				rotateFunc(4,247,'恭喜你中了 四等奖');
				break;
			case 5: 
				rotateFunc(5,114,'谢谢参与，请再接再厉');
				break;
			case 6: 
				rotateFunc(6,24,'谢谢参与，请再接再厉');
				break;
			case 7: 
				rotateFunc(7,292,'谢谢参与，请再接再厉');
				break;
			default:
				rotateFunc(0,203,'恭喜你中了 参与奖');
		}

	});
	var rotateFunc = function(awards,angle,text){  //awards:奖项，angle:奖项对应的角度
		$plateBtn.stopRotate();
		$plateBtn.rotate({
			angle: 0,
			duration: 5000,
			animateTo: angle + 1440,  //angle是图片上各奖项对应的角度，1440是让指针固定旋转4圈
			callback: function(){
				$resultTxt.html(text);
				$result.show();
				$.post("insertdraw",{"uid":$plateBtn.attr('class'),"award":$resultTxt.html(),"smailone":$smailone,"smailtwo":$smailtwo,"smailthree":$smailthree,"smailfour":$smailfour},function(data){
				},'json');

				$.post("drawsave",{"uid":$(this).attr('class'),"number":$choujiangsize.html()},function(data){

				},'json');
			}
		});

	};

	$resultBtn.click(function(){
		$result.hide();
	});
});