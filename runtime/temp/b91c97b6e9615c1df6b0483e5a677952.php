<?php /*a:3:{s:64:"/www/wwwroot/lingzweb/public/../templates/default/cms/index.html";i:1628763224;s:65:"/www/wwwroot/lingzweb/public/../templates/default/cms/header.html";i:1628763224;s:65:"/www/wwwroot/lingzweb/public/../templates/default/cms/footer.html";i:1628763224;}*/ ?>
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
<!--S 轮播图-->
<div class="fullSlide">
    <div class="bd">
        <ul>
            <li _src="url(/static/modules/cms/images/banner01.jpg)" style="background:#fff center 0 no-repeat;"><a target="_blank" href="javascript:;"></a></li>
            <li _src="url(/static/modules/cms/images/banner02.jpg)" style="background:#fff center 0 no-repeat;"><a target="_blank" href="javascript:;"></a></li>
            <li _src="url(/static/modules/cms/images/banner03.jpg)" style="background:#fff center 0 no-repeat;"><a target="_blank" href="javascript:;"></a></li>
        </ul>
    </div>
    <div class="hd">
        <ul></ul>
    </div>
    <span class="prev"></span>
    <span class="next"></span>
</div>
<!--E 轮播图-->
<!--S 案例-->
<div class="main_case">
    <div class="w1200">
        <div class="m_til">
            <h5><em class="enfont">EXCELLENT CASE<i></i></em></h5>
            <span>精品案例</span>
        </div>
        <div class="case_list">
            <ul>
            <?php $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'lists','flag'=>'4','catid'=>'5','cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "lists")):$data = $cmsTagLib->lists(array('module'=>'cms','action'=>'lists','flag'=>'4','catid'=>'5','cache'=>'3600','order'=>'listorder DESC','num'=>'10','return'=>'data','page'=>'0',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif; if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            	<li>
            		<a href="<?php echo htmlentities($vo['url']); ?>" class="pr">
            			<img src="<?php echo htmlentities((isset($vo['thumb']) && ($vo['thumb'] !== '')?$vo['thumb']:'https://via.placeholder.com/380x285')); ?>" alt="<?php echo htmlentities($vo['title']); ?>">
            			<div class="top-Floor pa transition"> <span class="white-cross pa"></span></div>
            		</a>
            		<a href="<?php echo htmlentities($vo['url']); ?>" class="case_a transition pr">
            			<h2 class="el"><?php echo htmlentities($vo['title']); ?></h2>
            			<div class="nr"><?php echo htmlentities(str_cut($vo['description'],100)); ?></div>
            		</a>
            	</li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            
            </ul>
            <a class="x_arrs prev" href="javascript:void(0)"></a>
            <a class="x_arrs next" href="javascript:void(0)"></a>
        </div>
    </div>
</div>
<!--E 案例-->
<!--S 关于我们-->
<div class="main_about">
    <div class="w1200">
        <div class="abt_l">
            <div class="common_index_title">
                <a href="javascript:;" class="t">
			        <div class="en">
			         ABOUT US
			        </div> 关于我们
			    </a>
            </div>
            <div class="p1">
                <p>xxx网络公司始终以“精诚服务客户”作为公司发展主要核心，细分客户需求，为客户量身定制各种网络业务需求。</p>
            </div>
            <div class="box_item clearfix">
                <div class="item_l">
                    <div class="y">
                        <i class="num">2017</i>年
                    </div>
                    <div class="s">
                        成立于2017年6月
                    </div>
                </div>
                <div class="item_r">
                    <div class="y">
                        <i class="num">120</i>
                        <span class="jia">+</span>家
                    </div>
                    <div class="s">
                        已经服务超过50家企业
                    </div>
                </div>
            </div>
            <div class="box_item clearfix">
                <div class="item_l">
                    <div class="y">
                        <i class="num">10</i>
                        <span class="jia">+</span>项
                    </div>
                    <div class="s">
                        获得10项以上荣誉
                    </div>
                </div>
                <div class="item_r">
                    <div class="y">
                        <i class="num">97</i>%
                    </div>
                    <div class="s">
                        以上的客户满意度
                    </div>
                </div>
            </div>
        </div>
        <div class="abt_r">
            <div class="pr">
                <img src="/static/modules/cms/images/about.jpg" alt="" class="w100">
                <div class="box">
                    <div class="t">
                        Our slogan
                    </div>
                    <div class="p">
                        用心致力服务，联手创造未来!
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--E 关于我们-->
<!--S 新闻-->
<div class="main_new">
    <div class="w1200">
        <div class="m_til">
            <h5><em class="enfont">News information<i></i></em></h5>
            <span>新闻动态</span>
        </div>
        <ul class="news_list">
            <?php $cache = 3600;$cacheID = to_guid_string(array('module'=>'cms','action'=>'lists','catid'=>'6','cache'=>'3600','order'=>'listorder DESC','num'=>'3','return'=>'data','page'=>'0',));if($cache && $_return = Cache::get($cacheID)):$data = $_return;else: $cmsTagLib =  \think\Container::get("\\app\\cms\\taglib\\CmsTagLib");if(method_exists($cmsTagLib, "lists")):$data = $cmsTagLib->lists(array('module'=>'cms','action'=>'lists','catid'=>'6','cache'=>'3600','order'=>'listorder DESC','num'=>'3','return'=>'data','page'=>'0',));if($cache):Cache::set($cacheID, $data, $cache);endif;endif;endif; if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <div class="_date">
                    <span class="_d1"><?php echo htmlentities(date("Y",!is_numeric($vo['updatetime'])? strtotime($vo['updatetime']) : $vo['updatetime'])); ?></span>
                    <span class="_d2"><?php echo htmlentities(date("m-d",!is_numeric($vo['updatetime'])? strtotime($vo['updatetime']) : $vo['updatetime'])); ?></span>
                </div>
                <div class="_nr">
                    <a href="<?php echo htmlentities($vo['url']); ?>" title="<?php echo htmlentities($vo['title']); ?>">
						<h3 class="_title"><?php echo htmlentities($vo['title']); ?></h3>
						<div class="_sum"><?php echo htmlentities(str_cut($vo['description'],100)); ?></div>
						<span class="_more">+查看更多</span>
					</a>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            
        </ul>
    </div>
</div>
<!--E 新闻-->
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