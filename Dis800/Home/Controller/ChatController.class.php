<?php
namespace Home\Controller;
use Think\Controller;
class ChatController extends Controller {
    public function index(){
      
    }
    public function chat(){
        
        $this->display();
    }
    public function dochat_ajax(){
        $data['content']=I('content');
        $time=date("Y-m-d H:i:s");
        $data['time']=$time;
        $data['uid']=session('id');
        $data['zid']=0;
        // var_dump($data);exit;
        $chat=M('chat');
        $chat->add($data);
        echo json_encode(1);
        
    }
       public function chat_ajax(){
        $chat=M('chat');
        $uid=session('id');
        $result=$chat->where("uid=$uid")->order('time')->select();
        echo json_encode($result);
        
    }

}