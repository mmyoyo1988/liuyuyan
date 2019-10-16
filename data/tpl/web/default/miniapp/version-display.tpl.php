<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
	<style>
		.account-rank img{width:20px; height:20px;}
		.alert{color:#666;padding:10px}
		.text-strong{font-size:14px;font-weight:bold;}
		.popover{max-width: 450px}
		.popover-content{padding-top: 0;line-height: 30px}
		.popover-content h5{padding-bottom: 5px}
	</style>
	<ol class="breadcrumb we7-breadcrumb">
		<li><a href="javascript:;" onclick="history.go(-1)"><i class="wi wi-back-circle"></i><?php  echo $_W['account']['name'];?></a></li>
		<li>版本列表</li>
	</ol>
	<div class="panel panel-cut">
		<div class="panel-body">
			<div class="user-head-info">
				<img src="<?php  echo $_W['account']['logo'];?>" class="account-img we7-margin-right-sm" alt="">
				<div class="info">
					<h3 class="title"><?php  echo $_W['account']['name'];?></h3>
					<i class="wi wi-<?php  echo $_W['account']['type_sign'];?>"></i><?php  echo $_W['account']->typeName?>
				</div>
				<?php  if($_W['account']['type_sign'] == 'phoneapp') { ?>
				<a href="<?php  echo url('phoneapp/manage/create_display', array('uniacid' => $_W['uniacid']))?>" class="btn btn-primary">新建版本</a>
				<?php  } else { ?>
				<a href="<?php  echo url('miniapp/post', array('uniacid' => $_W['uniacid'], 'type' => ACCOUNT_TYPE))?>" class="btn btn-primary">新建版本</a>
				<?php  } ?>
			</div>
			<ul class="wxapp-cut-list">
				<?php  if(is_array($version_list)) { foreach($version_list as $key => $list) { ?>
				<li class="wxapp-cut-item">
					<?php  if($_W['account']['type_sign'] == 'phoneapp') { ?>
					<a href="<?php  echo url('phoneapp/version/home', array('uniacid' => $_W['uniacid'], 'version_id' => $list['id']))?>" class="box">
					<?php  } else { ?>
					<a href="<?php  echo url('miniapp/version/home', array('version_id' => $list['id']))?>" class="box">
					<?php  } ?>
						<div class="left">
							<div class="version <?php  if($_W['account']['type_sign'] == 'wxapp' && $key == 0 && !empty($list['upload_time'])) { ?>new<?php  } ?>"><?php  echo $list['version'];?></div>
							<div class="desc"><?php  echo $list['description'];?></div>
							<div class="info">
								<img src="<?php  echo $list['module']['logo'];?>" class="module-img" alt="">
								<div class="">
									<div class="app-title"><?php  echo $list['module']['title'];?></div>
									<div class="support-list app-version">版本： <?php  echo $list['module']['version'];?></div>
								</div>
							</div>
						</div>
						<div class="right">
							<i class="wi wi-angle-right"></i>
						</div>
					</a>
				</li>
				<?php  } } ?>
			</ul>
		</div>
	</div>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>