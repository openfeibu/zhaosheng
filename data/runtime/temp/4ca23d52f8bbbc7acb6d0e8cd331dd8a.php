<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\UPUPW_K2.1_64\htdocs\zhaosheng/app/admin\view\login\login.html";i:1491417085;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>用户登录</title>
	<meta name="description" content="User login page" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
	<link rel="Bookmark" href="__ROOT__/favicon.ico" >
    <link rel="Shortcut Icon" href="__ROOT__/favicon.ico" />
	<!-- bootstrap & fontawesome必须的css -->
	<link rel="stylesheet" href="__PUBLIC__/ace/css/bootstrap.min.css" />
	<link rel="stylesheet" href="__PUBLIC__/font-awesome/css/font-awesome.min.css" />
	<!-- ACE样式-->
	<link rel="stylesheet" href="__PUBLIC__/ace/css/ace.min.css" />
	<!--[if lte IE 9]>
	<link rel="stylesheet" href="__PUBLIC__/ace/css/ace-part2.min.css" />
	<![endif]-->

	<!--[if lte IE 9]>
	<link rel="stylesheet" href="__PUBLIC__/ace/css/ace-ie.css" />
	<![endif]-->
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="__PUBLIC__/others/html5shiv.min.js"></script>
	<script src="__PUBLIC__/others/respond.min.js"></script>
	<![endif]-->
</head>
<body class="login-layout blur-login">
<div class="main-container">
	<div class="main-content">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="login-container">
					<div class="center">
						<h1>
							<i class="ace-icon fa fa-leaf green"></i>
							<span class="red">自主招生</span>
							<span  class="blue" style="font-family:microsoft yahei" id="id-text2">网站后台管理</span>
						</h1>
					</div>

					<div class="space-6"></div>

					<div class="position-relative">
						<div id="login-box" class="login-box visible widget-box no-border">
							<div class="widget-body">
								<div class="widget-main">
									<h4 class="header blue lighter bigger text-center">
										<i class="ace-icon fa fa-coffee green"></i>
										后台登录
									</h4>

									<div class="space-6"></div>
									<form class="ajaxForm3" name="runlogin" id="runlogin" method="post" action="<?php echo url('admin/Login/runlogin'); ?>">
										<fieldset>
											<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="admin_username" id="admin_username" placeholder="用户名" required/>
															<i class="ace-icon fa fa-user"></i>
														</span>
											</label>

											<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control" name="admin_pwd" id="admin_pwd" placeholder="输入密码" required/>
															<i class="ace-icon fa fa-lock"></i>
														</span>
											</label>
											<?php if(config('geetest.geetest_on')): ?>
											<div id="captcha"></div>
											<div class="space-6"></div>
											<?php else: ?>
											<label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="text" class="form-control" name="verify" id="verify" placeholder="输入验证码" required/>
													<i class="ace-icon fa fa-sort-alpha-asc"></i>
												</span>
											</label>
											<label class="block clearfix">
												<span class="block text-center">
													<img class="verify_img" id="verify_img" src="<?php echo url('admin/Login/verify'); ?>" onClick="this.src='<?php echo url('admin/Login/verify'); ?>'+'?'+Math.random()" style="cursor: pointer;width:100%;border: 1px solid #d5d5d5;" title="点击获取">
												</span>
											</label>
											<?php endif; ?>

											<div class="clearfix">
												<label class="inline">
													<input name="rememberme" type="checkbox" class="ace" />
													<span class="lbl"> 记住信息</span>
												</label>

												<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
													<i class="ace-icon fa fa-key"></i>
													<span class="bigger-110">登录</span>
												</button>
											</div>

											<div class="space-4"></div>
										</fieldset>
									</form>
								</div><!-- /.widget-main -->
							</div><!-- /.widget-body -->
						</div><!-- /.login-box -->
					</div><!-- /.position-relative -->

				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.main-content -->
</div><!-- /.main-container -->

<!-- 基本的js -->
<!--[if !IE]> -->
<script src="__PUBLIC__/others/jquery.min-2.2.1.js"></script>
<!-- <![endif]-->
<!-- 如果为IE,则引入jq1.12.1 -->
<!--[if IE]>
<script src="__PUBLIC__/others/jquery.min-1.12.1.js"></script>
<![endif]-->
<!-- jquery.form、layer、yfcmf的js -->
<script src="__PUBLIC__/others/bootstrap.min.js"></script>
<script src="__PUBLIC__/others/jquery.form.js"></script>
<script src="__PUBLIC__/layer/layer_zh-cn.js"></script>
<script src="__PUBLIC__/others/maxlength.js"></script>
<script src="__PUBLIC__/yfcmf/yfcmf.js"></script>
<script src="http://static.geetest.com/static/tools/gt.js"></script>
<script>
    var handler = function (captchaObj) {
        captchaObj.appendTo("#captcha");
        captchaObj.onSuccess(function () {
            //验证成功执行
        });
        captchaObj.onReady(function () {
            //加载完毕执行
        });
    };
    $.ajax({
        url: "<?php echo geetest_url(); ?>?t=" + (new Date()).getTime(),
        type: "get",
        dataType: "json",
        success: function (data) {
            initGeetest({
                gt: data.gt,
                challenge: data.challenge,
                product: "float",
                offline: !data.success
            }, handler);
        }
    });
</script>
<!-- 如果为触屏,则引入jquery.mobile -->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='__PUBLIC__/others/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
</body>
</html>
