<?php defined('IN_IA') or exit('Access Denied');?>﻿<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php  if(isset($title)) $_W['page']['title'] = $title?><?php  if(!empty($_W['page']['title'])) { ?><?php  echo $_W['page']['title'];?><?php  } ?><?php  if(empty($_W['page']['copyright']['sitename'])) { ?><?php  if(IMS_FAMILY != 'x') { ?><?php  if(!empty($_W['page']['title'])) { ?> - <?php  } ?>维吧活动运维系统 -  Powered by WE8<?php  } ?><?php  } else { ?><?php  if(!empty($_W['page']['title'])) { ?> - <?php  } ?><?php  echo $_W['page']['copyright']['sitename'];?><?php  } ?></title>
	<meta name="keywords" content="<?php  if(empty($_W['page']['copyright']['keywords'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>公众平台运维系统<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['keywords'];?><?php  } ?>" />
	<meta name="description" content="<?php  if(empty($_W['page']['copyright']['description'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>公众平台运维系统，是一款基于公众平台营销的全能型运维系统。<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['description'];?><?php  } ?>" />
	<link rel="shortcut icon" href="<?php  if(!empty($_W['setting']['copyright']['icon'])) { ?><?php  echo $_W['attachurl'];?><?php  echo $_W['setting']['copyright']['icon'];?><?php  } else { ?>./resource/images/favicon.ico<?php  } ?>" />
    <!-- Bootstrap core CSS     -->
    <link href="../web/themes/we8apps_S/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="../web/themes/we8apps_S/css/material-dashboard.css" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../web/themes/we8apps_S/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="../web/themes/we8apps_S/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<!-- 	    <link href="../web/themes/we8apps_S/css/3a636a6d66e7464c94ec79220689e90e.css" rel="stylesheet"> -->
	
<!-- 	<link href="./resource/css/common.css?v=20170802" rel="stylesheet"> -->
	<script type="text/javascript">
	if(navigator.appName == 'Microsoft Internet Explorer'){
		if(navigator.userAgent.indexOf("MSIE 5.0")>0 || navigator.userAgent.indexOf("MSIE 6.0")>0 || navigator.userAgent.indexOf("MSIE 7.0")>0) {
			alert('您使用的 IE 浏览器版本过低, 推荐使用 Chrome 浏览器或 IE8 及以上版本浏览器.');
		}
	}
	window.sysinfo = {
		<?php  if(!empty($_W['uniacid'])) { ?>'uniacid': '<?php  echo $_W['uniacid'];?>',<?php  } ?>
		<?php  if(!empty($_W['acid'])) { ?>'acid': '<?php  echo $_W['acid'];?>',<?php  } ?>
		<?php  if(!empty($_W['openid'])) { ?>'openid': '<?php  echo $_W['openid'];?>',<?php  } ?>
		<?php  if(!empty($_W['uid'])) { ?>'uid': '<?php  echo $_W['uid'];?>',<?php  } ?>
		'isfounder': <?php  if(!empty($_W['isfounder'])) { ?>1<?php  } else { ?>0<?php  } ?>,
		'siteroot': '<?php  echo $_W['siteroot'];?>',
		'siteurl': '<?php  echo $_W['siteurl'];?>',
		'attachurl': '<?php  echo $_W['attachurl'];?>',
		'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
		'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
		'module' : {'url' : '<?php  if(defined('MODULE_URL')) { ?><?php echo MODULE_URL;?><?php  } ?>', 'name' : '<?php  if(defined('IN_MODULE')) { ?><?php echo IN_MODULE;?><?php  } ?>'},
		'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
		'account' : <?php  echo json_encode($_W['account'])?>,
	};
	</script>
	
	


	
	
	
	
	
	
	

	
 	<script>var require = { urlArgs: 'v=20170802' };</script>
	<script type="text/javascript" src="./themes/we8apps_S/js/jquery-3.2.1.js"></script>
	
	
	
	<!--<script type="text/javascript" src="./themes/we8apps_S/js/bootstrap.js"></script>-->
	<script type="text/javascript" src="./themes/we8apps_S/js/material.min.js"></script>
	<script type="text/javascript" src="./themes/we8apps_S/js/perfect-scrollbar.jquery.min.js"></script>
    
	<script type="text/javascript" src="./themes/we8apps_S/js/material-dashboard.js"></script>
	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script type="text/javascript" src="./themes/we8apps_S/js/demo.js"></script>

	
	
	<script type="text/javascript" src="./resource/js/lib/bootstrap.min.js"></script>
	<script type="text/javascript" src="./resource/js/app/util.js?v=20170802"></script>
	<script type="text/javascript" src="./resource/js/app/common.min.js?v=20170802"></script>
	
	<script type="text/javascript" src="./resource/js/require.js?v=20170802"></script> 
	
	
	
	

	
	
	
	
	
	
</head>
<body class="off-canvas-sidebar">
    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand" href="javascript:volid(0);">公众平台</a> -->
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    
                    <!-- <li class="">
                    <?php  if(!$_W['siteclose'] && $setting['register']['open']) { ?>
						<?php  if(empty($_GPC['login_type']) || $_GPC['login_type'] == 'system') { ?>
						 <a href="<?php  echo url('user/register');?>">
                            <i class="material-icons">person_add</i>立即注册
                        </a>
						<?php  } ?>
						<?php  if($_GPC['login_type'] == 'mobile') { ?>
                       	<a href="<?php  echo url('user/register', array('register_type' => 'mobile'))?>">
                            <i class="material-icons">person_add</i>立即注册
                        </a>
						<?php  } ?>
					<?php  } ?>
                    </li>
                    <li class="">
                        <a href="<?php  echo url('user/login');?>">
                            <i class="material-icons">fingerprint</i> 管理登录
                        </a>
                    </li> -->
                    
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" filter-color="black" data-image="./themes/we8apps_S/img/login.jpeg">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                            <form action="" method="post" role="form" id="form1" onSubmit="return formcheck();" class="we7-form">
                                <div class="card card-login card-hidden">
                                    <div class="card-header text-center" data-background-color="rose">
                                        <h4 class="card-title">登录云管理系统</h4>
                                        <div class="social-line">
                                            <a href="#btn" class="btn btn-just-icon btn-simple">
                                                <i class="fa fa-html5"></i>
                                            </a>
                                            <a href="#pablo" class="btn btn-just-icon btn-simple">
                                                <i class="fa fa-cloud"></i>
                                            </a>
                                            <a href="#eugen" class="btn btn-just-icon btn-simple">
                                                <i class="fa fa-google-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- <p class="category text-center">
                                        请妥善保管好您的帐号密码
                                    </p> -->
                                    <div class="card-content" style="margin-top:30px">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">face</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">请输入用户名登录</label>
                                                <input name="username" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="input-group" style="margin-top:15px">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">请输入登录密码</label>
                                                <input name="password" type="password" class="form-control password">
                                            </div>
                                        </div>
										<?php  if(!empty($_W['setting']['copyright']['verifycode'])) { ?>
                                        <div class="input-group" style="margin-top:15px">
                                            <span class="input-group-addon">
                                                <i class="material-icons">dashboard</i>
                                            </span>
                                            <div class="form-group label-floating">
                                                <label class="control-label">请输入验证码</label>
                                                <input name="verify" type="text" class="form-control">
												<a href="javascript:;" id="toggle" class="input-group-btn imgverify"><img id="imgverify" src="<?php  echo url('utility/code')?>" title="点击图片更换验证码" /></a>
                                            </div>
                                        </div>
										<?php  } ?>
                                    </div>
									<div class="checkbox">
										<input type="checkbox" value="true" id="rember" name="rember">
										
									</div>
                                    <div class="footer text-center">
									 
                                        <input type="submit" id="submit" name="submit" class="btn btn-primary btn-round" value="登录" ></input>
                                        <input name="token" value="<?php  echo $_W['token'];?>" type="hidden" />
									</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    
                    <p class="copyright text-center">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="javascript:volid(0);"> 佳佳科技 </a>, made with love for a better WeChat
                    </p>
                </div>
            </footer>
        </div>
    </div>
</body>
<div class="fixed-plugin">
    <div class="dropdown show-dropdown">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
        </a>
        <ul class="dropdown-menu">
            <li class="header-title">Background Style</li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger">
                    <p>Background Image</p>
                    <div class="togglebutton switch-sidebar-image">
                        <label>
                            <input type="checkbox" checked="">
                        </label>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="adjustments-line">
                <a href="javascript:void(0)" class="switch-trigger active-color">
                    <p>Filters</p>
                    <div class="badge-colors pull-right">
                        <span class="badge filter active" data-color="black"></span>
                        <span class="badge filter badge-blue" data-color="blue"></span>
                        <span class="badge filter badge-green" data-color="green"></span>
                        <span class="badge filter badge-orange" data-color="orange"></span>
                        <span class="badge filter badge-red" data-color="red"></span>
                        <span class="badge filter badge-purple" data-color="purple"></span>
                        <span class="badge filter badge-rose" data-color="rose"></span>
                    </div>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="header-title">Background Images</li>
            <li class="active">
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="./themes/we8apps_S/picture/sidebar-1.jpg" data-src="../web/themes/we8apps_S/img/login.jpeg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="./themes/we8apps_S/picture/sidebar-2.jpg" data-src="../web/themes/we8apps_S/img/lock.jpeg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="./themes/we8apps_S/picture/sidebar-3.jpg" data-src="../web/themes/we8apps_S/img/register.jpeg" alt="" />
                </a>
            </li>
            <li>
                <a class="img-holder switch-trigger" href="javascript:void(0)">
                    <img src="./themes/we8apps_S/picture/sidebar-4.jpg" data-src="../web/themes/we8apps_S/img/bg-pricing.jpeg" alt="" />
                </a>
            </li>
            <li class="button-container">
            		<?php  if(!empty($_W['setting']['copyright']['qq'])) { ?>
                    <div class="">
                        <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $_W['setting']['copyright']['qq'];?>&site=qq&menu=yes" target="_blank" class="btn btn-rose btn-block">Contact  Now</a>
                    </div>
                    <?php  } ?>
                    <div class="">
                        <a href="javascript:volid(0);" target="_blank" class="btn btn-info btn-block">Buy Now!</a>
                    </div>
            </li>
            <li class="header-title">公众平台</li>
            <li class="button-container">
               
            </li>
        </ul>
    </div>
</div>
</body>
<script>
function formcheck() {
	if($('#remember:checked').length == 1) {
		cookie.set('remember-username', $(':text[name="username"]').val());
	} else {
		cookie.del('remember-username');
	}
	return true;
}
var h = document.documentElement.clientHeight;
$(".system-login").css('height',h);
$('#toggle').click(function() {
	$('#imgverify').prop('src', '<?php  echo url('utility/code')?>r='+Math.round(new Date().getTime()));
	return false;
});
<?php  if(!empty($_W['setting']['copyright']['verifycode'])) { ?>
	$('#form1').submit(function() {
		var verify = $(':text[name="verify"]').val();
		if (verify == '') {
			alert('请填写验证码');
			return false;
		}
	});
<?php  } ?>
</script>
<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();

        setTimeout(function() {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>

</html>