<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function _initialize(){
        $close=M('close');
        $result=$close->find();
        if($result['close']==1){
            $this->redirect("Public/a");
        }
    }
    public function index(){
    	$goodsclass=M('goodsclass');
        $result=$goodsclass->where("pid=0")->select();
        $this->assign("class",$result);
    	$value = session('name');
        $this->assign("name",$value);
        //侧边栏            
        $re = $goodsclass->where("pid=0")->select();
        foreach($re as &$v){    
            $v['second'] = $goodsclass->where("pid={$v['id']}")->select();
            foreach($v['second'] as &$v1){
                $v1['third'] = $goodsclass->where("pid={$v1['id']}")->select();
            }
        }
        $this->assign("er",$re);
        // dump($re[0]['second'][0]['third']);
        $this->assign("sanclass",$list);
        $this->assign("erclass",$erclass);
        $this->assign("a",1);
        // dump($erclass);
        // var_dump($sanclass);

        
        //友情链接
        $blogroll = M('blogroll');
        $data = $blogroll->limit(0,8)->select();
         $this->assign("data",$data);
        $goods=M('goods');
        $goodsinfo=M('goodsinfo');
        $good=$goods->select();
        $this->assign("good",$good);
        //var_dump($data);exit;
        $this->assign("data",$data);

        //轮播图
        $ringpic = M('ringpic');
        $i = 1;
        $data = $ringpic->limit(0,4)->select();
        foreach($data as &$v){
            $v['a'] = $i;
            $i++;
        }
        $data1  = $data[0];
        $this->assign("da",$data);
        $this->assign("data1",$data1);

        //网站配置的标题
        $website = M('website');
        $website = $website->order("id desc")->find();
        $this->assign("website",$website);
    	$this->display();
    }

}