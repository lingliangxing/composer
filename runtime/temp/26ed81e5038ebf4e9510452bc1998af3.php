<?php /*a:4:{s:63:"/www/wwwroot/lingzweb/public/../templates/default/cms/show.html";i:1628763224;s:65:"/www/wwwroot/lingzweb/public/../templates/default/cms/header.html";i:1628763224;s:64:"/www/wwwroot/lingzweb/public/../templates/default/cms/sider.html";i:1628763224;s:65:"/www/wwwroot/lingzweb/public/../templates/default/cms/footer.html";i:1628763224;}*/ ?>
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
            <!--S 左侧栏目 -->
            <div class="content-left">
    <h2 class="content-title"><?php echo getCategory($top_parentid,'catname'); ?></h2>
    <div class="menu-list">
        <?php $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'category','catid'=>$top_parentid,'cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "category")):$data = $cmsTagLib->category(array('module'=>'cms','action'=>'category','catid'=>$top_parentid,'cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif; foreach($data as $key=>$vo): ?>
        <a href="<?php echo htmlentities($vo['url']); ?>" class="transition <?php if($vo['id']==$catid): ?>active<?php endif; ?>"><?php echo htmlentities($vo['catname']); ?></a>
        <?php endforeach; ?>
        
    </div>
    <!--S 联系我们 -->
    <div class="content-contact">
        <div class="h2bg">
            <h2>联系我们</h2>
        </div>
        <div class="cc-info">
            <!--此处变量可以后台配置设置调用-->
            <p>手　机：158-88888888</p>
            <p>传　真：0512-88888888</p>
            <p>邮　箱：admin@admin.com</p>
            <p>地　址：江苏省苏州市吴中区某某工业园一区</p>
            <!--此处变量可以后台配置设置调用-->
        </div>
    </div>
    <!--E 联系我们 -->
</div>
            <!--E 左侧栏目 -->
            <!--S 右侧内容 -->
            <div class="content-right">
                <div class="about" deep="4">
                    <div class="newsshow">
                        <div class="new_til">
                            <h2><?php echo htmlentities($title); ?></h2>
                            <div class="date clearfix">
                                <span class="s1">时间：<?php echo htmlentities(date('Y-m-d H:i',!is_numeric($inputtime)? strtotime($inputtime) : $inputtime)); ?></span>
                                <span class="s2">阅读：<?php echo htmlentities($hits); ?></span>
                                <span class="s3">来源：互联网</span></div>
                        </div>
                        <div class="newsview">
                            <?php if($allow_visitor == '1'): ?>
                            <?php echo $content; else: ?>
                            <div class="allow_visitor">
                                <a href="<?php echo url('cms/index/readpoint',['allow_visitor' => $allow_visitor]); ?>"><font color="red">阅读此信息需要您支付 <B><I><?php echo htmlentities($readpoint); if($paytype): ?>元<?php else: ?>点<?php endif; ?></I></B>，点击这里支付</font></a>
                            </div>
                            <?php endif; ?>
                            <!--S 分页-->
                            <?php echo $pages; ?>
                            <!--E 分页-->
                        </div>
                        <div class="viewpage">
                            <div class="main_r_nav">
                                <?php $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'pre','catid'=>$catid,'id'=>$id,'cache'=>'3600','return'=>'data','page'=>'0',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "pre")):$data = $cmsTagLib->pre(array('module'=>'cms','action'=>'pre','catid'=>$catid,'id'=>$id,'cache'=>'3600','return'=>'data','page'=>'0',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif; ?>
                                <a href="<?php echo htmlentities($data['url']); ?>" <?php echo htmlentities($data['target']); ?>>上一篇：<?php echo htmlentities($data['title']); ?></a>
                                
                                <?php $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'next','catid'=>$catid,'id'=>$id,'cache'=>'3600','return'=>'data','page'=>'0',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "next")):$data = $cmsTagLib->next(array('module'=>'cms','action'=>'next','catid'=>$catid,'id'=>$id,'cache'=>'3600','return'=>'data','page'=>'0',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif; ?>
                                <a href="<?php echo htmlentities($data['url']); ?>" <?php echo htmlentities($data['target']); ?>>下一篇：<?php echo htmlentities($data['title']); ?></a>
                                
                            </div>
                            <div class="returnlist"> <a href="javascript:history.go(-1);" title="返回列表">返回列表</a> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--E 右侧内容 -->
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