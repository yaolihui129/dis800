<?php
namespace Admin\Controller;
use Think\Controller;
class RingpicController extends Controller {
  public function _initialize(){
    if(session('admin')==null){
      $this->redirect("User/user_login");
    }
  }
    public function index(){
        	
    }
    //添加轮播图
   public function ringpic_addinfo(){
   		$this->display();
   }

   public function add(){ 

      $upload = new \Think\Upload();// 实例化上传类

      $upload->maxSize =  3145728 ;// 设置附件上传大小    
      $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
      $upload->rootPath = 'Public';
      $upload->savePath = '/Uploads/ringpic/'; // 设置附件上传目录
      //$upload->saveName =mt_rand();
      //var_dump($upload->savePath);
      // 上传文件     
      $info = $upload->upload();
          if(!$info) {// 上传错误提示错误信息        
          $this->error($upload->getError()); 
         }else{
         // 上传成功        
          $this->success('上传成功！');

         }
      $data=I();
      //var_dump($data);
      $data['pic'] = $info['pic']['savepath'].$info['pic']['savename'];

      //dump($data);
      $ringpic = M("ringpic");
      if($ringpic->add($data)){
        $this->redirect("ringpic_list");
      }else{
        $this->error("添加失败");
      }

     }
        

    //轮播图列表
   public function ringpic_list(){
        $ringpic = M('ringpic');          //实例化model并传入表名
        $data = $ringpic->select();       //select() 查询出数据
        $this -> assign("data", $data); //把查询出的数据分配给模板
        $this -> display(); 
        //var_dump($data); 
   }
   //删除轮播图
   public function delete(){
        $ringpic = M('ringpic');
        $data = I();
        $id = I('id');
        $re = $ringpic->find($id);
        $aa = unlink('Public'.$re['pic']);
        if($ringpic->where("id = $id")->delete()){
            $this -> success("删除成功!");
        }else{
            $this -> error("删除失败！");
        }
   }
   //修改轮播图

   public function ringpic_update(){
    $ringpic = M('ringpic');
    //$data = I();
    $id = I('id');
    $data = $ringpic->find($id);
    $this->assign("data",$id);
    $this->display();
   }
   public function doupdate(){
      $upload = new \Think\Upload();// 实例化上传类
      $upload->maxSize =  3145728 ;// 设置附件上传大小    
      $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
      $upload->rootPath = 'Public';
      $upload->savePath = '/Uploads/ringpic/'; // 设置附件上传目录
      //var_dump($upload->savePath);
      // 上传文件     
      $info = $upload->upload();
          if(!$info) {// 上传错误提示错误信息        
          $this->error($upload->getError()); 
         }else{
         // 上传成功        
          $this->success("上传成功!","ringpic_list");

         }
      //var_dump($data);
      $data['pic'] = $info['pic']['savepath'].$info['pic']['savename'];
      $id = I('id');
      $ringpic = M('ringpic');
       if($ringpic->where("id=$id")->save($data)){
        $this->success("ringpic_list");
     }else{
        $this->error('修改失败');
      }

   }
}