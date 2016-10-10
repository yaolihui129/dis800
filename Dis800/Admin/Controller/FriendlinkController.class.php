<?php
namespace Admin\Controller;
use Think\Controller;
class FriendlinkController extends Controller {
    public function _initialize(){
        if(session('admin')==null){
            $this->redirect("User/user_login");
        }
    }
    public function index(){
        $this->display();
    }



        //查询友情链接 
    public function friendlink_list(){
        $search=I('search');
        $map['describe'] = array('LIKE',"%{$search}%");
        $map['recycle'] = 1;
        $blogroll = M("blogroll");
        $count = $blogroll->where($map)->count();
        $Page = new \Think\Page($count,5,$search);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');

      
        $show = $Page->show();
        $data = $blogroll ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($data as &$v){
           $v['type'] = $this->changeType($v['type']);
        }
        $this -> assign("data", $data);
        $this->assign('page',$show);
        $this -> display();
    }

    // //添加友情链接
    public function friendlink_add(){
         $this->display();
    }
    public function friendlink_insert(){
     if(I('url') == "" && I('title') == "" && I('describe') == ""){
         $this->error("不允许为空！");
     }else{
         $data = I();
         $blogroll = M('blogroll');
         if($blogroll->add($data)){
             $this->success("添加成功！","friendlink_list");
         }else{
             $this->error("添加失败！");
         }
     }
    }

    //删除友情链接到回收站
    public function friendlink_delete(){
        $data = I();
        $blogroll = M('blogroll');
        $id = I('id');
        if($blogroll->where("id=$id")->setField("recycle","0")){
            $this->success("回收成功！","friendlink_recyclelist");
        }else{
            $this->error("回收失败!","friendlink_list");
        }
    }
    //查询回收站
    public function friendlink_recyclelist(){

        $search=I('search');
        $map['describe'] = array('LIKE',"%{$search}%");
        $map['recycle'] = 0;
        $blogroll = M("blogroll");
        $count = $blogroll->where($map)->count();
        $Page = new \Think\Page($count,5,$search);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');

      
        $show = $Page->show();
        $data = $blogroll ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        //foreach($data as &$v){
          // $v['type'] = $this->changeType($v['type']);
       // }
        $this -> assign("data", $data);
        $this->assign('page',$show);
        $this -> display();
    }
    //回收站中的删除
    public function friendlink_recycledelete(){
        $blogroll = M('blogroll');
        $id = I('id');

        if($blogroll->where("id = $id")->delete()){
            $this -> success("删除成功!");
        }else{
            $this -> error("删除失败！");
        }
    }
   // //回收站中的还原
   public function friendlink_recycleupdate(){
        $data = I();
        $blogroll = M('blogroll');
        $id = I('id');
        $data['recycle'] = '1';
        if($blogroll->where("id=$id")->save($data)){
            $this->success("还原成功！","friendlink_list");
        }else{
            $this->error("还原失败!","friendlink_recyclelist");
        }
    }

    //修改友情链接
    public function friendlink_update(){
        $blogroll = M('blogroll');
        //$data = I();
        $id = I('id');
        $data = $blogroll->find($id);
        //var_dump($data);exit;
        $this->assign("data",$id);
        $this->assign('friendlink',$data);
        //var_dump($a);exit;
        $this->display();
    }
    public function friendlink_doupdate(){
        $data = I();
        $blogroll = M('blogroll');
        $id = I('id');
        //va//r_dump($data);
        if($blogroll->where("id={$data['id']}")->save($data)){
            $this->success("修改成功！","friendlink_list");
        }else{
            $this->error("修改失败！");
        }

    }

    //添加类型有三中
    private function changeType($jianpanshangdeyinfu){
        switch($jianpanshangdeyinfu){
            case 1:
                return 'B2C购物';
            case 2:
                return '门户综合';
            case 3:
                return '其他网站';
            default:
                return '未知类型';

        }           
    }
   
}













