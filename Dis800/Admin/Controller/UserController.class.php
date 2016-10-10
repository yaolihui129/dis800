<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function islogin_admin(){
        if(session('admin')==null){
        $this->redirect("User/user_login");
        }
     }
    public function index(){ 


    }
    public function user_info(){
        $this->display();
    }
    public function user_login(){
       session('admin',null);
        $this->display();
    }

    public function adduser(){
            $user = D("user");
         if(!empty($_POST['pass'])){
                $_POST['pass'] = md5($_POST['pass']);
                $_POST['repass'] = md5($_POST['repass']);
            }
            //创建数据对象
        if($user -> create()){
           //插入数据
            if($user->add()){
                $this->success("增加用户成功!","user_list");
            }else{
                $this->error("增加用户失败!");
            }
        }else{
            //错误报告
            $this -> error($user->getError());
        }
    }
    //遍历信息
    public function user_list(){
        $this->islogin_admin();
        $user = M('user');//遍历数据库表
        $re = $user->select();//查询
        //遍历权限
        foreach($re as &$v){
            $v['limit1'] = ($v['limit1']==1)?'<font style = "color:green">允许登陆</font>':'<font style = "color:red">禁止登陆</font>';
        }
        $this->assign('re',$re);//与前边的相对应


       //查询 分页 
        $research=I('research');
        $map['id'] = array('LIKE',"%{$research}%");
        $user = M("user");
        $count = $user->where($map)->count();
        $Page = new \Think\Page($count,5,$research);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');

      
        $show = $Page->show();
        $user = $user ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this -> assign("re", $user);
        $this->assign('page',$show);
        $this->display();//显示到前台模板
    }
    //删除
    public function del(){
        $user = M('user');
        if($user -> delete(I('id'))){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    //修改搜索
    public function user_edit(){
        $this->islogin_admin();
        $data['id'] = I('id');
        $user = M('user');
        $user = $user->find($data['id']);
        // var_dump($user);exit;
        $this->assign("user",$user);
        $this->display();
    }

    //编辑
    public function redact(){
        $pass=I('pass');
       //如果密码为空
       if($pass==''){
            $data['id']=I('id');
            $data['user']=I('name');
            $data['limit1']=I('limit1');
            // var_dump($data);exit;
            $user=M('user');
            $user->save($data);
            // var_dumo();exit;
       }else{
        //如果密码不为空
            $data['repass']=I('repass');
            if($pass==$data['repass']){
                $data['pass']=md5($pass);
                $data['id']=I('id');
                $data['user']=I('name');
                $data['limit1']=I('limit1');
                $user=M('user');
                $user->save($data);
            }else{
                $this->error("密码不一致");
            }
       }
       $this->redirect("user_list");
    }





    //管理员添加
    public function admin(){
          $administrator = D("administrator");
         if(!empty($_POST['password'])){
                $_POST['password'] = md5($_POST['password']);
                $_POST['repass'] = md5($_POST['repass']);
            }
            //创建数据对象
        if($administrator -> create()){
           //插入数据
            if($administrator->add()){
                $this->success("增加用户成功!","user_administrate");
            }else{
                $this->error("增加用户失败!");
            }
        }else{
            //错误报告
            $this -> error($administrator->getError());
        }   
    }
    //遍历管理员
    public function user_administrate(){
         $this->islogin_admin();
        $administrator = M('administrator');//遍历数据库表
        $admin_lim=session("admin_lim");
        $admin_user=session('admin');
        if($admin_lim=='1'){
            $re = $administrator->select();//查询
        }else{
            $re = $administrator->where("user='{$admin_user}'")->select();//查询
        }
        $this->assign('re',$re);//与前边的相对应




         $research=I('research');
        $map['id'] = array('LIKE',"%{$research}%");
        $administrator = M("administrator");
        $count = $administrator->where($map)->count();
        $Page = new \Think\Page($count,5,$research);
        $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $Page->setConfig('first','首页');
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('end','尾页');
        $Page->setConfig('num','尾页');
        $Page->setConfig('current','尾页');
        $show = $Page->show();
        $administrator = $administrator ->where($map)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this -> assign("re", $administrator);
        $this->assign('page',$show);

        $this->display();//显示到前台模板
    }
    //管理员删除
    public function admindel(){
        $administrator = M('administrator');
        if($administrator -> delete(I('id'))){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    //管理员修改
    //显示页面先建立隐藏域
    public function user_editadmin(){
         $this->islogin_admin();
        $id=I('id');
        $administrator=M('administrator');
        //查询id
        $result=$administrator->find($id);
        //'result'与显示页面隐藏域相同
        $this->assign('result',$result);
        $this->assign('id',$id);
        $this->display();
    }
    public function redactadmin(){
       $pass=I('password');
       //如果密码为空
       if($pass==''){
            $data['id']=I('id');
            $data['user']=I('user');
            $data['limit1']=I('limit1');
            $administrator=M('administrator');
            $administrator->save($data);
       }else{
        //如果密码不为空
            $data['repass']=I('repass');
            if($pass==$data['repass']){
                $data['password']=md5($pass);
                $data['id']=I('id');
                $data['user']=I('user');
                $data['limit1']=I('limit1');
                $administrator=M('administrator');
                $administrator->save($data);
            }else{
                $this->error("密码不一致");
            }
       }
       $this->redirect("user_administrate");
    }

    //后台登陆
    public function login(){
        $administrator = M('administrator');
        $username = I('username');
        //定义session
        $pwd = md5(I('pwd'));
        $find = $administrator -> where("user = '{$username}' and password = '{$pwd}'")->find();
        if($find){
            $admin_limit1=$find['limit1'];
        session('admin_lim',$admin_limit1);
        session('admin',$username);
        $this->redirect("Index/index");
    }else{
        $this->error("用户名错误或者您没有权限");
    }

}

}