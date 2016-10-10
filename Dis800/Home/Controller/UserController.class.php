<?php
namespace Home\Controller;
use Think\Controller;
//用户填写资料页面
	class UserController extends Controller {
		 public function _initialize(){
        $close=M('close');
        $result=$close->find();
        if($result['close']==1){
            $this->redirect("Public/a");
        }
    }
	  public function information(){
		    $value = session('name');
	        $this->assign("name",$value);
	        $user=M('user');
	        $result=$user->find(session('id'));
	        $length=strlen($result['pic']);
	        // var_dump($length);
	        $this->assign("pic",$result['pic']);
	        $this->assign("length",$length);
	        $this->assign("user",$result);
	        $this->assign("tel",$result);
	        $this->assign("qq",$result);
	        $this->assign("mail",$result);
	        
	        // var_dump($result);
		    $this->display();
	    }
//用户更改头像部分
	public function portrait(){
		$user = M('user');
		$value = session('name');
		$id = session('id');
		$img = $user->where("id=$id")->getField('pic');
		$leng=strlen($img);
		$this->assign('leng',$leng);
		$this->assign('user_img',$img);
	    $this->assign("name",$value);
		$this->display();
	}
//安全中心
	public function secure(){
		$value = session('name');
	    $this->assign("name",$value);
		$this->display();
	}


//订单管理
	public function order(){
		if(session("id")==''){
            echo "<script>alert('请先登录');history.back();</script>";
            return;
        }
		$static = I('static');
		$value = session('name');
		$uid = session('id');
	    $this->assign("name",$value);
	    switch ($static) {
	     	case a:
			    $ordersql = M("order");
			    $orderinfosql = M("orderinfo");
			    $order = $ordersql->where("uid=$uid")->select();
				$orderinfolist = $orderinfosql->select();
				$count = $ordersql->where("uid=$uid")->count();
				$Page = new\Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数(2)
				$list = $ordersql->limit($Page->firstRow.','.$Page->listRows)->select();
				break;
			default:				
			    $ordersql = M("order");
			    $orderinfosql = M("orderinfo");
			    $order = $ordersql->where("static=$static AND uid=$uid")->select();
				$orderinfolist = $orderinfosql->select();

				$count = $ordersql->where("static=$static AND uid=$uid")->count();
				$Page = new\Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数(2)
				$list = $ordersql->where("static=$static AND uid=$uid")->limit($Page->firstRow.','.$Page->listRows)->select();
				break;
		}

		$Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');
		$show = $Page->show();// 分页显示输出

 	    $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('counts',$count);
		$this->assign("orderinfolists",$orderinfolist);
		$this->assign("orderlist",$order);

		$this->display();
	}
	public function orderstat(){
	echo json_encode(I('statices'));

	}

//收货地址
	public function site(){
		$value = session('name');
	    $this->assign("name",$value);
		$this->display();
	}
//弹出增加页面
	public function siteinsert(){
		$value = session('name');
	    $this->assign("name",$value);
		$this -> display();
	}
//城市三级联动
	public function city(){
		$this-> display();
	}
//退出
	public function siteout(){
		$this -> redirect('User/savesite');
	}
//判断用户是否有添加地址
	public function judge(){
		$uid = session('id');
		$judgesel = M('address');
	if($judgesel -> where("uid = $uid") -> select()){ 
			$this -> redirect('User/savesite');
		}else{
			$this -> redirect('User/site');
		}
	}


	//增加 （收货地址）
	public function site_inert(){
		$siteinert = M('address');
		//省
		$s_provinc = I('s_province');
		//市
		$s_city = I('s_city');
		//县、市
		$s_county = I('s_county');
		//详细地址
		$add = I('add');
		//拼接详细地址
		$address = $s_provinc.'/'.$s_city.'/'.$s_county.'/'.$add;
		//写入数组
		$data['name'] = I('name');
		$data['tel'] = I('tel');
		$data['email'] = I('email');
		$data['postcode'] = I('postcode');
		$data['address'] = $address;
		$data['uid'] = I('uid');
		$data['defaultadd'] = '1';
		if($siteinert -> add($data)){
			$this -> redirect('User/savesite');
		}else{
			$this -> error('添加地址失败','site');
			}

	}  

//删除数据（订单）
	public function site_del(){

		$sitedel = M('address');

		if($sitedel -> delete(I('id'))){
			$this -> redirect('User/savesite');
		}else{
			$this -> redirect('User/savesite');
		}
	}

//写入默认数据（订单）
	public function getaddress(){
		$address=M("address");
		$id=$_POST['id'];
		$res=$address->where("id={$id}")->find();
			echo json_encode($res);
	}
//修改数据（订单）
	public function addressupdate(){
		$siteup = M("address");

		$uid = session('id');
		$defaultadd['defaultadd'] = '0';
		$siteup->where("uid = $uid AND defaultadd = 1") -> save($defaultadd);

		$date['name'] = I('user');
		$date['tel'] = I('phone');
		$date['email'] = I('email');
		$province = I('s_province');
		$city = I('s_city');
		$county = I('s_county');
		$add = I('samiladd');
		$date['defaultadd'] = I('addsleected');
		$date['address'] = $province.'/'.$city.'/'.$county.'/'.$add;
		$date['postcode'] = I('updatebody_postcode');
		$date['id'] = I('addid');
			if($siteup -> save($date)){
				$this -> redirect('savesite');
			}else{
				$this -> error("修改失败","savesite");
			}
			
	}	
//内部增加数据（订单）
	public function smailsiteinsert(){
		$smailinsert = M('address');
		$data['address'] = I('s_province').'/'.I('s_city').'/'.I('s_county').'/'.I('samiladd');
		$data['name'] = I('name');
		$data['tel'] = I('phone');
		$data['email'] = I('email');
		$data['postcode'] = I('insertbody_postcode');
		$data['defaultadd'] = I('addsleected');
		$data['uid'] = session('id');
		if($data['defaultadd'] == 1){
			$uid = session('id');
			$defaultadd['defaultadd'] = '0';
			$smailinsert->where("uid = $uid AND defaultadd = 1") -> save($defaultadd);
		} 
		if($smailinsert -> add($data)){
			$this -> redirect('savesite');
		}else{
			$this -> error("添加地址失败",'siteinsert');
			}
	}

//查询数据表中数据（订单）
	public function savesite(){
		$site_select = M('address');
		$uid = session('id');
		$site_list = $site_select->where("uid = {$uid}")->order('defaultadd DESC') ->select();
		$this -> assign("sitelist",$site_list);
		$this-> display();
	}
//设为默认地址
	public function defaultadd(){
		$addsql = M('address');
		$uid = session('id');
		$defaultadd['defaultadd'] = '0';
		$addsql->where("uid = $uid AND defaultadd = 1") -> save($defaultadd);

		$addid = I('id');
		$defaultadd['defaultadd'] = '1';
		$addsql->where("id = $addid")->save($defaultadd);
		$this -> redirect('savesite');
	}
	//搜索修改个人信息
	public function update(){
		$user = M('user');
		$id = $user ->find($session['id']);
		$this->assign("user",$user);
		$this->display();
	}
//修改个人信息
	public function doupdate(){
		$data = I();
		$data['year'] = I('year');
		$data['mouth'] = I('mouth');
		$data['day'] = I('day');
		$data['name'] = I('name');
		$data['id'] = session('id');
		$user = M('user');
		if($user->where("id={$data['id']}")->save($data)){
			$this->success('成功');
			//获取session
			session('name',I('user'));
		}else{
			$this->error('失败');
		}
	}
	  
// //上传头像
	public function upload(){
		$upload = new \Think\Upload();// 实例化上传类   
		$upload->maxSize = 3145728 ;// 设置附件上传大小   
		$upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型 
		$upload -> rootPath = "Public";  
		$upload->savePath = '/Home/uploads/user/'; // 设置附件上传目录    // 上传文件    
		$info   =   $upload->upload();
		
		if(!info){
			$this->error($upload->getError());
		}
		$data['pic'] = $info['pic']['savepath'].$info['pic']['savename'];
		$id = session('id');
		$user = M('user');
		$re = $user ->where("id=$id")->save($data);
		if($re){
			$this->success('portrait');
			// unlink(Public.$data['pic']);
		}else{
			$this->error('上传失败');
		}
	}
 }