<?php
namespace Admin\Controller;
use Think\Controller;
class ChatController extends Controller {
	//用构造方法禁止输入网站跳转页面
	 public function index(){
      
    }
    public function chat(){
        $chat=M('chat');
        $uid=I('uid');
        
        $this->assign("uid",$uid);
        $this->display();
    }
    public function dochat_ajax(){
        $data['content']=I('content');
        $time=date("Y-m-d H:i:s");
        $data['time']=$time;
        $data['uid']=I('cuid');
        $data['zid']=1;
        // var_dump($data);exit;
        $chat=M('chat');
        $chat->add($data);
        echo json_encode(1);
        
    }
       public function chat_ajax(){
        $chat=M('chat');
        $uid=I('uid');
        $result=$chat->where("uid=$uid")->order('time')->select();
        echo json_encode($result);
        
    }

     public function chat_list(){
        $chat=M('chat');
        $result=$chat->group('uid')->select();
        // var_dump($result);
        $this->assign("chat",$result);
        $this->display();
    }
    public function del_chat(){
        $uid=I('uid');
        $chat=M('chat');
        $chat->where("uid=$uid")->delete();
        $this->redirect("chat_list");
    }
}