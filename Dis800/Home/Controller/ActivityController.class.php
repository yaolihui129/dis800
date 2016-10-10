<?php
namespace Home\Controller;
use Think\Controller;
class ActivityController extends Controller {
	 public function _initialize(){
        $close=M('close');
        $result=$close->find();
        if($result['close']==1){
            $this->redirect("Public/a");
        }
    }
	public function Index(){
		$static = '3';
		$uid = session('id');
		$drawsql = M('draw');
		$ordersql = M('order');
		$num = $ordersql->where("uid=$uid AND static=$static")->count();
		$drawlist = $drawsql->where("uid=$uid")->select();
		$drawlistes = $drawsql->order("id DESC")->limit(6)->select();
		if($drawsql->where("uid=$uid")->select() == ''){
			$this->assign('num',$num);
		}else{
			$this->assign('num',$drawlist[0]['number']);
		}
		$this->assign('drawlist',$drawlistes);
		$this->display();
	}	
	//添加用户
	public function insertdraw(){
		$drawsql = M('draw');
		$ordersql = M('order');
		$cartsql = M('cart');
		$static = '3';
		$uid = I('uid');
		$time = time();
		switch(I('award')){
			case '恭喜你中了 一等奖':
				$award = '一等奖';
				break;
			case '恭喜你中了 二等奖':
				$award = '二等奖';
				break;
			case '恭喜你中了 三等奖':
				$award = '三等奖';
				break;
			case '恭喜你中了 四等奖':
				$award = '四等奖';
				break;
			default:
				$award = '未中奖';
				break;
		}
			$data['number'] = $ordersql->where("static=$static AND uid=$uid")->count();
			$data['award'] = $award;
			$data['uid'] = $uid;
			$data['time'] = $time;
			$data['uname'] = session('name');
			$drawsql->add($data);

if($award != '未中奖'){
		switch($award){
			case '一等奖':
				$date['cartpic'] = I('smailone');
				break;
			case '二等奖':
				$date['cartpic'] = I('smailtwo');
				break;
			case '三等奖':
				$date['cartpic'] = I('smailthree');
				break;
			case '四等奖':
				$date['cartpic'] = I('smailfour');
				break;
		}
			$date['uid'] = $uid;
			$date['gid'] = '0';
			$date['number'] = '1';
			$date['totalprice'] = '0';
			$date['gname'] = '中奖奖品';
			$date['gmoney'] = '0';
			$date['goodnumber'] = '1';
			$cartsql->add($date);
			
			$cartnum = $cartsql->where("uid=$uid")->count();
      	    session("cart_num",$cartnum);

		}

	}
	//修改字段次数
	public function drawsave(){
		$drawsql = M('draw');
		$uid = I('uid');
		$data['number'] = I('number');
		$drawsql->where("uid=$uid")->save($data);
	}
}