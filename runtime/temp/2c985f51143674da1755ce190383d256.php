<?php /*a:2:{s:67:"/www/wwwroot/lingzweb/public/../templates/default/member/login.html";i:1628763206;s:67:"/www/wwwroot/lingzweb/public/../templates/default/member/layui.html";i:1628763206;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>会员登录</title>
    <link rel="stylesheet" type="text/css" href="/static/libs/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/static/modules/member/css/style.css" />
    <script src="/static/libs/layui/layui.js"></script>
    <script src="/static/libs/jquery/jquery.min.js"></script>
</head>

<body>
    <div id="mydiv">
        <div class="login-main">
            <div class="layui-elip">会员登录</div>
            <form class="layui-form" action="<?php echo url('login'); ?>">
                <input type="hidden" name="forward" value="<?php echo htmlentities($forward); ?>" />
                <?php echo token(); ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item">
                        <input type="text" name="account" lay-verify="required" autocomplete="off" placeholder="账号/手机/邮箱" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item">
                        <input type="password" name="password" lay-verify="required" autocomplete="off" placeholder="密码" class="layui-input">
                    </div>
                </div>
                <?php if($Member_config['openverification'] == '1'): ?>
                <div class="layui-form-item">
                    <div class="layui-input-inline input-item verify-box">
                        <input type="text" name="verify" lay-verify="required" placeholder="验证码" autocomplete="off" class="layui-input">
                        <img id="verify" src="<?php echo captcha_src(); ?>" alt="验证码" class="captcha">
                    </div>
                </div>
                <?php endif; ?>
                <div class="layui-form-item">
                    <input type="checkbox" name="remember" lay-skin="primary" title="记住密码">
                    <a href="<?php echo url('forget'); ?>" class="lay-user-jump-change lay-link" style="margin-top: 7px;">忘记密码？</a>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-inline login-btn">
                        <button class="layui-btn" lay-submit>登录</button>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-trans layui-form-item lay-user-login-other">
                        <?php echo hook('sync_login'); ?>
                        <a href="<?php echo url('register'); ?>" class="lay-user-jump-change lay-link">注册帐号</a>
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