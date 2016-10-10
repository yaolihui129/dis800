<?php
namespace Admin\Controller;
use Think\Controller;
class WebsiteController extends Controller {

	public function website_addinfor(){
    $this->display();
 
   }

  public function website_add(){
	  $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize =  3145728 ;// 设置附件上传大小    
    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
    $upload->rootPath = 'Public';
    $upload->savePath = '/Admin/Uploads/website/'; // 设置附件上传目录
    // 上传文件     
    $info = $upload->upload();
    if(!$info) {// 上传错误提示错误信息        
      $this->error($upload->getError()); 
    }else{
     // 上传成功        
      $this->success('上传成功！');
    }
     $data=I();
      $data['logo'] = $info['logo']['savepath'].$info['logo']['savename'];
      //dump($data);exit;
      $website = M("website");
      //
      if($website->add($data)){
        $this->redirect('website_list');
        //$this->success("添加成功","website_list");
       }
       //else{
      //   $this->error("添加失败");
      // }
    
    }

    //查询网站配置
    public function website_list(){
      $website = M('website');
      $data = $website->select();
      $this->assign("data",$data);
      $this->display();
    }


   //修改网站配置
    public function website_update(){
        $website = M('website');
        $id = I('id');
        //$data = I();
        $data = $website->find($id);
        $this->assign("data",$id);
        $this->assign('website',$data);
        $this->display();
    }
    public function doupdate(){
      $upload = new \Think\Upload();// 实例化上传类
      $upload->maxSize =  3145728 ;// 设置附件上传大小    
      $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
      $upload->rootPath = 'Public';
      $upload->savePath = '/Admin/Uploads/website/'; // 设置附件上传目录
      //var_dump($upload->savePath);
      // 上传文件     
      $info = $upload->upload();
          if(!$info) {// 上传错误提示错误信息        
            $this->error($upload->getError()); 
         }else{
         // 上传成功        
          //$this->success("上传成功!11111111111111","website_list");

         }
      $data = I();
      $data['logo'] = $info['logo']['savepath'].$info['logo']['savename'];
      $id = I('id');
      //var_dump($data);exit;
      $website = M('website');
       if($website->where("id=$id")->save($data)){
         $this->redirect('website_list');
      }

   
    }

    public function delete(){
       $data = I();
        $website = M('website');
        $id = I('id');
        //va//r_dump($data);
        if($website->where("id={$data['id']}")->delete()){
          $this->success("删除成功！");
        }else{
            $this->error("删除失败！");
        }
    }
    // //网站是否关闭
    // public function changeType(typee){
    //   switch(typee){
    //     case 1:
    //       return:'是';
    //     case 2:
    //       return:'否';
    //   }
    // }

    //网站关闭
    public function close(){
      $this->display();
    }
      public function close_ajax(){
       $close=M('close');
       $data['close']=1;
       $close->where("id=1")->save($data);
    }
    public function open_ajax(){
      $close=M('close');
       $data['close']=2;
       $close->where("id=1")->save($data);
    }
}