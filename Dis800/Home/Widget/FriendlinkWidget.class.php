<?php
namespace Home\Widget;
use Think\Controller;
class FriendlinkWidget extends Controller {
    public function index(){
    	$blogroll = M('blogroll');
        $data = $blogroll->limit(0,8)->select();
        $this->assign("data",$data);
        $goods=M('goods');
        $goodsinfo=M('goodsinfo');
        $good=$goods->select();
        $this->assign("good",$good);
        //var_dump($data);exit;
        $this->assign("data",$data);


	    // $blogroll=M('blogroll');
	    // $result=$blogroll->select();
	    // $this->assign("class",$result);
	    $this->display("Friendlink:index");
    } 
}