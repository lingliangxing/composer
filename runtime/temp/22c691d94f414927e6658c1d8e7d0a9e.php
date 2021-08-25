<?php /*a:3:{s:71:"/www/wwwroot/lingzweb/public/../templates/default/cms/show_picture.html";i:1628763224;s:65:"/www/wwwroot/lingzweb/public/../templates/default/cms/header.html";i:1628763224;s:65:"/www/wwwroot/lingzweb/public/../templates/default/cms/footer.html";i:1628763224;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php if(isset($SEO['title']) && !empty($SEO['title'])): ?><?php echo htmlentities($SEO['title']); ?><?php endif; ?><?php echo htmlentities($SEO['site_title']); ?></title>
    <meta name="keywords" content="<?php echo htmlentities($SEO['keyword']); ?>" />
    <meta name="description" content="<?php echo htmlentities($SEO['description']); ?>" />
    <link rel="stylesheet" href="/static/modules/cms/css/base.css">
    <link rel="stylesheet" href="/static/modules/cms/css/style.css">
    <script src="/static/modules/cms/js/jquery.min.js"></script>
    <script src="/static/modules/cms/js/jquery.SuperSlide.2.1.3.js"></script>
</head>

<body>
    <!--S 头部-->
    <div class="header">
        <div class="w1200">
            <div class="logo fl">
                <a href="<?php echo htmlentities($siteurl); ?>">
                    <img src="/static/modules/cms/images/logo.png" alt="" />
                </a>
		    </div>
            <div class="topright fr">
            	<!--S 搜索栏-->
            	<div class="topbtn fr">
            		<div class="search-box fr">
            			<span class="butn hov"><i></i></span>
						<div class="share-sub" style="width: 0px;">
						    <form name="formsearch" action="<?php echo url('cms/index/search'); ?>">
						        <input class="fl tex" type="text" name="keyword" value="请输入关键字" onfocus="if(this.value==defaultValue)this.value=''" onblur="if(this.value=='')this.value=defaultValue">
						        <input type="submit" value="" class="fl sub-btn ico">
						    </form>
						</div>
            		</div>
            	</div>
                <!--E 搜索栏-->
                <!--S 导航-->
                <div class="nav fl">
                    <ul class="navlist">
                        <li <?php if(!isset($catid)): ?>class="hover"<?php endif; ?>><a href="<?php echo htmlentities($siteurl); ?>" title="首页">首页</a></li>
                        <?php $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'category','catid'=>'0','cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "category")):$data = $cmsTagLib->category(array('module'=>'cms','action'=>'category','catid'=>'0','cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif; if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li <?php if(isset($catid) && in_array($catid,explode(',',$vo['arrchildid']))): ?>class='hover'<?php endif; ?>>
                            <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['catname']); ?>"><?php echo htmlentities($vo['catname']); ?></a>
                            <!--判断是否有子栏目-->
                            <?php if($vo['child'] == '1'): ?>
                            <div class="subnav">
                                <?php $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'category','catid'=>$vo['id'],'cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "category")):$data = $cmsTagLib->category(array('module'=>'cms','action'=>'category','catid'=>$vo['id'],'cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif; foreach($data as $key=>$vo): ?>
                                <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['catname']); ?>"><?php echo htmlentities($vo['catname']); ?></a>
                                <?php endforeach; ?>
                                
                            </div>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        
                    </ul>
                </div>
                <!--E 导航-->
                <!--S 会员中心-->
                <div class="user fr">
                	<ul>
                		<?php if($userinfo): ?>
                        <li><a href="<?php echo url('member/index/index'); ?>">会员：<?php echo htmlentities($userinfo['username']); ?></a></li>
                        <li><a href="<?php echo url('member/index/logout'); ?>">退出</a></li>
                		<?php else: ?>
                        <li class="log"><a href="<?php echo url('member/index/login'); ?>">登录</a></li>
                        <li class="reg"><a href="<?php echo url('member/index/register'); ?>">注册</a></li>
                		<?php endif; ?>
                	</ul>
                </div>
                <!--E 会员中心-->
            </div>
        </div>
        <!--E 头部-->
    </div>
<style type="text/css">
body {
    background: #f6f6f6;
}
</style>
<div class="headline-bg"></div>
<div class="main" style="position: relative;">
    <div class="w1200">
        <div class="container-top">
            <h2><?php echo htmlentities($category['catname']); ?><span><?php echo htmlentities($category['catdir']); ?></span></h2>
            <!-- 面包屑 -->
            <div class="bread-nav">
                <a href="<?php echo htmlentities($siteurl); ?>">首页</a>&gt; <?php echo catpos($catid); ?>
            </div>
        </div>
        <div class="content">
            <!--S 内容 -->
            <div class="case_ny_left">
            	<h2><?php echo htmlentities($title); ?></h2>
            	<div class="casePreview clearfix">
            		<a class="backBtn" href="javascript:;">返回列表</a>
            		<a class="previewBtn" href="javascript:;" target="_blank">预览案例</a>
            	</div>
            	<div class="caseTitle">项目标签</div>
            	<div class="detaLabels">
                    <?php if(!(empty($tags) || (($tags instanceof \think\Collection || $tags instanceof \think\Paginator ) && $tags->isEmpty()))): $_result=explode(',',$tags);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            		<a class="labelList" href="<?php echo url('cms/index/tags',['tag'=>$vo]); ?>"><?php echo htmlentities($vo); ?></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php endif; ?>
            	</div>
            	<div class="caseTitle">项目简介</div>
            	<div class="detaIntro"><?php echo htmlentities($description); ?></div>
            	<div class="caseTitle">项目介绍</div>
            	<div class="detaBody"><?php echo $content; ?></div>
            </div>
            <div class="case_ny_right">
            	<h3>热门新闻</h3>
                <?php $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'lists','catid'=>'6','cache'=>'3600','order'=>'listorder DESC','num'=>'5','page'=>$page,'return'=>'data',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "lists")):$data = $cmsTagLib->lists(array('module'=>'cms','action'=>'lists','catid'=>'6','cache'=>'3600','order'=>'listorder DESC','num'=>'5','page'=>$page,'return'=>'data',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif;$pages = $data->render(); if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            	<div class="newsBox">
            		<div class="newsBody">
            			<a class="newsTitle" href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>"><?php echo htmlentities($vo['title']); ?></a>
            			<div class="newsIntro"><?php echo htmlentities(str_cut($vo['description'],50)); ?></div>
            		</div>
            	</div>
            	<?php endforeach; endif; else: echo "" ;endif; ?>
                
            </div>
            <!--E 内容 -->
        </div>
    </div>
</div>
<!--S 底部-->
<div class="footer">
    <div class="w1200 clearfix">
        <div class="links">
            <!--此处可用安装友情链接模块-->
            <span>友情链接：</span>
            <a href="http://www.baidu.com/" target="_blank">百度一下</a>
            <a href="https://gitee.com/ken678/YZNCMS" target="_blank">源码下载</a>
            <a href="https://www.kancloud.cn/ken678/yzncms" target="_blank">手册文档</a>
            <a href="http://www.thinkphp.cn/" target="_blank">thinkphp</a>
            <a href="http://www.taobao.com/" target="_blank">淘宝</a>
            <!--此处可用安装友情链接模块-->
        </div>
        <ul class="botnavlist fl">
            <?php $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'category','cache'=>'3600','where'=>'id in(1,6,8)','order'=>'listorder DESC','num'=>'4','return'=>'data','page'=>'0',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "category")):$data = $cmsTagLib->category(array('module'=>'cms','action'=>'category','cache'=>'3600','where'=>'id in(1,6,8)','order'=>'listorder DESC','num'=>'4','return'=>'data','page'=>'0',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif; if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li><a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['catname']); ?>"><?php echo htmlentities($vo['catname']); ?></a>
                <div class="drop clearfix">
                    <!--判断是否有子栏目-->
                    <?php if($vo['child'] == '1'): $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'category','catid'=>$vo['id'],'cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "category")):$data = $cmsTagLib->category(array('module'=>'cms','action'=>'category','catid'=>$vo['id'],'cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif; if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['catname']); ?>"><?php echo htmlentities($vo['catname']); ?></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    
                    <?php endif; ?>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            
        </ul>
        <div class="qcode fr">
            <!--此处变量可以后台配置设置调用-->
            <div class="btel fl">
                <p class="p2">0512-88888888</p>
                <p class="p3">邮　箱：admin@admin.com</p>
                <p class="p3">手　机：158-88888888</p>
                <p class="p3">地　址：江苏省苏州市吴中区某某工业园一区</p>
            </div>
            <img class="ewm fr" src="/static/modules/cms/images/erweima.jpg" alt=""></div>
            <!--此处变量可以后台配置设置调用-->
        </div>
</div>
<div class="copy">
    <!--此处变量可以后台配置设置调用-->
    <div class="w1200 clearfix">
        <p class="fl">Copyright © 2018-2019&nbsp;&nbsp;某某网络科技有限公司 版权所有&nbsp;&nbsp;备案号：<a href="https://beian.miit.gov.cn/" target="_blank" title="苏ICP备********号">苏ICP备********号</a></p>
    </div>
    <!--此处变量可以后台配置设置调用-->
</div>
<div class="tips">
    <div class="w1200">
        <p class="tc">【本站素材及资源全来源于互联网,非商业性质,仅供演示和学习,不承担任何版权问题,如果我们侵犯了您的权益,请来信告知,我们会在第一时间处理！】</p>
    </div>
</div>
<!--E 底部-->
<script src="/static/modules/cms/js/base.js"></script>
</body>

</html>