<?php /*a:2:{s:70:"/www/wwwroot/lingzweb/public/../templates/default/member/register.html";i:1628763206;s:67:"/www/wwwroot/lingzweb/public/../templates/default/member/layui.html";i:1628763206;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>会员注册</title>
    <link rel="stylesheet" type="text/css" href="/static/libs/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/modules/member/css/style.css" />
    <script src="/static/libs/layui/layui.js"></script>
    <script src="/static/libs/jquery/jquery.min.js"></script>
</head>

<body>
    <div id="mydiv">
        <div class="login-main">
            <div class="layui-elip">会员注册</div>
            <form class="layui-form" action="<?php echo url('register'); ?>">
                <?php echo token(); ?>
                <?php echo hook('register_input'); ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item">
                        <input type="text" name="mobile" lay-verify="phone|required" autocomplete="off" placeholder="手机号" class="layui-input">
                    </div>
                </div>
                <?php if($Member_config['register_mobile_verify'] == '1'): ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline" style="width: 60%;">
                        <input type="text" name="captcha_mobile" required="" lay-verify="required" autocomplete="off" value="" class="layui-input" placeholder="手机验证码"> </div>
                    <button class="layui-btn btn-captcha layui-btn-primary layui-border-green" type="button" data-event="register" data-type="mobile" data-url="<?php echo url('api/sms/send'); ?>">获取验证码</button>
                </div>
                <?php endif; ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item">
                        <input type="text" name="username" lay-verify="required" autocomplete="off" placeholder="账号" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item">
                        <input type="text" name="email" lay-verify="email|required" autocomplete="off" placeholder="邮箱" class="layui-input">
                    </div>
                </div>
                <?php if($Member_config['register_email_verify'] == '1'): ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline" style="width: 60%;">
                        <input type="text" name="captcha_email" required="" lay-verify="required" autocomplete="off" value="" class="layui-input" placeholder="邮箱验证码"> </div>
                    <button class="layui-btn btn-captcha layui-btn-primary layui-border-green" type="button" data-event="register" data-type="email" data-url="<?php echo url('api/ems/send'); ?>">获取验证码</button>
                </div>
                <?php endif; ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item">
                        <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="密码" class="layui-input">
                    </div>
                </div>
                <?php if($Member_config['password_confirm'] == '1'): ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item">
                        <input type="password" name="password_confirm" lay-verify="required" autocomplete="off" placeholder="密码确认" class="layui-input">
                    </div>
                </div>
                <?php endif; if($Member_config['remove_nickname'] == '0'): ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item">
                        <input type="text" name="nickname" lay-verify="required" autocomplete="off" placeholder="昵称" class="layui-input">
                    </div>
                </div>
                <?php endif; ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item verify-box">
                        <input type="text" name="verify" lay-verify="required" placeholder="验证码" autocomplete="off" class="layui-input">
                        <img id="verify" src="<?php echo captcha_src(); ?>" alt="验证码" class="captcha">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-inline login-btn">
                        <button class="layui-btn" lay-submit>注册</button>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-trans layui-form-item layadmin-user-login-other">
                        <a href="<?php echo url('login'); ?>" class="layadmin-user-jump-change layadmin-link layui-hide-xs">用已有帐号登入</a>
                        <a href="<?php echo url('login'); ?>" class="layadmin-user-jump-change layadmin-link layui-hide-sm layui-show-xs-inline-block">登入</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
layui.config({
    version: '155714399886',
    base: '/static/libs/layui_exts/'
}).extend({
    fly: '../../modules/member/mods/index',
    yzn: 'yzn/yzn',
    yznForm: 'yznForm/yznForm',
    notice: 'notice/notice.min',
    tableSelect: 'tableSelect/tableSelect',
    dragsort: 'dragsort/dragsort.min',
    clipboard: 'clipboard/clipboard',
    xmSelect: 'xmSelect/xm-select',
    selectPage: 'selectPage/selectpage.min',
    tagsinput: 'tagsinput/tagsinput',
    webuploader: 'webuploader/webuploader',
    ueditor: 'ueditor/ueditor.min',
}).use('fly');
</script>
    <script type="text/javascript">
    layui.use(['form', 'layer','yznForm'], function() {
        var form = layui.form,
            layer = layui.layer,
            yznForm = layui.yznForm;

            yznForm.listen('', function (res) {
                layer.msg(res.msg, {
                    offset: '15px',
                    icon: 1,
                    time: 1000
                }, function() {
                    window.location.href = res.url;
                });
                return false;
            }, function (res) {
                //刷新验证码
                $("#verify").click();
                //layer.msg(res.msg, { icon: 5 });
            });
    });
    //刷新验证码
    $("#verify").click(function() {
        var verifyimg = $("#verify").attr("src");
        $("#verify").attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
    });
    </script>
</body>

</html>