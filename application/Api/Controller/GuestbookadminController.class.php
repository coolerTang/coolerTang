<?php
namespace Api\Controller;
use Common\Controller\AdminbaseController;
class GuestbookadminController extends AdminbaseController{
	
	protected $guestbook_model;
	
	function _initialize() {
		parent::_initialize();
		$this->guestbook_model=D("Common/Guestbook");
	}
	
	function index(){
		$count=$this->guestbook_model->where(array("status"=>1))->count();
		$page = $this->page($count, 20);
		$guest=$this->guestbook_model->where(array("status"=>1))->order(array("createtime"=>"DESC"))->limit($page->firstRow . ',' . $page->listRows)->select();
		$Ip = new \Org\Net\IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
		$guestmsgs=array();
		foreach ($guest as $value) {
			foreach ($value as $key => $val) {
				if($key=='remoteaddr'){
					$location=$Ip->getlocation(long2ip($val));
					$value[$key]=long2ip($val).'('.$location['country'].')';
				}else if($key=='createtime'){
					$value[$key]=$val;
					$value[$key]=date("Y-m-d H:i:s",$val);
				}
			}
			$guestmsgs[]=$value;
		}
		$this->assign("Page", $page->show('Admin'));
		$this->assign("guestmsgs",$guestmsgs);
		$this->display();
	}

	function delete(){
		$id=intval(I("get.id"));
		$result=$this->guestbook_model->where(array("id"=>$id))->delete();
		if($result!==false){
			$this->success("删除成功！", U("Guestbookadmin/index"));
		}else{
			$this->error('删除失败！');
		}
	}
}