<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-base', TEMPLATE_INCLUDEPATH)) : (include template('common/header-base', TEMPLATE_INCLUDEPATH));?>
<body>
<?php  $frames = buildframes(FRAME);_calc_current_frames($frames);?>

    <div class="wrapper">
	    <?php  if(!defined('IN_MESSAGE')) { ?>
	    <div class="sidebar" data-active-color="rose" data-background-color="black" data-image="../web/themes/we8apps_S/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
	
            <div class="logo">
                <a href="javascript:volid(0);" class="simple-text logo-mini">
                    HL
                </a>
                <a href="javascript:volid(0);" class="simple-text logo-normal">
                    微信协作云端
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="../web/themes/we8apps_S/picture/avatar.jpg" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>
                                请在右侧选择功能
                               
                            </span>
                        </a>
                        <div class="clearfix"></div>
                        
                    </div>
                </div>
                
            </div>
        </div>
		
		
		<!--复制1-->
		
		<?php  if(in_array(FRAME, array('account', 'system', 'adviertisement', 'wxapp', 'site')) && !in_array($_GPC['a'], array('news-show', 'notice-show'))) { ?>
		<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="../web/themes/we8apps_S/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
	
            <div class="logo">
                <a href="javascript:volid(0);" class="simple-text logo-mini">
                    HL
                </a>
                <a href="javascript:volid(0);" class="simple-text logo-normal">
                    微信协作云端
                </a>
            </div>
			<?php  if(empty($frames['section']['platform_module_menu']['plugin_menu'])) { ?>
            <div class="sidebar-wrapper scrollbox">
			    <?php  if(!empty($_GPC['m']) && !in_array($_GPC['m'], array('keyword', 'special', 'welcome', 'default', 'userapi', 'service')) || defined('IN_MODULE')) { ?>
                <div class="user">
                    <div class="photo">
					    <?php  if(file_exists(IA_ROOT. "/addons/". $_W['current_module']['name']. "/icon-custom.jpg")) { ?>
						<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon-custom.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
					    <?php  } else { ?>
						<img src="<?php  echo tomedia("addons/".$_W['current_module']['name']."/icon.jpg")?>" class="head-app-logo" onerror="this.src='./resource/images/gw-wx.gif'">
					    <?php  } ?>
						<span class="name"><?php  echo $_W['current_module']['title'];?></span>
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="<?php  echo url('home/welcome/account')?>" class="collapsed">
                            <span>
                                 <?php  echo $_W['account']['name'];?>
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
					<?php  if(CRUMBS_NAV == 1) { ?>
					<?php  global $module;?>
					<?php  } ?>
							<!-- end -->
			    <?php  } else if(FRAME == 'account') { ?>
				
						<!-- 复制2 -->
		
		
                <div class="user">
                    <div class="photo">
                        <img src="<?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?>" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>
                                <?php  echo $_W['account']['name'];?>
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                        <div class="collapse" id="collapseExample">
                            <ul class="nav">
                                <li>
                                    <a href="<?php  echo url('utility/emulator');?>" target="_blank">
                                        <span class="sidebar-mini"> 接口 </span>
                                        <span class="sidebar-normal"> 接口测试 </span>
                                    </a>
                                </li>
								<?php  if(uni_permission($_W['uid'], $_W['uniacid']) != ACCOUNT_MANAGE_NAME_OPERATOR) { ?>
                                <li>
                                    <a href="<?php  echo url('account/post', array('uniacid' => $_W['account']['uniacid'], 'acid' => $_W['acid']))?>">
                                        <span class="sidebar-mini"> 配置 </span>
                                        <span class="sidebar-normal"> 公众号配置 </span>
                                    </a>
                                </li>
								<?php  } ?>
                                <li>
                                    <a href="<?php  echo url('account/display')?>">
                                        <span class="sidebar-mini"> 切换 </span>
                                        <span class="sidebar-normal"> 切换公众号 </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
						<div class="text-center">
							<?php  if($_W['account']['level'] == 1 || $_W['account']['level'] == 3) { ?>
								<span class="label label-primary">订阅号</span><?php  if($_W['account']['level'] == 3) { ?><span class="label label-primary">已认证</span><?php  } ?>
							<?php  } ?>
							<?php  if($_W['account']['level'] == 2 || $_W['account']['level'] == 4) { ?>
								<span class="label label-primary">服务号</span> <?php  if($_W['account']['level'] == 4) { ?><span class="label label-primary">已认证</span><?php  } ?>
							<?php  } ?>
							<?php  if($_W['uniaccount']['isconnect'] == 0) { ?>
								<span class="label label-danger" data-toggle="popover">未接入</span>
								<script>
									$(function(){
										var url = "<?php  echo url('account/post', array('uniacid' => $_W['account']['uniacid'], 'acid' => $_W['acid']));?>";
										$('[data-toggle="popover"]').popover({
											trigger: 'manual',
											html: true,
											placement: 'bottom',
											content: '<i class="wi wi-warning-sign" style="color:red";></i><span style="color:#F8A13B";>未接入微信公众号</span>' +
													'<a href="' +
													url +
													'" style="color:red">立即接入</a>'
										}).on("mouseenter", function() {
											var _this = this;
											$(this).popover("show");
											$(this).siblings(".popover").on("mouseleave", function() {
												$(_this).popover('hide');
											});
										}).on("mouseleave", function() {
											var _this = this;
											setTimeout(function() {
												if(!$(".popover:hover").length) {
													$(_this).popover("hide")
												}
											}, 100);
										});
									});
								</script>
							<?php  } ?>
					    </div>
						
                    </div>
                </div>
			    <?php  } ?>
				
				<?php  if(FRAME == 'wxapp') { ?>
				<!--  -->
				
				<div class="user">
                    <div class="photo">
                        <img src="<?php  echo tomedia('headimg_'.$_W['account']['acid'].'.jpg')?>?time=<?php  echo time()?>" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#xcx" class="collapsed">
                            <span>
                                 <?php  echo $wxapp_info['name'];?>
                                <b class="caret"></b>
                            </span>
                        </a>
						<a data-toggle="collapse" class="collapsed">
                        <?php  echo $version_info['version'];?>
                       
                        </a>
                        <div class="clearfix"></div>
                        <div class="collapse" id="xcx">
                            <ul class="nav">
                                <li>
                                    <a href="<?php  echo url('wxapp/version/display', array('uniacid' => $version_info['uniacid']))?>">
                                        <span class="sidebar-mini"> 版本 </span>
                                        <span class="sidebar-normal"> 切换版本 </span>
                                    </a>
                                </li>
								<?php  if(in_array($role, array(ACCOUNT_MANAGE_NAME_OWNER, ACCOUNT_MANAGE_NAME_MANAGER)) || $_W['isfounder']) { ?>
                                <li>
                                    <a href="<?php  echo url('wxapp/manage/display', array('uniacid' => $version_info['uniacid']))?>">
                                        <span class="sidebar-mini"> 管理 </span>
                                        <span class="sidebar-normal"> 管理小程序 </span>
                                    </a>
                                </li>
								<?php  } ?>
                                <li>
                                    <a href="<?php  echo url('wxapp/display')?>">
                                        <span class="sidebar-mini"> 切换 </span>
                                        <span class="sidebar-normal"> 切换小程序 </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
				<?php  } ?>
				
				<?php  if(is_array($frames['section'])) { foreach($frames['section'] as $frame_section_id => $frame_section) { ?>
	            <?php  if(!isset($frame_section['is_display']) || !empty($frame_section['is_display'])) { ?>
				
				<ul class="nav">
                    <li >
					    <?php  if($frame_section['title']) { ?>
                        <a data-toggle="collapse"  href="#componentsExamples" data-target="#frame-<?php  echo $frame_section_id;?>" onClick="util.cookie.set('menu_fold_tag:<?php  echo $frame_section_id;?>', util.cookie.get('menu_fold_tag:<?php  echo $frame_section_id;?>') == 1 ? 0 : 1)">
                            <i class="material-icons">image</i>
                            <p> <?php  echo $frame_section['title'];?>
                                <b class="caret"></b>
                            </p>
                        </a>
						<?php  } ?>
                        <div class="collapse <?php  if($_GPC['menu_fold_tag:'.$frame_section_id]  ==  0) { ?>in<?php  } ?>" id="frame-<?php  echo $frame_section_id;?>">
                            <ul class="nav">
								<?php  if(is_array($frame_section['menu'])) { foreach($frame_section['menu'] as $menu_id => $menu) { ?>
								<?php  if(!empty($menu['is_display'])) { ?>
								<?php  if($menu_id == 'platform_module_more') { ?>
                                <li>
                                    <a href="<?php  echo $menu['url']?>" target="_blank">
                                        <span class="sidebar-mini"> More </span>
                                        <span class="sidebar-normal"> 更多应用 </span>
                                    </a>
                                </li>
								<?php  } else { ?>
                                <li>
                                    <a href="<?php  echo $menu['url'];?>" class="text-over" <?php  if($frame_section_id == 'platform_module') { ?>target="_blank"<?php  } ?>> 
                                    
									<?php  if($menu['icon']) { ?>
									    <?php  if($frame_section_id == 'platform_module') { ?>
										<img src="<?php  echo $menu['icon'];?>" onerror='this.src="../web/themes/we8apps_S/img/app_nopic.png"' style="width:20%;float:left;"/>
										<?php  } else { ?>
										<i class="<?php  echo $menu['icon'];?>" style="width:10%;float:left;line-height:2.5em;margin-right:0;"></i>
										<?php  } ?>
									<?php  } ?>	
                                        
                                        <span class="sidebar-normal" style="display: block;float: left;width: 70%;line-height: 3em;margin-left: 1em;"> <?php  echo $menu['title'];?> </span>

									
                                    </a>
                                </li>
								<?php  } ?>
								<?php  } ?>
								<?php  } } ?>
                                
                            </ul>
                        </div>
                    </li>
                    
                </ul>
				<?php  } ?>
	            <?php  } } ?>
				
				
				
				
            </div>
			<?php  } else { ?>
			<div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="picture/avatar.jpg" />
                    </div>
                    <div class="info">
                        <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>
                                公众平台 
                                <b class="caret"></b>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="list-group-item<?php  if($_W['current_module']['name'] == $frames['section']['platform_module_menu']['plugin_menu']['main_module']) { ?> active<?php  } ?>">
                        <a href="<?php  echo url('home/welcome/ext', array('m' => $frames['section']['platform_module_menu']['plugin_menu']['main_module']))?>">
                            <i class="material-icons"></i>
                            <p> 主应用 </p>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="collapse" href="#pagesExamples">
                            <i class="material-icons">image</i>
                            <p> 插件
                                <b class="caret"></b>
                            </p>
                        </a>
                        
                    </li>
					<?php  if(is_array($frames['section']['platform_module_menu']['plugin_menu']['menu'])) { foreach($frames['section']['platform_module_menu']['plugin_menu']['menu'] as $plugin_name => $plugin) { ?>
					
                    <li class="list-group-item<?php  if($_W['current_module']['name'] == $plugin_name) { ?> active<?php  } ?>">
                        <a href="<?php  echo url('home/welcome/ext', array('m' => $plugin_name))?>">
                            <img src="<?php  echo $plugin['icon'];?>" alt="" class="img-icon" />
                            <p> <?php  echo $plugin['title'];?>
                                <b class="caret"></b>
                            </p>
                        </a>
                    </li>
					<?php  } } ?>
                    
                </ul>
				<?php  unset($plugin_name);?>
				<?php  unset($plugin);?>
			
				<?php  if(is_array($frames['section'])) { foreach($frames['section'] as $frame_section_id => $frame_section) { ?>
				<?php  if(!isset($frame_section['is_display']) || !empty($frame_section['is_display'])) { ?>
				<ul class="nav">
                   
                    <li >
					    <?php  if($frame_section['title']) { ?>
                        <a data-toggle="collapse"  href="#frame0-<?php  echo $frame_section_id;?>" ata-target="#frame0-<?php  echo $frame_section_id;?>" aria-expanded="true" aria-controls="frame0-<?php  echo $frame_section_id;?>">
                            <i class="material-icons">image</i>
                            <p> <?php  echo $frame_section['title'];?>
                                <b class="caret"></b>
                            </p>
                        </a>
						<?php  } ?>
                        <div class="collapse <?php  if($_GPC['menu_fold_tag:'.$frame_section_id]  ==  0) { ?>in<?php  } ?>" id="frame-<?php  echo $frame_section_id;?>">
                            <ul class="nav">
							    <?php  if(is_array($frame_section['menu'])) { foreach($frame_section['menu'] as $menu_id => $menu) { ?>
								<?php  if(!empty($menu['is_display'])) { ?>
								<?php  if($menu_id == 'platform_module_more') { ?>
                                <li>
                                    <a href="<?php  echo $menu['url']?>" target="_blank">
                                        <span class="sidebar-mini"> More </span>
                                        <span class="sidebar-normal"> 更多应用 </span>
                                    </a>
                                </li>
								<?php  } else { ?>
                                <li>
                                    <a href="<?php  echo $menu['url'];?>" class="text-over" <?php  if($frame_section_id == 'platform_module') { ?>target="_blank"<?php  } ?>>
                                        <span class="sidebar-mini"> RS </span>
                                        <span class="sidebar-normal"> 
										<?php  if($menu['icon']) { ?>
											<?php  if($frame_section_id == 'platform_module') { ?>
											<img src="<?php  echo $menu['icon'];?>"/>
											<?php  } else { ?>
											<i class="<?php  echo $menu['icon'];?>"></i>
											<?php  } ?>
										<?php  } ?>
										<?php  echo $menu['title'];?>
										</span>
                                    </a>
                                </li>
                                <?php  } ?>
								<?php  } ?>
								<?php  } } ?>
                            </ul>
                        </div>
                    </li>
                    
                </ul>
				<?php  } ?>
		        <?php  } } ?>	
            </div>
			<?php  } ?> 		
        </div>
		<?php  } ?>	   
	    <?php  } ?>	


		
		
		
                

        
		<!-- 复制---END -->
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                            <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="javascript:volid(0);"> 公众平台 </a>
                    </div>
                    <div class="collapse navbar-collapse">
					    <?php  if(!empty($_W['uid'])) { ?>
                        <ul class="nav navbar-nav navbar-right">
							<?php  global $top_nav?>
							<?php  if(is_array($top_nav)) { foreach($top_nav as $nav) { ?> 
							
							<li>
                                <a href="<?php  if(empty($nav['url'])) { ?><?php  echo url('home/welcome/' . $nav['name']);?><?php  } else { ?><?php  echo $nav['url'];?><?php  } ?>" <?php  if(!empty($nav['blank'])) { ?>target="_blank"<?php  } ?>>
                                   
                                    <?php  echo $nav['title'];?>
                                </a>
                            </li>
							<?php  } } ?>
							
							<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header-notice', TEMPLATE_INCLUDEPATH)) : (include template('common/header-notice', TEMPLATE_INCLUDEPATH));?>
							
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                    
                                    <span >
                                        <?php  echo $_W['user']['username'];?>
                                        <b class="caret"></b>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    
                                    <li>
                                        <a href="<?php  echo url('user/profile');?>" target="_blank">我的帐号</a>
                                    </li>
									<?php  if($_W['isfounder']) { ?>
									<?php  if(uni_user_see_more_info(ACCOUNT_MANAGE_NAME_VICE_FOUNDER, false)) { ?>
                                    <li>
                                        <a href="<?php  echo url('cloud/upgrade');?>" target="_blank">检查更新</a>
                                    </li>
									<?php  } ?>
									<?php  } ?>									
                                    <li>
                                        <a href="<?php  echo url('system/updatecache');?>" target="_blank">清除缓存</a>
                                    </li>
            						<?php  if(!empty($_W['setting']['copyright']['qq'])) { ?>
                                    <li>
                                        <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php  echo $_W['setting']['copyright']['qq'];?>&site=qq&menu=yes" class="text-danger">联系客服</a>
                                    </li>
                                    <?php  } ?>
									<li>
                                        <a href="<?php  echo url('user/logout');?>" class="text-danger">退出帐号</a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
						<?php  } else { ?>
						<ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">More</i>
                                    
                                    <p class="hidden-lg hidden-md">
                                        More
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    
                                    <li>
                                        <a  href="<?php  echo url('user/register');?>" target="_blank">注册</a>
                                    </li>
                                    
									<li>
                                        <a href="<?php  echo url('user/login');?>" target="_blank">登录</a>
                                    </li>
                                </ul>
                            </li>
                            
                            <li class="separator hidden-lg hidden-md"></li>
                        </ul>
						<?php  } ?>
						
						
						
                        
                    </div>
                </div>
            </nav>
            <div class="content">
                  <div class="container-fluid">
                   <?php  if($_COOKIE['private_app_notice']) { ?>
						<div class="system-tips we7-body-alert">
							<div class="container text-right">
								<span class="alert-info">
									<a href="javascript:;">
										<?php  echo $_COOKIE['private_app_notice'];?>
									</a>
									<span class="tips-close" onClick="check_setmeal_hide();" ><i class="wi wi-error-sign"></i></span>
								</span>
							</div>
						</div>
						<?php  setcookie('private_app_notice', '', -1);?>
						<?php  } ?>
						<!--end  系统提示-->
						<?php  if(empty($_COOKIE['check_setmeal']) && !empty($_W['account']['endtime']) && ($_W['account']['endtime'] - TIMESTAMP < (6*86400))) { ?>
						<div class="system-tips we7-body-alert" id="setmeal-tips">
							<div class="container text-right">
								<div class="alert-info">
									<a href="<?php  if($_W['isfounder']) { ?><?php  echo url('user/edit', array('uid' => $_W['account']['uid']));?><?php  } else { ?>javascript:void(0);<?php  } ?>">
										您的服务有效期限：<?php  echo date('Y-m-d', $_W['account']['starttime']);?> ~ <?php  echo date('Y-m-d', $_W['account']['endtime']);?>.
										<?php  if($_W['account']['endtime'] < TIMESTAMP) { ?>
										目前已到期，请联系管理员续费
										<?php  } else { ?>
										将在<?php  echo floor(($_W['account']['endtime'] - strtotime(date('Y-m-d')))/86400);?>天后到期，请及时付费
										<?php  } ?>
									</a>
									<span class="tips-close" onClick="check_setmeal_hide();"><i class="wi wi-error-sign"></i></span>
								</div>
							</div>
						</div>
						<script>
							function check_setmeal_hide() {
								util.cookie.set('check_setmeal', 1, 1800);
								$('#setmeal-tips').hide();
								return false;
							}
						</script>
						<?php  } ?>
               