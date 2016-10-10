<?php
namespace Admin\Controller;
use Think\Controller;
class InformationController extends Controller {
  public function _initialize(){
    if(session('admin')==null){
      $this->redirect("User/user_login");
    }
  }
    public function index(){
    	
    }
    //添加信息
   	public function information_info(){
   		$this->display();
   	}
   	public function add(){
      $information = M("information");
      $user = M('user');

      if(I('checkall')){
        $data['content'] = I('content');
        $data['time'] = time();
        $re = $user->getField('id',true);
        foreach($re as $v){
          $data['uid'] = $v;
          $re = $information->add($data);
          if(!$re){
            $this->error("添加失败！");
            return false;
          }
        }
        $this->success("添加成功！","information_list"); 
        return true;
      }

      if(I('uid') == "" || I('content') == ""){
        $this->error("不允许为空");
      }else{
          $data = I();
          $data["time"] = time();        
       		 if( $information->add($data)){
       			$this->success("添加成功！","information_list");	
       		}else{
       		 	$this->error("添加失败！");
       		 }
      }  
   	} 
   	//查询信息
   	public function information_list(){
        $search=I('search');
        $map['uid'] = array('LIKE',"%{$search}%");
        $information = M('information');
        $count = $information->where($map)->count();
        $Page = new \Think\Page($count,5,$search);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');

      
        $show = $Page->show();
        $list = $information ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this -> assign("data", $list);
        $this->assign('page',$show);
        $this -> display();
    }

    //修改信息
    public function information_update(){
      $information = M('information');
       $id = I('id');
      $data = $information -> find($id);
      //var_dump($data);
      $this -> assign("data",$id);
      $this -> assign("information",$data);
      $this -> display();

    }
    public function information_doupdate(){
        $data = I();
        $information = M('information');
       if($information->where("id={$data['id']}")->save($data)){
        $this->success('修改成功','information_list');
     }else{
        $this->error('修改失败');
      }
    }

   	//删除信息
    public function delete(){
        $information = M('information');
        $id = I('id');
        //var_dump($id);exit;
        //$data = $information->where('id = $id')->delete();

        if($information->where("id = $id")->delete()){
            $this -> success("删除成功!");
        }else{
            $this -> error("删除失败！");
        }
   }
   //后台ajax处理方法
    public function del_infomation_ajax(){
        $information = M('information');
        $data=I('id');
        $data = explode('!',$data);
        foreach($data as $v){
            $re = $information->delete($v);
            if(!$re){
                echo 0;
                return;
            }
        }
        echo 1;
    }
}