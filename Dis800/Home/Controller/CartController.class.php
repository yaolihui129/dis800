<?php
namespace Home\Controller;
use Think\Controller;
class cartController extends Controller {
     public function _initialize(){
        $close=M('close');
        $result=$close->find();
        if($result['close']==1){
            $this->redirect("Public/a");
        }
    }
   public function index(){

   }


    public function countersign(){
        $uid = session('id');
        $addresssql = M('address');
        $addressres =$addresssql->where("uid=$uid")->order('defaultadd DESC')->select();
        $this->assign("addresslist",$addressres);
        $cartsql = M('cart');
        $cartlist = $cartsql->where("uid=$uid")->select();
        $this->assign("cartlists",$cartlist);
        //查询商品数量
        $cartnum = $cartsql->where("uid=$uid")->count();
        $cartlistes = $cartsql->where("uid=$uid")->select();
        $this->assign("cartnums",$cartnum); 
        $this->assign("cartlistess",$cartlistes);
    	$this->display();
    }
    public function pay(){
    	$this->display();

    }

   //购物车页面
    public function cart(){
        //添加商品
        $uid = session('id');
        $cartsql = M("cart");
        $cartnum = $cartsql -> where("uid = $uid") -> select();
        $this -> assign("cartnum",$cartnum);
        $this -> display();
    }
    public function cartajax(){
        $cartsql = M('cart');
        $uid = session('id');
        $cartnum = $cartsql->where("uid = $uid")->count();
        echo $cartnum;
    }


    //插入数据库（购物车）
    public function inertcart(){
        $cartsql= M('cart');
        //商品ID
        $data['gid'] = I('gid');
        //用户ID
        $data['uid'] = session('id');
         //商品颜色
        $data['gcolor'] = I('color');
        //商品尺寸
        $data['gsize'] = I('size');
        //商品名称
        $data['gname'] = I('name');
        //商品数量
        $data['number'] = '1';
        //商品单价
        $data['gmoney'] = I('money');
        //商品总价
        $data['totalprice'] = I('money');
        //商品图片
        $data['cartpic'] = I('cartpic');
        //商品库存
        $data['goodnumber'] = I('goodnumber');
        $cartsql -> add($data);
        $this->rightstrip();
        $this->redirect("Cart/cart");

    }
    //删除数据(购物车)
    public function cartdel(){
        $cartsql = M('cart');
        $cartsql -> delete(I('id'));
        $this->rightstrip();
        $this->redirect("Cart/cart"); 

    }
    //添加(减)购物车内商品数量
    public function cartsubtractnum(){
        $cartsql = M('cart');
        $data['number'] = I('number');
        $data['gmoney'] = I('gmoney');
        $data['totalprice'] = I('totalprice');
        $id = I('id');
        $cartsql->where("id=$id")->save($data);
        echo json_encode(I());
    }

    public function cartadddel(){
        $sitedel = M('address');
        $sitedel -> delete(I('id'));
        $this -> redirect('Cart/countersign');
    }
    public function cartupdataa(){
       $addresssql = M('address');
        $id = I('id');
        $uid = session('id');
        $data['defaultadd'] = 0;
        $addresssql->where("uid = $uid AND defaultadd = 1") -> save($data);

        $data['defaultadd'] = 1;
        $addresssql->where("id = $id")->save($data);
       $defaultadd = $addresssql->where("id = $id")->getfield("defaultadd",true);
       $this -> redirect('countersign');
    }
    //添加收货地址
    public function cartinserts(){
        $smailinsert = M('address');
        $data['address'] = I('s_province').'/'.I('s_city').'/'.I('s_county').'/'.I('samiladd');
        $data['name'] = I('name');
        $data['tel'] = I('phone');
        $data['email'] = I('email');
        $data['postcode'] = I('insertbody_postcode');
        $data['defaultadd'] = I('addsleected');
        $data['uid'] = session('id');
        if($data['defaultadd'] == 1){
            $uid = session('id');
            $defaultadd['defaultadd'] = '0';
            $smailinsert->where("uid = $uid AND defaultadd = 1") -> save($defaultadd);
        } 
        if($smailinsert -> add($data)){
            $this -> redirect('countersign');
        }else{
            $this -> error("添加地址失败",'countersign');
            }
    }

    public function setaddress(){
        $address=M("address");
        $id=$_POST['id'];
        $res=$address->where("id={$id}")->find();
        echo json_encode($res);
    }
    public function cartinsert(){
        $this->display();
    }
    
    public function addressupdate(){
        $siteup = M("address");

        $uid = session('id');
        $defaultadd['defaultadd'] = '0';
        $siteup->where("uid = $uid AND defaultadd = 1") -> save($defaultadd);

        $date['name'] = I('user');
        $date['tel'] = I('phone');
        $date['email'] = I('email');
        $province = I('s_province');
        $city = I('s_city');
        $county = I('s_county');
        $add = I('samiladd');
        $date['defaultadd'] = I('addsleected');
        $date['address'] = $province.'/'.$city.'/'.$county.'/'.$add;
        $date['postcode'] = I('updatebody_postcode');
        $date['id'] = I('addid');
            if($siteup -> save($date)){
                $this -> redirect('countersign');
            }else{
                $this -> error("修改失败","countersign");
            }
            
    }   

    public function site_inert(){
      $siteinert = M('address');
        //省
        $s_provinc = I('s_province');
        //市
        $s_city = I('s_city');
        //县、市
        $s_county = I('s_county');
        //详细地址
        $add = I('add');
        //拼接详细地址
        $address = $s_provinc.'/'.$s_city.'/'.$s_county.'/'.$add;
        //写入数组
        $data['name'] = I('name');
        $data['tel'] = I('tel');
        $data['email'] = I('email');
        $data['postcode'] = I('postcode');
        $data['address'] = $address;
        $data['uid'] = I('uid');
        $data['defaultadd'] = '1';
        $siteinert -> add($data);
        $this -> redirect('Cart/countersign');
    
    }
    //插入订单表中 删除购物表中内容
    public function insertpay(){
        session("cart_num",null);        $ordersql = M('order'); 
        $uid = session('id');
        $data['aid'] = I('aid');
        $data['totalprice'] = I('totalprice');
        $data['time'] = time();
        $data['uid'] = $uid;
        $oid = $ordersql->add($data);
        $orderinfosql = M("orderinfo"); 
        $cartsql = M('cart');
        $date['oid'] = $oid;
        //要提交的数量
        $count = I("count");
        $gid = I("gid");
        $i = 0;

        for($i;$i<$count;$i++){
            $cartlist = $cartsql->where("gid=".$gid[$i])->select(); 
            $date['size'] = $cartlist[0]["gsize"];
            $date['pic'] = $cartlist[0]["cartpic"];
            $date['name'] = $cartlist[0]['gname'];
            $date['gid'] = $cartlist[0]['gid'];
            $date['color'] = $cartlist[0]['gcolor'];
            $date['price'] = $cartlist[0]['totalprice'];
            $date['number'] = $cartlist[0]['goodnumber'];
            $orderinfosql->add($date);
        } 

        $cartsql->where("uid=".$uid)->delete();
        session('order_oid',$oid);
        $this->redirect('pay');
    }

    //付款的pay
    public function payment(){
        $data['static'] = '1';
        $oid = session('order_oid');
        $uid = session('id');
        $ordersql = M("order");
        $ordersql->where("uid=$uid AND id=$oid")->save($data);
        session("order_oid",null);
        $this->redirect('Index/index');
    }
    public function change_static(){
        $oid=I('oid');
        $order=M('order');
        $data['static']=1;
        $order->where("id=$oid")->save($data);
        $this->redirect("User/order");
    }
    public function change_sta(){
        $oid=I('oid');
        $order=M('order');
        $data['static']=3;
        $order->where("id=$oid")->save($data);
        $this->redirect("User/order");


    }
     public function rightstrip(){
        $cartsql = M('cart');
        $uid = session('id');
        $cartnum = $cartsql->where("uid=$uid")->count();
        session("cart_num",$cartnum);
    }
}