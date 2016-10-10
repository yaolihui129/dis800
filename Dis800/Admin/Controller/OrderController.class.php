<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends Controller {
	//用构造方法禁止输入网站跳转页面
	public function _initialize(){
		if(session('admin')==null){
			$this->redirect("User/user_login");
		}
	}
    public function index(){
    }
    public function order_list(){
        $search=I('search');
        $map['id'] = array('LIKE',"%{$search}%");
        $order=M('order');
        $count = $order->where($map)->count();
        $Page = new \Think\Page($count,5,$search);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');

      
        $show = $Page->show();
        $result = $order ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        // $this -> assign("order", $result);
        $this->assign('page',$show);
        // $this -> display();
    	
    	//查询订单
      
        // $result=$order->select();
        $user=M('user');
        foreach ($result as $key => $value) {
        	$result[$key]['user']=$user->where("id='$value[uid]'")->select();
        }
        // $this->assign('user',$result);
        //查询地址表
        $address=M('address');
        foreach ($result as $key => $value) {
            $result[$key]['address']=$address->where("id='$value[aid]'")->select();
        }
         $this->assign('order',$result);
    	$this->display();
    }

      public function order_detail(){
        $oid=I('id');
        $static=I('static');
        //查看商品详情表
        $orderinfo=M('orderinfo');
        $result=$orderinfo->where("oid='$oid'")->select();
        $this->assign('orderinfo',$result);
        $this->assign('static',$static);
        //查看商品表
        $goods=M('goods');
        $resultgoods=$goods->where("id='$result[gid]'")->select();
        $this->assign('goods',$resultgoods);

        $this->display();
    }
    public function fahuo(){
        $oid=I('oid');
        $order=M('order');
        $data['static']=2;
        $result = $order->where("id='$oid'")->save($data);
        $this->redirect('order_list');
    }
}