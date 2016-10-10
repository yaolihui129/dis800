<?php
namespace Admin\Controller;
use Think\Controller;
class FavoriteController extends Controller {
  public function _initialize(){
    if(session('admin')==null){
      $this->redirect("User/user_login");
    }
  }
    public function index(){
        	
    }
    //添加收藏夹
   public function favorite_addinfo(){
   		$this->display();
   }

   public function add(){ 
      if(I('uid') == "" && I('gid') ==""){
        $this->error("不允许为空！");
      } else{
            $data = I();
            $data["time"] = time();
            //var_dump($date);
            $favorite = M("favorite");
            if($favorite->add($data)){
                $this->success("添加用户成功！","favorite_list");
            }else{
                $this->error("添加失败");
            }
      }
    }
        

    //收藏夹列表
   public function favorite_list(){
        $favorite = M('favorite');          //实例化model并传入表名
        $data = $favorite->select();       //select() 查询出数据
        $this -> assign("data", $data); //把查询出的数据分配给模板
        $this -> display(); 
        //var_dump($data); 
        
   }
   //删除收藏
   public function delete(){
        $favorite = M('favorite');
        $id = I('id');

        if($favorite->where("id = $id")->delete()){
            $this -> success("删除成功!");
        }else{
            $this -> error("删除失败！");
        }
   }

}