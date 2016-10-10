<?php
namespace Home\Widget;
use Think\Controller;
class PublicWidget extends Controller {
    public function search(){
	    $goodsclass=M('goodsclass');
	    $result=$goodsclass->where("pid=0")->select();
	    $this->assign("class",$result);
	    $this->display("Public:search");
    } 
    public function footer(){
    $blogroll = M('blogroll');
        $data = $blogroll->limit(0,8)->select();
        $this->assign("data",$data);
        $goods=M('goods');
        $goodsinfo=M('goodsinfo');
        $good=$goods->select();
        $this->assign("good",$good);
        //var_dump($data);exit;
        $this->assign("data",$data);
	    $this->display("Public:footer");
    } 
}