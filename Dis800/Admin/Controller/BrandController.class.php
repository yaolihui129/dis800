<?php
namespace Admin\Controller;
use Think\Controller;
class BrandController extends Controller {
  public function _initialize(){
    if(session('admin')==null){
      $this->redirect("User/user_login");
    }
  }
    public function index(){
    
    }

   public function brand_info(){
    	$this->display();
   }
   //商品品牌列表
   public function brand_list(){
        $search=I('search');
        $map['brand'] = array('LIKE',"%{$search}%");
        $brand=M('brand');
        $count = $brand->where($map)->count();
        $Page = new \Think\Page($count,3,$search);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');

      
        $show = $Page->show();
        $result = $brand ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this -> assign("brand", $result);
        $this->assign('page',$show);
        $this -> display();
      
      // $result=$brand->select();
      // var_dump($result);exit;
      // $this->assign("brand",$result);
    	// $this->display();
   }
   //添加品牌
   public function addbrand(){
   	    $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload -> rootPath = "Public";
        $upload->savePath  =      '/Admin/uploads/brand/'; // 设置附件上传目录    // 上传文件
        $info   =   $upload->upload();

        // dump($info);
        $data['brand']=I('brand');
        $data['pic']=$info['pic']['savepath'].$info['pic']['savename'];
        // var_dump($data);
        $brand=M('brand');
        $brand->add($data);
        if($info){
            $this->redirect("brand_list");
        }else{
            $this -> error($upload -> getError());
        }

   }
   //删除
   public function delbrand(){
    $brand=M('brand');
    $brand->delete(I('id')); 
    unlink(I('src'));
    $this->redirect("brand_list");

   
    // if($brand->delete(I('id'))){
    //   $this->redirect();
    // }else{
    //   $this->error("删除失败");
    // }
   }
   //修改品牌
   public function brand_up(){
      $src=I('src');
      $brand=M('brand');
      $result=$brand->find(I('id'));
      $this->assign("brand",$result);
      $this->assign("src",$src);
      $this->display();
   }
   public function upbrand(){
        
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload -> rootPath = "Public";
        $upload->savePath  =      '/Admin/uploads/brand/'; // 设置附件上传目录    // 上传文件
        $info   =   $upload->upload();
        // dump($info);
        $data['brand']=I('brand');
        $data['id']=I('id');
        $data['pic']=$info['pic']['savepath'].$info['pic']['savename'];
        // var_dump($data);
        $brand=M('brand');
       unlink(I('oldpic'));
       // var_dump(I('oldpic'));exit;
       if($brand->save($data)){
            $this->redirect("brand_list");
       }else{
          $this->error("修改失败");
       }
   }


}