<?php
namespace Home\Controller;
use Think\Controller;
class FavoriteController extends Controller {
     public function _initialize(){
        $close=M('close');
        $result=$close->find();
        if($result['close']==1){
            $this->redirect("Public/a");
        }
    }
    public function index(){
    	
    }

    public function favorite(){
        if(session("id")==''){
            echo "<script>alert('请先登录');history.back();</script>";
            return;
        }
        $favorite=M('favorite');
        $id=session('id');
        $result=$favorite->where("uid=$id")->select();
        $goods=M('goods');
        foreach ($result as $key => $value) {
            $result[$key]['good']=$goods->where("id={$value['gid']}")->find();
        }
        // var_dump($result);exit;
        $this->assign("favorite",$result);

    	$this->display();
    }

    public function add(){
        if(session("id")==''){
            echo "<script>alert('请先登录');history.back();</script>";
            return;
        }
        $data['gid']=I('id');
    	$data['uid']=session('id');
        $data['time']=time();
        $favorite=M('favorite');
        $favorit=$favorite->where("uid={$data['uid']}")->select();
        $fav=0;
        foreach ($favorit as $key => $value) {
            if($data['gid']==$value['gid']){
                echo "<script>alert('您已经收藏过该商品了！');history.back();</script>";
                $fav=1;
            }
        }
    	if($favorit==null || $fav==0) {
            $favorite->add($data);
            echo "<script>alert('收藏成功');history.back();</script>";
        }
    }
    public function insert(){

    }
    public function delete(){
        $id=I("id");
        $favorite=M('favorite');
        $favorite->delete($id);
        $this->redirect("favorite");

    }
    public function url(){
        $pageURL='http';
        if($_SERVER['HTTPS']=="on"){
            $pageURL.="s";
        }
        $pageURL.="://";
        if($_SERVER["SERVER_PORT"]!="80"){
            $pageURL.=$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

        }else{
            $pageURL.=$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;

    }
    public function diss(){
        $gid=I('id');
        $goods=M('goods');
        $result=$goods->where("id=$gid")->find();
        // var_dump($result);exit;
        $this->assign("diss_good",$result);
        $this->display("User/diss");
    }
    public function dodiss(){
        $data['gid']=I('gid');
        $data['uid']=session('id');
        $data['content']=I('content');
        $data['time']=time();
        $diss=M('diss');
        $diss->add($data);
        echo "<script>alert('评论成功')</script>";
        $this->display("User/order");

    }

}