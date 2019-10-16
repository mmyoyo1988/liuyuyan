<?php defined('IN_IA') or exit('Access Denied');?><div class="subnav-scene">

	<?php  if(empty($sysmenus['submenu']['route']) && !$sysmenus['submenu']['main']) { ?>

		<?php  echo $sysmenus['submenu']['subtitle'];?>

	<?php  } else { ?>

		<a href="<?php  echo webUrl($sysmenus['submenu']['route'])?>"><?php  echo $sysmenus['submenu']['subtitle'];?></a>

	<?php  } ?>

</div>



<?php  if(!empty($sysmenus['submenu']['items'])) { ?>

	<?php  if(is_array($sysmenus['submenu']['items'])) { foreach($sysmenus['submenu']['items'] as $submenu) { ?>

		<?php  if(!empty($submenu['items'])) { ?>

			<?php  if($submenu['title'] == '消息推送') { ?>

				<div class="menu-header  <?php  if(empty($notice_redis_click['notice_redis_click']) || !isset($notice_redis_click['notice_redis_click'])) { ?>point<?php  } ?> <?php  if($submenu['active']) { ?>active data-active<?php  } ?>"><div class="menu-icon fa fa-caret-<?php  if($submenu['active']) { ?>down<?php  } else { ?>right<?php  } ?>"></div><?php  echo $submenu['title'];?></div>

			<?php  } else if($submenu['title'] == '工具') { ?>

				<div class="menu-header  <?php  if(empty($wxpaycert_view_click['wxpaycert_view_click']) || !isset($wxpaycert_view_click['wxpaycert_view_click'])) { ?>point<?php  } ?> <?php  if($submenu['active']) { ?>active data-active<?php  } ?>"><div class="menu-icon fa fa-caret-<?php  if($submenu['active']) { ?>down<?php  } else { ?>right<?php  } ?>"></div><?php  echo $submenu['title'];?></div>

			<?php  } else { ?>

				<div class='menu-header <?php  if($submenu['active']) { ?>active data-active<?php  } ?>'><div class="menu-icon fa fa-caret-<?php  if($submenu['active']) { ?>down<?php  } else { ?>right<?php  } ?>"></div><?php  echo $submenu['title'];?></div>

			<?php  } ?>

			<ul <?php  if($submenu['active']) { ?>style="display: block"<?php  } ?>>

				<?php  if(is_array($submenu['items'])) { foreach($submenu['items'] as $threemenu) { ?>

					<?php  if($threemenu['route'] == 'sysset.notice_redis') { ?>

						<li class="threemenu <?php  if(empty($notice_redis_click['notice_redis_click']) || !isset($notice_redis_click['notice_redis_click'])) { ?>point<?php  } ?> <?php  if($threemenu['active']) { ?>active <?php  } ?>" ><a href="<?php  echo $threemenu['url'];?>"  style="cursor: pointer;" data-route="<?php  echo $threemenu['route'];?>"><?php  echo $threemenu['title'];?></a>

					<?php  } else if($threemenu['route'] == 'sysset.wxpaycert') { ?>

						<li class="threemenu <?php  if(empty($wxpaycert_view_click['wxpaycert_view_click']) || !isset($wxpaycert_view_click['wxpaycert_view_click'])) { ?>point<?php  } ?> <?php  if($threemenu['active']) { ?>active <?php  } ?>" ><a href="<?php  echo $threemenu['url'];?>"  style="cursor: pointer;" data-route="<?php  echo $threemenu['route'];?>"><?php  echo $threemenu['title'];?></a>

					<?php  } else { ?>

						<li <?php  if($threemenu['active']) { ?>class="active"<?php  } ?>><a href="<?php  echo $threemenu['url'];?>" style="cursor: pointer;" data-route="<?php  echo $threemenu['route'];?>"><?php  echo $threemenu['title'];?></a>

					<?php  } ?>



				<?php  } } ?>

			</ul>

		<?php  } else { ?>

			<ul class="single">

				<li <?php  if($submenu['active']) { ?>class="active"<?php  } ?> style=" position: relative"><a href="<?php  echo $submenu['url'];?>" style="cursor: pointer;" data-route="<?php  echo $submenu['route'];?>"><?php  echo $submenu['title'];?></a></li>

			</ul>

		<?php  } ?>

	<?php  } } ?>

<?php  } ?>