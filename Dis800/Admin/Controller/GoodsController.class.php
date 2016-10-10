<?php
/**
*goodsaddinfo();添加详情
*addinfogoods();添加商品【图片，价格，颜色，尺寸】详情
*goodsupinfo();修改详情
*goods_list_info();查看详情的详情
*goodsinfodel();删除
*upinfogoods();修改详细信息
*
*
*
*
*/
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {

    public function index(){
    
    }

   public function goods_info(){

        
    //查看品牌
    $brand=M('brand');
    $result=$brand->select();
    //查看商品类别
    $goodsclass=M('goodsclass');
    $class=$this->getClass($goodsclass->select());
    $this->assign("class",$class);
    $this->assign("brand",$result);
    $this->display();
   }




//区分商品类的级别
 public function getClass($class,$pid=0,$html="-☆-",$i=0){
        $i++;
        $list = array();
        foreach($class as $val){
            if($val['pid']==$pid){
                $val['html']=str_repeat($html,$i-1);
                $list[]=$val;
                $list = array_merge($list,$this->getClass($class,$val['id'],$html,$i));
            }
        }
        return $list;


}
//选中商品类别
public function classajax(){
        $pclass = M('goodsclass');
        $re = $pclass->select();
        $j = 0;
        for($i=0;$i<count($re);$i++){
            $id = $re[$i]['id'];
            $re1 = $pclass->where("pid = $id")->select();
            if($re1){

            }else{
                $re2[$j] =$re[$i];
                $j++;
            }
        }
        $reid;
        foreach ($re2 as $k => $v) {
            $reid[$k] = $v['id'];
        }
        $json_string = json_encode($reid); 
        echo $json_string;
    }
//商品品牌图片处理
    public function brandajax(){
        $bid=I('bid');
        $brand=M('brand');
        $pic=$brand->find($bid);
        $json_string = json_encode($pic); 
        echo $json_string;
    }
    //添加商品
    public function addgoods(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小 
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload -> rootPath = "Public";
        $upload->savePath  = '/Admin/uploads/goods/'; // 设置附件上传目录 
            // 上传文件
        $info   =   $upload->upload();
        $data=I();
        $data['addtime']=time();
        $data['soldnum']=0;
        $data['clicknum']=0;
        $goodsclass=M('goodsclass');
        $pname=$goodsclass->find(I('pid'));
        $data['pname']=$pname['name'];
        $data['pic']=$info['pic']['savepath'].$info['pic']['savename'];
        $goods=M('goods');
        // var_dump($data);
        $goods->add($data);
        if($info){
            $this->redirect("goods_list");
        }else{
            $this -> error($upload -> getError());
        }
        // var_dump($data);
    }
    //显示列表页
    public function goods_list(){
        $search=I('search');
        $map['brand'] = array('LIKE',"%{$search}%");
        $goods=M('goods');
        $count = $goods->where($map)->count();
        $Page = new \Think\Page($count,3,$search);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');

      
        $show = $Page->show();
        $result = $goods ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this -> assign("goods", $result);
        $this->assign('page',$show);
        $this -> display();
        
        
        // $result=$goods->select();
        // // var_dump($result);exit;
        // $this->assign("goods",$result);
        // $this->display();
    }
    //添加详情
    public function goodsaddinfo(){
        $gid=I('id');
        $goods=M('goods');
        $result=$goods->find($gid);
        $this->assign("goods",$result);
        // var_dump($result);

        $this->display();
    }
    public function addinfogoods(){
        // $data=I();
        //颜色表
        $color['color']=I('cid');
        $color['gid']=I('gid');
        $infocolor=M('infocolor');
        $addcolor=$infocolor->add($color);
        $data['cid']=$addcolor;
        //尺寸表
        $size['size']=I('size');
        $size['gid']=I('gid');
        $infosize=M('infosize');
        $addsize=$infosize->add($size);
        $data['sid']=$addsize;
        //详情表
        $data['gid']=I('gid');
        $data['number']=I('num');
        $data['price']=I('price');
        // var_dump($data);
        $goodsinfo=M('goodsinfo');
        $goodsinfo->add($data);
        //图片表
        $pic=I('pic');

        $goodspic=M('goodspic');
        foreach ($pic as $key => $value) {

            $pic['pic']=$value;
            $pic['gid']=I('gid');
            unset($pic['0']);
            unset($pic['1']);
            $goodspic->add($pic);
        }
        $this->redirect("goods_list");
    }

    //多文件上传
    public function uploadgoodspic(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload -> rootPath = "Public";
        $upload->savePath  =      '/Admin/uploads/goods/'; // 设置附件上传目录    // 上传文件
        $info   =   $upload->upload();
        //dump($info);
        if($info){
            echo $info['Filedata']['savepath'].$info['Filedata']['savename'];
            exit;
        }else{
            $this -> error($upload -> getError());
        }
    }
    //修改详情
    public function goodsupinfo(){
        $goods=M('goods');
        $result=$goods->find(I('id'));
        $this->assign("goods",$result);
        $this->display();
    }
    public function goodsdoupinfo(){
        $goods=M('goods');
        $result=$goods->save(I());
        // var_dump(I());exit;
        $this->redirect("goods_list");
    }
    //显示详情的详情
    public function goods_list_info(){
        $id=I('id');
        $goods=M('goods');
        $goodspic=M('goodspic');
        $infosize=M('infosize');
        $infocolor=M('infocolor');
        $goodsinfo=M('goodsinfo');
        //商品详情
        $good=$goods->find($id);
        $this->assign("good",$good);
        //商品图片表
        $goodpic=$goodspic->where("gid=$id")->select();
        $this->assign("goodpic",$goodpic);
        //商品颜色
        $color=$infocolor->where("gid=$id")->select();
        $this->assign("color",$color);
        //商品尺寸
        $size=$infosize->where("gid=$id")->select();
        $this->assign("size",$size);
        //商品价格  数量
        $pricenum=$goodsinfo->where("gid=$id")->select();
        $this->assign("pricenum",$pricenum);


        $this->display();
    }
//删除
    public function goodsinfodel(){
        $id=I("id");
        //删除商品
        $goods=M('goods');
        $goods->delete($id);
        //删除商品详情
        $goodsinfo=M('goodsinfo');
        $goodsinfo->where("gid=$id")->delete();
        //删除图片
        $goodspic=M('goodspic');
        $pic=$goodspic->where("gid=$id")->select();
        foreach ($pic as $key => $value) {
            unlink("'Public/'.{$value['pic']}");
        }
        $goodspic->where("gid=$id")->delete();
        //删除颜色
        $color=M('infocolor');
        $color->where("gid=$id")->delete();
        //删除尺寸
        $size=M("infosize");
        $size->where("gid=$id")->delete();
        $this->redirect("goods_list");

    }
    //修改详细信息
    public function upinfogoods(){
        dump(I());
    }
    public function upinfogoods_ajax(){
        $val = I('val');
        $id = I('id');
        $field = I('field');

        $goodsInfo = M('goodsinfo');
        $infoSize = M('infosize');
        $infoColor = M('infocolor');

        //尺寸
        if($field =='size'){
            $data['size'] = $val;
            $re = $infoSize->where("id=$id")->save($data);
        }

        //颜色
        if($field == 'color'){
            $data['color'] = $val;
            $re = $infoColor->where("id=$id")->save($data);
        }

        //价格
        if($field == 'price'){
            $data['price'] = $val;
            $re = $goodsInfo->where("id=$id")->save($data);
        }

        //数量
        if($field == 'number'){
            $data['number'] = $val;
            $re = $goodsInfo->where("id=$id")->save($data);
        }
        echo json_encode($re);

        // $data=I();
        // echo json_encode($data);
    }

}