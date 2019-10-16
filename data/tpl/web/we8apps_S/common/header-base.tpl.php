<?php defined('IN_IA') or exit('Access Denied');?><!doctype html>
<html lang="zh-cn">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php  if(isset($title)) $_W['page']['title'] = $title?><?php  if(!empty($_W['page']['title'])) { ?><?php  echo $_W['page']['title'];?><?php  } ?><?php  if(empty($_W['page']['copyright']['sitename'])) { ?><?php  if(IMS_FAMILY != 'x') { ?><?php  if(!empty($_W['page']['title'])) { ?> - <?php  } ?><?php  } ?><?php  } else { ?><?php  if(!empty($_W['page']['title'])) { ?> - <?php  } ?><?php  echo $_W['page']['copyright']['sitename'];?><?php  } ?></title>
	<meta name="keywords" content="<?php  if(empty($_W['page']['copyright']['keywords'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>公众平台运维系统<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['keywords'];?><?php  } ?>" />
	<meta name="description" content="<?php  if(empty($_W['page']['copyright']['description'])) { ?><?php  if(IMS_FAMILY != 'x') { ?>公众平台运维系统，是一款基于公众平台营销的全能型运维系统。<?php  } ?><?php  } else { ?><?php  echo $_W['page']['copyright']['description'];?><?php  } ?>" />
	<link rel="shortcut icon" href="<?php  if(!empty($_W['setting']['copyright']['icon'])) { ?><?php  echo $_W['attachurl'];?><?php  echo $_W['setting']['copyright']['icon'];?><?php  } else { ?>./resource/images/favicon.ico<?php  } ?>" />
    <!-- Bootstrap core CSS     -->
    <link href="../web/themes/we8apps_S/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="../web/themes/we8apps_S/css/material-dashboard.css?v=2018012603" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../web/themes/we8apps_S/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="../web/themes/we8apps_S/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<!-- 	    <link href="../web/themes/we8apps_S/css/3a636a6d66e7464c94ec79220689e90e.css" rel="stylesheet"> -->

	
	<link href="./resource/css/common.css?v=20180115" rel="stylesheet">
	<link href="../web/themes/we8apps_S/css/style.css?v=2018012603" rel="stylesheet">	
	
	
	
	
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
		'family': '<?php echo IMS_FAMILY;?>',
		'siteroot': '<?php  echo $_W['siteroot'];?>',
		'siteurl': '<?php  echo $_W['siteurl'];?>',
		'attachurl': '<?php  echo $_W['attachurl'];?>',
		'attachurl_local': '<?php  echo $_W['attachurl_local'];?>',
		'attachurl_remote': '<?php  echo $_W['attachurl_remote'];?>',
		'module' : {'url' : '<?php  if(defined('MODULE_URL')) { ?><?php echo MODULE_URL;?><?php  } ?>', 'name' : '<?php  if(defined('IN_MODULE')) { ?><?php echo IN_MODULE;?><?php  } ?>'},
		'cookie' : {'pre': '<?php  echo $_W['config']['cookie']['pre'];?>'},
		'account' : <?php  echo json_encode($_W['account'])?>,
		'server' : {'php' : '<?php  echo phpversion()?>'},
	};
	</script>
	
	


	
	
	
	
	
	
	

	
	<script>var require = { urlArgs: 'v=20180115' };</script>
	<script type="text/javascript" src="./themes/we8apps_S/js/jquery-3.2.1.js"></script>
	
	
	
	<!--<script type="text/javascript" src="./themes/we8apps_S/js/bootstrap.js"></script>-->
	<script type="text/javascript" src="./themes/we8apps_S/js/material.min.js"></script>
	<script type="text/javascript" src="./themes/we8apps_S/js/perfect-scrollbar.jquery.min.js"></script>
    
	<script type="text/javascript" src="./themes/we8apps_S/js/material-dashboard.js"></script>
	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script type="text/javascript" src="./themes/we8apps_S/js/demo.js"></script>

	
	
	<script type="text/javascript" src="./resource/js/lib/bootstrap.min.js"></script>
	<script type="text/javascript" src="./resource/js/app/util.js?v=20180115"></script>
	<script type="text/javascript" src="./resource/js/app/common.min.js?v=20180115"></script>
	
	<script type="text/javascript" src="./resource/js/require.js?v=20180115"></script>
	
	
	
	

	
	
	
	
	
	
</head>

