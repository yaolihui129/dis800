<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsclassController extends Controller {
  public function _initialize(){
    if(session('admin')==null){
      $this->redirect("User/user_login");
    }
  }
    public function index(){
    
    }

    // 添加类别
   public function addgoodsclass(){
   	 
     if(I('name')==""){
        $this->error("不允许为空",'goodsclass_list');
     }else{
        $data=I();
        // var_dump($data);
        $goodsclass=M('goodsclass');
        // $classorder=$goodsclass->select();
        // // var_dump(count($classorder));
        // for ($i=0;$i<count($classorder);$i++) {
        //   $a[]=$classorder[$i]['order'];
        // }
        
        //   $data['order']=max($a)+1;
          // var_dump($data);exit;
          if($goodsclass->add($data)){
            
            $this->redirect('goodsclass_list');
          }else{
            $this->error("添加失败");
          }
     }
   }
// 查看类别
   public function goodsclass_list(){
      // $goodsclass=M('goodsclass');
      // $result=$goodsclass->select();
      // $this->assign("goodsclass",$result);
      // $this->display();

        $search=I('search');
        $map['name'] = array('LIKE',"%{$search}%");
        $goodsclass = M("goodsclass");
        $count = $goodsclass->where($map)->count();
        $Page = new \Think\Page($count,5,$search);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');

      
        $show = $Page->show();
        $goodsclasss = $goodsclass ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this -> assign("goodsclasss", $goodsclasss);
        $this->assign('page',$show);
        $this -> display();

      
   }
   //删除类别
    public function delgoodsclass(){
     $goodsclass=M('goodsclass');
     $data=I();
     if($goodsclass->where("id={$data['id']}")->delete()){
       $this->success('删除成功','goodsclass_list');
     }else{
        $this->error('删除失败');
     }
    }
    //修改类别
    public function goodsclass_up(){
      $data=I();
      $goodsclass=M('goodsclass');
      $goodsclass=$goodsclass->find($data['id']);
      // var_dump($goodsclass);
      $this->assign("goodsclass",$goodsclass);
      $this->display();

    }
    //修改类别
    public function upgoodsclass(){
      $data=I();
      $goodsclass=M('goodsclass');
      // var_dump($data);
      if($goodsclass->where("id={$data['id']}")->save($data)){
        $this->success('修改成功','goodsclass_list');
     }else{
        $this->error('修改失败');
      }
    }

    //添加子类
     public function goodsclass_addson(){
      $data=I();
      $goodsclass=M('goodsclass');
      $goodsclass=$goodsclass->find($data['id']);
      // var_dump($goodsclass);
      $this->assign("goodsclass",$goodsclass);
      $this->display();

    }


}