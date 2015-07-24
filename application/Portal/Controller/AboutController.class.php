<?php

/**
 * 搜索结果页面
 */
namespace Portal\Controller;
use Common\Controller\HomeBaseController;
class AboutController extends HomeBaseController {
    //文章内页
    public function index() {
		$this -> display(":about");
    }
}
?>
