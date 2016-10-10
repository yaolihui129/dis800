<?php
namespace Home\Controller;
use Think\Controller;
class FriendlinkController extends Controller {
     public function _initialize(){
        $close=M('close');
        $result=$close->find();
        if($result['close']==1){
            $this->redirect("Public/a");
        }
    }
    public function index(){
    	
    }

    public function friendlink(){
    	$blogroll = M('blogroll');
        $friendLink1 = $blogroll->where("type = 1")->select();
        $friendLink2 = $blogroll->where("type = 2")->select();
    	$friendLink3 = $blogroll->where("type = 3")->select();
        $this->assign('friendLink1',$friendLink1);
        $this->assign('friendLink2',$friendLink2);
        $this->assign('friendLink3',$friendLink3);
    	$this->display();
    }
}