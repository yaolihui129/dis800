<?php
namespace Home\Controller;
use Think\Controller;
class MyinformationController extends Controller {
     public function _initialize(){
        $close=M('close');
        $result=$close->find();
        if($result['close']==1){
            $this->redirect("Public/a");
        }
    }
    public function index(){
    	
    }
    //查询信息
    public function myinformation(){
    	$information = M('information');        
        $id = session('id');
        $data = $information->where("uid = $id")->select(); 
        $this -> assign("data", $data); 
        $this -> display(); 
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

}