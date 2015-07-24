<?php
namespace Api\Controller;
use Common\Controller\AppframeController;
class GuestbookController extends AppframeController{
	
	protected $guestbook_model;
	
	function _initialize() {
		parent::_initialize();
		$this->guestbook_model=D("Common/Guestbook");
	}
	
	function index(){
		
	}
	/**
	 * 添加留言组件
	 * @return [type] [description]
	 */
	function addmsg(){
		$post=$_POST['postFiled'];
		if(!IS_AJAX){
			$this->error('非法提交',U('/Service/index'));
		}
		if($_SESSION['_verify_']['verify']!=$post['code']){
			exit('-1');
		}else{
			unset($post['code']);
			$post['createtime']=time();
			$post['remoteaddr']=ip2long(get_client_ip());
		}
		if(M('guestbook')->add($post)){
			$data['status']=1;
			$data['info']='留言成功我们将尽快和您联系！';
			$_SESSION['_verify_']['verify']="";
		}else{
			$data['status']=0;
			$data['info']='Sorry,留言失败!';
		}
		$this->ajaxReturn($data);
	}
}