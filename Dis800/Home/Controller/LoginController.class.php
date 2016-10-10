<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {
	 public function _initialize(){
        $close=M('close');
        $result=$close->find();
        if($result['close']==1){
            $this->redirect("Public/a");
        }
    }
    public function index(){
       
    }
	public function login(){
		$this->display();
	}
	public function register(){
		$this->display();
	}
	//修改密码
	public function pwd(){
		$this->display();
	}
	public function two(){
		$this->display();
	}
	public function three(){
		$this->display();
	}
	public function four(){
		$this->display();
	}
	public function five(){
		$this->display();
	}
	public function smalllogin(){
		$this->display();
	}

   
	//ajax判断
	public function checkname(){
		$user = M('user');
		$user1 = I('user');
		if($user->where("user = '$user1'")->find()){
			echo 1;
		}else{
			echo 0;
		}
	}
	//登陆
	public function dologin(){
		// session('[start]');
		//接收
		 $user = M("user");
		 //获取ID
         $name = I('user');
         //获取密码
         $pass = I('pass');
         $pass=md5($pass);
         //查询密码是否一致
         $data = $user->where("user='{$name}' and pass='{$pass}'")->select();
        if($data){
        	//session接收id
        	  	session('name',$name);
        	  	
				session('id',$data[0]['id']);
       	//获得最后登录时间
            $user = M("user");
         //获得时间
            $time['ltime']=time();
            $id= session('id');
         //查询id改变时间
            $aa=$user-> where("id = $id")->save($time);
            if (session("url")=='') {
            	$this->redirect("Index/index");
            }else{
            	$url=session("url");
            	// var_dump($url);exit;
            	// echo "<script>window.location.href="+$url+";</script>";
            	// $this->redirect("index/index");
            	redirect($url);
            	// $this->success("登陆成功","$url");
            }
            
        }else{
          $this->error("登录失败！！");
        }

	}
	public function clearsession(){
		session('name',null);
		session('id',null);
		session("cart_num",null);
		session("url",null);
		$this->redirect('Index/index');
	}


	//注册
	public function doregister(){
		$user = M('user');
	    $data['ltime'] = time();				//最后登录时间			
	    $data['user'] = I('user');				//用户名
	    $data['pass'] = md5(I('pass'));				//密码
	    $time['time'] = time();					//注册时间
	    $re = $user->add($data);
	    if($re){
	    	session('name',$data['user']);		//session name
	    	session('id',$re);		//session name
	    	echo "1";
	    }else{
	    	echo "0";
	    }
    }


	public function code(){
		$config =    array(    
			'fontSize'    =>    20,    // 验证码字体大小
		    'length'      =>    4,     // 验证码位数    
		    'useNoise'    =>    false, // 关闭验证码杂点
		    'imageW'	  =>    130,
		    'imageH'	  =>     40,
		    'useCurve'	  =>     false,
		    'useImgBg'	  =>     true,
		    'codeSet'	  => '0123456789',
		    );
		$Verify = new \Think\Verify($config);
		$Verify->entry(1);
		
	}
//判断验证码
	public function check_verify(){
		$code = I('code');
	    $verify = new \Think\Verify();
		echo $verify->check($code,1);
	}
	//找回密码
	public function pwd_one(){
		$user =M('user');
		$aa = I();
		$id = I('username');
		$username=I('username');
		//从user表查询上面的$username
		$find = $user -> where("user='$username'")->find();

		// session("mail_e",$find['mail']);
		session("id_id",$find['id']);
		if($find){
			$this->redirect("two");
		}else{
			$this->error("请输入正确用户");
		}
	}
	//验证信息
 public function pwd_three(){
 		$user = M('user');
 		$cont = I();
 		$issue = I('issue');
 		$id=session("id_id");
 		$find = $user -> where("issue = '{$issue}' and id = '{$id}'")->find();
 		// var_dump($issue);exit;
 		if($find){
 			$this->redirect("four");
 		}else{
 			$this->error("请输入正确信息");
 		}
    }


    //重置密码
    public function pwd_four(){
    	$data['pass'] = I('pass');
    	$data['renewpwd'] = I('renewpwd');
    	$data['id']=session("id_id");
    	if($data['pass'] == $data['renewpwd']){
           $data['pass'] = md5($data['pass']);
           $user=M('user');
           $user->save($data);
    	// dump($user->save($data));exit;
    	}else{
    		$this->error("修改失败");
    	}
    	$this->redirect("five");

    }
    public function rightstrip(){
        $cartsql = M('cart');
        $uid = session('id');
        $cartnum = $cartsql->where("uid=$uid")->count();
        session("cart_num",$cartnum);
    }

}