<?php
namespace Portal\Controller;
use Common\Controller\HomeBaseController;
/**
 * 案例列表
*/
class ListController extends HomeBaseController {
	//网站案例
	public function index() {
		if(!$Child_nav=json_decode(F('child_nav'),1)){
            $child_nav=M('terms')->where(array('status'=>1))->select();
            F('child_nav',$child_nav);
        }
        $childnav=getSon($child_nav,3,'parent','term_id',0);
        $cid=(isset($_GET['nav']))?intval(encryption($_GET['nav'],1)):0;
        $navstr='';
        $cururl=U('Portal/List/Index');
        foreach ($childnav as $key => $value) {
            if(isset($cid)){
                if($value['term_id']==$cid){
                    $class=' class=green ';
                }else{
                    $class='';
                }
                $navstr.='<a href="'.$cururl.'/nav/'.encryption($value['term_id']).'"'.$class.'title="'.$value['name'].'">'.$value['name'].'</a>';
            }
        }
        if($cid){
            $onenav='<a href="'.$cururl.'">全部案例</a>';
        }else{
            $onenav='<a href="'.$cururl.'" class="green">全部案例</a>';
        }
        $onenav.=$navstr;
        $lists = sp_sql_posts_paged(3,"cid:$cid;order:post_date DESC;field:post_author,post_date,post_content,post_title,post_excerpt,post_status,post_parent,smeta,term_id,name,path",2);
    	$tplname=$term["one_tpl"];
    	$tplname=sp_get_apphome_tpl($tplname, "list");
        $this->onenav=$onenav;
        if(empty($lists['posts'])){
            $this->empty='<p style="font-size: 20px;padding-top:30px;">地球目前还没有这方面的案例~……~！</p>';
        }
        $this->list=$lists['posts'];
        $this->page=$lists['page'];
    	$this->display(":$tplname");
	}
}
?>
