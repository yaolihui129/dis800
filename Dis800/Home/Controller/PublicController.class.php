<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
    public function close(){
        $close=M('close');
        $result=$close->find();
        if($result['close']==1){
            $this->redirect("Public/a");
        }
    }
    public function index(){
    }
    public function footer(){
        //友情链接
        $blogroll = M('blogroll');
        $data = $blogroll->select();
        $this->assign("data",$data);

        //网站版权
        $website = M('website');
        $website = $website->order("id desc")->find();
        $this->assign("website",$website);
        $this->display();
        
    }
  
    public function header(){
        $value = session('name');
        $this->assign("name",$value);
		//网站配置的logo
        $website = M('website');
        $website = $website->order("id desc")->find();
        $this->assign("website",$website);
    	
        $this->display();
    }
     public function menu(){
        $this->close();
        $this->display();
    }
     public function blogroll(){
        $this->close();
        $this->display();
    }
     public function leftstrip(){
        $this->close();
        $this->display();
    }
    public function rightstript(){
        $this->display();
    }
    public function raffle(){
        $this->close();
        $this->display();
    }
    //城市三级联动
    public function city_relevance(){
        $this->display();
    }
     //小框框修改
    public function siteupdate(){
        $this ->display();
    }
    public function search_ajax(){
        $key=I('key');
        $goods=M('goods');
        $val['name']=array('like','%'.$key.'%');
        $data=$goods->where($val)->select();
        echo json_encode($data);
    }
   
}