<?php
namespace Portal\Controller;
use Common\Controller\HomeBaseController;
class ServiceController extends HomeBaseController{
	public function index() {
		$this->display(":service");
	}
	public function nav_index(){
		$navcatname="页面";
		$datas=sp_sql_pages("field:id,post_title;");
		$navrule=array(
				"action"=>"Page/index",
				"param"=>array(
						"id"=>"id"
				),
				"label"=>"post_title");
		exit( sp_get_nav4admin($navcatname,$datas,$navrule) );
	}
}