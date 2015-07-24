<?php

/**
 * 文章内页
 */
namespace Portal\Controller;
use Common\Controller\HomeBaseController;
class NewsController extends HomeBaseController {
    //文章内页
    public function index() {
        if(!$Child_nav=json_decode(F('child_nav'),1)){
            $child_nav=M('terms')->where(array('status'=>1))->select();
            F('child_nav',$child_nav);
        }
        $childnav=getSon($child_nav,6,'parent','term_id',0);
        $cid=(isset($_GET['nav']))?intval(encryption($_GET['nav'],1)):0;
        $navstr='';
        $cururl=U('Portal/News/Index');
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
            $onenav='<a href="'.$cururl.'">全部新闻</a>';
        }else{
            $onenav='<a href="'.$cururl.'" class="green">全部新闻</a>';
        }
        $onenav.=$navstr;
        $lists = sp_sql_posts_paged(6,"cid:$cid;order:post_date DESC;field:post_author,post_date,post_content,post_title,post_status,post_parent,smeta,term_id,name,path",2);
    	$tplname=$term["one_tpl"];
    	$tplname=sp_get_apphome_tpl($tplname, "news");
        $this->onenav=$onenav;
        if(empty($lists['posts'])){
            $this->empty='<p style="font-size: 20px;padding-top:30px;">地球目前还没有这方面的新闻~……~！</p>';
        }
        $this->list=$lists['posts'];
        $this->page=$lists['page'];
    	$this->display(":$tplname");
    }
    public function do_like(){
    	$this->check_login();
    	
    	$id=intval($_GET['id']);//posts表中id
    	
    	$posts_model=M("Posts");
    	
    	$can_like=sp_check_user_action("posts$id",1);
    	
    	if($can_like){
    		$posts_model->save(array("id"=>$id,"post_like"=>array("exp","post_like+1")));
    		$this->success("赞好啦！");
    	}else{
    		$this->error("您已赞过啦！");
    	}
    	
    }
}
?>
