<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('header', TEMPLATE_INCLUDEPATH)) : (include template('header', TEMPLATE_INCLUDEPATH));?>
<div id="js-goods-post" ng-controller="goodsPostCtrl" ng-cloak>
	<!--编辑模块-->
	<ol class="breadcrumb we7-breadcrumb">
		<a href="javascript:history.back()"><i class="wi wi-back-circle"></i> </a>
		<li><a href="javascript:history.back()">商品列表 </a></li>
		<li>编辑设置</li>
	</ol>
	<form action="" class="we7-form" method="post">
		<input type="hidden" name="type" value="<?php  echo $type;?>">
		<?php  if($type == STORE_TYPE_API) { ?>
			<table class="table we7-table table-hover table-form">
				<col width="140px"/>
				<col />
				<col width="140px"/>
				<tr>
					<th colspan="3">编辑API商品信息</th>
				</tr>
				<tr>
					<td class="table-label">API商品价格</td>
					<td><span ng-bind="goodsInfo.price"></span> 元 / <span ng-bind="goodsInfo.api_num"></span>万次</td>
					<td class="text-right">
						<div class="link-group">
							<a href="javascript:;" data-toggle="modal" data-target="#add_api">修改</a>
						</div>
					</td>
				</tr>
			</table>
			<div class="modal fade" id="add_api" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="we7-modal-dialog modal-dialog we7-form">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<div class="modal-title">编辑API商品</div>
						</div>
						<div class="modal-body">

							<div class="form-group">
								<label class="control-label col-sm-2">商品名称</label>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="text" class="form-control" value="应用访问流量(API)" readonly>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">浏览次数</label>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="text" name="api_num" ng-model="goodsInfo.api_num" class="form-control">
										<span class="input-group-addon">万次</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2">设置价格</label>
								<div class="col-sm-10">
									<div class="input-group">
										<input type="text" name="price" ng-model="goodsInfo.price" class="form-control">
										<span class="input-group-addon">元</span>
									</div>
								</div>
							</div>
                            <div class="user-group-price-content"></div>
                            <div class="form-group" ng-if="userGroups">
                                <label class="control-label col-sm-2"></label>
                                <div class="col-sm-8">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-default" style="color: #999;border-style: dashed" ng-click="addGroupPrice()">
                                            + 添加用户组价格
                                        </button>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
							<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
							<input type="submit" class="btn btn-primary" name="submit" value="保存">
						</div>
					</div>
				</div>
			</div>
		<?php  } else { ?>
			<?php  if(!in_array($type, array(STORE_TYPE_PACKAGE, STORE_TYPE_USER_PACKAGE, STORE_TYPE_ACCOUNT_PACKAGE))) { ?>
			<div class="form-group">
				<label class="control-label col-sm-2">
					<?php  if($goods_info['type'] == STORE_TYPE_MODULE) { ?>
					公众号应用
					<?php  } else if($goods_info['type'] == STORE_TYPE_WXAPP_MODULE) { ?>
					微信小程序应用
					<?php  } else { ?>
					商品名称
					<?php  } ?>
				</label>
				<div class="col-sm-3">
					<?php  if($type == STORE_TYPE_ACCOUNT) { ?>
					<select name="type" class="form-control ">
						<option value="<?php echo STORE_TYPE_ACCOUNT;?>" <?php  if($goods_info['type'] == STORE_TYPE_ACCOUNT) { ?>selected<?php  } ?>>公众号</option>
						<option value="<?php echo STORE_TYPE_WXAPP;?>" <?php  if($goods_info['type'] == STORE_TYPE_WXAPP) { ?>selected<?php  } ?>>小程序</option>
					</select>
					<?php  } else if($type == STORE_TYPE_ACCOUNT_RENEW) { ?>
					<select name="type" class="form-control">
						<option value="<?php echo STORE_TYPE_ACCOUNT_RENEW;?>" <?php  if($goods_info['type'] == STORE_TYPE_ACCOUNT_RENEW) { ?>selected<?php  } ?>>公众号续费</option>
						<option value="<?php echo STORE_TYPE_WXAPP_RENEW;?>" <?php  if($goods_info['type'] == STORE_TYPE_WXAPP_RENEW) { ?>selected<?php  } ?>>小程序续费</option>
					</select>
					<?php  } else { ?>
					<input type="text" name="title" class="form-control" ng-model="goodsInfo.title" readonly>
					<?php  } ?>
				</div>
			</div>
			<?php  } ?>
			<div class="form-group">
				<label class="control-label col-sm-2">设置价格</label>
				<div class="col-sm-8">
					<div class="input-group">
						<input type="number" class="form-control" min="0" name="price" ng-model="goodsInfo.price" step="0.01">
						<span class="input-group-addon">元 /</span>
						<div class="input-group-btn">
							<input type="hidden" name="unit" value="<?php  echo $goods_info['unit'];?>">
							<?php  if($type == STORE_TYPE_ACCOUNT_RENEW) { ?>
							<input name="account_num" class="form-control" value="<?php  echo $goods_info['account_num'];?>" ng-model="num">
							<?php  } else if($type == STORE_TYPE_WXAPP_RENEW) { ?>
							<input name="wxapp_num" class="form-control" value="<?php  echo $goods_info['wxapp_num'];?>" ng-modle="num">
							<?php  } ?>
							<?php  if(!in_array($type, array(STORE_TYPE_ACCOUNT, STORE_TYPE_WXAPP, STORE_TYPE_ACCOUNT_PACKAGE))) { ?>
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span ng-if="unit == 'day'">日</span>
								<span ng-if="unit == 'month'">月</span>
								<span ng-if="unit == 'year'">年</span>
								<span class="caret"></span>
							</button>
							<?php  } ?>
							<?php  if(!in_array($type, array(STORE_TYPE_ACCOUNT, STORE_TYPE_WXAPP, STORE_TYPE_ACCOUNT_PACKAGE))) { ?>
							<ul class="dropdown-menu dropdown-menu-right" style="min-width: 60px;">
								<li><a href="#" ng-click="changeUnit('day')">日</a></li>
								<li><a href="#" ng-click="changeUnit('month')">月</a></li>
								<li><a href="#" ng-click="changeUnit('year')">年</a></li>
							</ul>
							<?php  } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="user-group-price-content"></div>
			<?php  if($type != STORE_TYPE_USER_PACKAGE) { ?>
			<div class="form-group" ng-if="userGroups">
				<label class="control-label col-sm-2"></label>
				<div class="col-sm-8">
					<div class="input-group-btn">
					<button type="button" class="btn btn-default" style="color: #999;border-style: dashed" ng-click="addGroupPrice()">
						+ 添加用户组价格
					</button>
					</div>
				</div>
			</div>
			<?php  } ?>
			<?php  if(in_array($type, array(STORE_TYPE_MODULE, STORE_TYPE_WXAPP_MODULE))) { ?>
			<div class="form-group">
				<label class="control-label col-sm-2">幻灯片</label>
				<div class="col-sm-8">
					<div class="panel we7-panel">
						<div class="panel-body">
							<div class="batch-img">
								<div class="img-container" ng-repeat="slide in slideLists" ng-if="slideLists">
									<input type="hidden" name="slide[]" value="{{slide}}">
									<img ng-src="{{slide}}" >
									<div class="del" ng-click="delSlide($index)">删除</div>
								</div>
								<div class="img-container add" ng-click="addSlide()" ng-if="slideLists.length < 10">
									<span class="wi wi-registersite"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-2">应用详情</label>
				<div class="col-sm-8">
					<?php  echo tpl_ueditor('description', $goods_info['description']);?>
				</div>
			</div>
			<?php  } else if(in_array($type, array(STORE_TYPE_ACCOUNT, STORE_TYPE_WXAPP))) { ?>
			<div class="form-group">
				<label class="control-label col-sm-2">账号个数</label>
				<div class="col-sm-8">
					<div class="input-group">
						<?php  if($goods_info['type'] == STORE_TYPE_ACCOUNT) { ?>
						<input type="number" class="form-control" name="account_num" ng-value="goodsInfo.account_num">
						<?php  } else { ?>
						<input type="number" class="form-control" name="wxapp_num" ng-value="goodsInfo.wxapp_num">
						<?php  } ?>
						<span class="input-group-addon">个</span>
					</div>
				</div>
			</div>
			<?php  } else if($type == STORE_TYPE_PACKAGE) { ?>
			<div class="form-group">
				<label class="control-label col-sm-2">应用权限组</label>
				<div class="col-sm-8">
					<div class="input-group">
						<select class="" name="module_group">
							<?php  if(is_array($module_groups)) { foreach($module_groups as $group) { ?>
							<option value="<?php  echo $group['id'];?>" <?php  if(!empty($goods_info) && $goods_info['module_group'] == $group['id']) { ?>selected<?php  } ?>>
								<?php  echo $group['name'];?>
							</option>
							<?php  } } ?>
						</select>
					</div>
				</div>
			</div>
			<?php  } else if($type == STORE_TYPE_ACCOUNT_PACKAGE) { ?>
			<div class="form-group">
				<label class="control-label col-sm-2">账号权限组</label>
				<div class="col-sm-8">
					<div class="input-group">
						<select class="" name="account_group">
							<?php  if(is_array($account_groups)) { foreach($account_groups as $group) { ?>
							<option value="<?php  echo $group['id'];?>" <?php  if(!empty($goods_info) && $goods_info['module_group'] == $group['id']) { ?>selected<?php  } ?>>
							<?php  echo $group['group_name'];?>
							</option>
							<?php  } } ?>
						</select>
					</div>
				</div>
			</div>
			<?php  } else if($type == STORE_TYPE_USER_PACKAGE) { ?>
			<div class="form-group">
				<label class="control-label col-sm-2">用户权限组</label>
				<div class="col-sm-8">
					<div class="input-group">
						<select class="" name="user_group">
							<?php  if(is_array($user_groups)) { foreach($user_groups as $group) { ?>
								<option value="<?php  echo $group['id'];?>" <?php  if(!empty($goods_info) && $goods_info['user_group'] == $group['id']) { ?>selected<?php  } ?>>
									<?php  echo $group['name'];?>
								</option>
							<?php  } } ?>
						</select>
					</div>
				</div>
			</div>
			<?php  } ?>
			<div class="form-group">
				<label class="control-label col-sm-2"></label>
				<div class="col-sm-8">
					<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
					<input type="submit" class="btn btn-primary" name="submit" value="仅保存">
					<input type="submit" class="btn btn-primary" name="submit" value="保存并上架">
				</div>
			</div>
		<?php  } ?>
	</form>
</div>
<script>
	angular.module('storeApp').value('config', {
		'goodsInfo': <?php echo !empty($goods_info) ? json_encode($goods_info) : 'null'?>,
		'userGroups': <?php echo !empty($user_groups) ? json_encode($user_groups) : 'null'?>,
	});
	angular.bootstrap($('#js-goods-post'), ['storeApp']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>