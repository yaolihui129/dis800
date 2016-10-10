<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
   
    public function index(){
       
    }
    public function goodslist(){
        session("url",$this->url());
        //用户
        $value = session('name');
        $this->assign("name",$value);
        //商品
    	$goodsclass=M('goodsclass');
        $result=$goodsclass->where("pid=0")->select();
        // $this->assign("class",$result);
        //查询商品列表
        if(I('sta')==1){
        $id=I('id');
        $result2=$goodsclass->where("pid=$id")->select();
        //查询商品详情
        $goods=M('goods');
        $list = array();//三级类的id
        foreach ($result2 as $key => $value) {
        	$result3=$goodsclass->where("pid={$value['id']}")->select();
            foreach ($result3 as $k => $v) {
               $list[]=$v['id'];
            }
        }

        $gooodsList = array();//所有商品
        $time=I('time');
        foreach ($list as $key => $value) {
            if($time==1){
                 $goodsList[$value]=$goods->where("pid=$value")->order("addtime")->select();
             }else{
                 $goodsList[$value]=$goods->where("pid=$value")->select();
             }
           
        }
          // var_dump($goodsList);
        $tmp = array();
        foreach($goodsList as $v){
            foreach($v as  $cc){
                $tmp[] = $cc;
            }
        }
        $goodsinfo=M('goodsinfo');
        foreach ($tmp as &$val) {
            $price = $goodsinfo->where("gid={$val['id']}")->getField("price",true);
            sort($price);
            $val['minprice'] = $price[0];
            rsort($price);
            $val['maxprice'] = $price[0];
            $num = $goodsinfo->where("gid={$val['id']}")->getField("number",true);
            foreach($num as $vv){
                $val['number'] += $vv;
            }
        }
        $this->assign("goods",$tmp);
       
    }

    //二级类别
    if(I("sta")==2){
        $id=I('id');
        $result2=$goodsclass->where("pid=$id")->select();
        //查询商品详情
        
        $goods=M('goods');
        $gooodsList = array();//所有商品
        foreach ($result2 as $key => $value) {
            $goodsList[]=$goods->where("pid={$value['id']}")->select();
        }
        $tmp = array();
        foreach($goodsList as $v){
            foreach($v as  $cc){
                $tmp[] = $cc;
            }
        }
        $goodsinfo=M('goodsinfo');
        foreach ($tmp as &$val) {
            $price = $goodsinfo->where("gid={$val['id']}")->getField("price",true);
            sort($price);
            $val['minprice'] = $price[0];
            rsort($price);
            $val['maxprice'] = $price[0];
            $num = $goodsinfo->where("gid={$val['id']}")->getField("number",true);
            foreach($num as $vv){
                $val['number'] += $vv;
            }
        }
        $this->assign("goods",$tmp);
        
    }
    //三级类别
    if(I("sta")==3){
        $id=I('id');
        $goods=M('goods');
        $gooodsList = array();//所有商品
            $goodsList[]=$goods->where("pid=$id")->select();
        $tmp = array();
        foreach($goodsList as $v){
            foreach($v as  $cc){
                $tmp[] = $cc;
            }
        }
        $goodsinfo=M('goodsinfo');
        foreach ($tmp as &$val) {
            $price = $goodsinfo->where("gid={$val['id']}")->getField("price",true);
            sort($price);
            $val['minprice'] = $price[0];
            rsort($price);
            $val['maxprice'] = $price[0];
            $num = $goodsinfo->where("gid={$val['id']}")->getField("number",true);
            foreach($num as $vv){
                $val['number'] += $vv;
            }
        }
        $this->assign("goods",$tmp);
        
    }
       if(I("sta")==4){
        $id=I('id');
        $goods=M('goods');
        $pid=$goods->find($id);

        $gooodsList = array();//所有商品
            $goodsList[]=$goods->where("pid={$pid['pid']}")->select();
        $tmp = array();
        foreach($goodsList as $v){
            foreach($v as  $cc){
                $tmp[] = $cc;
            }
        }
        $goodsinfo=M('goodsinfo');
        foreach ($tmp as &$val) {
            $price = $goodsinfo->where("gid={$val['id']}")->getField("price",true);
            sort($price);
            $val['minprice'] = $price[0];
            rsort($price);
            $val['maxprice'] = $price[0];
            $num = $goodsinfo->where("gid={$val['id']}")->getField("number",true);
            foreach($num as $vv){
                $val['number'] += $vv;
            }
        }
        $this->assign("goods",$tmp);
        
    }
    if(I("sta")==5){
        $name=I('name');
        $goods=M('goods');
        $val['name']=array('like','%'.$name.'%');
        $result2=$goods->where($val)->select();
        
          $list = array();//三级类的id
        foreach ($result2 as $key => $value) {
               $list[]=$value['pid']; 
        }
       
        $gooodsList = array();//所有商品
        $goodsList[]=$goods->where("pid={$list[0]}")->select();
        $tmp = array(); 
 // var_dump($goodsList);exit;
        foreach($goodsList as $v){
            foreach($v as  $cc){
                $tmp[] = $cc;
            }
        }
        $goodsinfo=M('goodsinfo');
        foreach ($tmp as &$val) {
            $price = $goodsinfo->where("gid={$val['id']}")->getField("price",true);
            sort($price);
            $val['minprice'] = $price[0];
            rsort($price);
            $val['maxprice'] = $price[0];
            $num = $goodsinfo->where("gid={$val['id']}")->getField("number",true);
            foreach($num as $vv){
                $val['number'] += $vv;
            }
        }
        $this->assign("goods",$tmp);
        
    }
     //给前台分配类名
        $classname=I('name');
        $this->assign("classname",$classname);
        $this->display();
    }
    public function goodinfo(){
        session("url",$this->url());
        //商品类别
    	$goodsclass=M('goodsclass');
        $result=$goodsclass->where("pid=0")->select();
        $this->assign("class",$result);
        //获得商品
        $gid=I('id');
        $goods=M('goods');
        $good=$goods->find($gid);

        $click['clicknum']=$good['clicknum']+1;
        $goods->where("id=$gid")->save($click);
        $good=$goods->find($gid);
        // var_dump($good);exit;
        $this->assign("good",$good);
        //获得品牌
        $brand=M("brand");
        $brandid=$good['bid'];
        $brands=$brand->find($brandid);
        $this->assign("brand",$brands);

        //查看图片
        $goodspic=M('goodspic');
        $goodpic=$goodspic->where("gid={$good['id']}")->limit(4)->select();
        $goodpics=$goodspic->where("gid={$good['id']}")->select();
        $this->assign("goodpic",$goodpic);
        $this->assign("goodpics",$goodpics);
        //查看商品详情
        $goodsinfo=M('goodsinfo');
        $goodinfo=$goodsinfo->where("gid={$good['id']}")->select();
        $this->assign("goodinfo",$goodinfo);
        //计算价格  和  库存 颜色   尺寸
        $infocolor=M('infocolor');
        $color=$infocolor->where("gid={$good['id']}")->select();//获得颜色
        $this->assign("color",$color);
        $infosize=M('infosize');
        $size=$infosize->where("gid={$good['id']}")->select();//获得尺寸
        $this->assign("size",$size);

        foreach($goodinfo as $key=>$value){
            $num+=$value['number'];//获得总库存
            $price[]=$value['price'];//获得价格数组
        }
        sort($price);
        $minprice = $price[0];
        rsort($price);
        $maxprice = $price[0];
        $this->assign("num",$num);
        $this->assign("minprice",$minprice);//获得最小价格
        $this->assign("maxprice",$maxprice);//获得最大价格
        //商品评论
        $diss=M('diss');
        $count = $diss->where("gid=$gid")->count();
        $Page = new \Think\Page($count,3,$search);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');

      
        $show = $Page->show();
        $good_diss = $diss ->where("gid=$gid")->limit($Page->firstRow.','.$Page->listRows)->select();
        // $this -> assign("brand", $result);
        $this->assign('page',$show);



        // $good_diss=$diss->where("gid=$gid")->select();
        $user=M('user');
        foreach ($good_diss as $key => $value) {
            $good_diss[$key]['name']=$user->where("id={$value['uid']}")->find();
        }
        // var_dump($good_diss);exit;
        $this->assign('good_diss',$good_diss);
        
        $this->display();
    }
   public function color_ajax(){
    $color=I('color');
    session('color',$color);
    $gid=I('gid');
    $size=session('size');
    $infocolor=M('infocolor'); 
    $goodsinfo=M('goodsinfo');
    $cid=$infocolor->where("gid=$gid and color='".$color."'")->find();
    $good=array();
    if($size=='null'){
        $goodinfo=$goodsinfo->where("cid={$cid['id']} and gid=$gid")->find();
    }else{
        $infosize=M('infosize');
        $sid=$infosize->where("gid=$gid and size='".$size."'")->find();
        $goodinfo=$goodsinfo->where("cid={$cid['id']} and gid=$gid and sid={$sid['id']}")->find();
    }
    $goods['num']=$goodinfo['number'];
    $goods['price']=$goodinfo['price'];
    echo json_encode($goods);
   }
   public function size_ajax(){
    $size=I('size');
    session('size',$size);
    $gid=I('gid');
    $color=session('color');
    $infosize=M('infosize');
    $goodsinfo=M('goodsinfo');
    $sid=$infosize->where("gid=$gid and size='".$size."'")->find();
    $good=array();
     if($color=='null'){
        $goodinfo=$goodsinfo->where("cid={$cid['id']} and gid=$gid")->find();
    }else{
        $infocolor=M('infocolor');
        $cid=$infocolor->where("gid=$gid and color='".$color."'")->find();
        $goodinfo=$goodsinfo->where("cid={$cid['id']} and gid=$gid and sid={$sid['id']}")->find();
    }
    $goods['num']=$goodinfo['number'];
    $goods['price']=$goodinfo['price'];
    echo json_encode($goods);
   }


    //获取URL地址
    public function url(){
        $pageURL='http';
        if($_SERVER['HTTPS']=="on"){
            $pageURL.="s";
        }
        $pageURL.="://";
        if($_SERVER["SERVER_PORT"]!="80"){
            $pageURL.=$_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];

        }else{
            $pageURL.=$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;

    }
}