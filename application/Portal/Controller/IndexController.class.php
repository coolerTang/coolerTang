<?php
namespace Portal\Controller;
use Common\Controller\HomeBaseController; 
/**
 * 首页
 */
class IndexController extends HomeBaseController {
    //首页
	public function index() {
		$res=M('posts')->order('post_modified DESC')->limit(3)->field('post_title,post_content,post_modified')->select();
		$this->res=$res;
    	$this->display(":index");
    }   
}

?>
