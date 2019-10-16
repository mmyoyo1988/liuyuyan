<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<script language='javascript' src="../addons/ewei_shopv2/plugin/exhelper/static/js/designer.js"></script>

<style type='text/css'>
#container {border: 1px solid #ccc;position: relative; background: #fff; overflow: hidden;}
.items label {width: 120px; margin: 0; float: left;}
#container .bg {position: absolute; width: 100%; z-index: 0;}
#container .drag {position: absolute; min-width: 120px; min-height: 25px; border: 1px solid #aaa; z-index: 1; top: 10px; left: 100px; background: #fff; cursor: move;}
#container .rRightDown, .rLeftDown, .rLeftUp, .rRightUp, .rRight, .rLeft, .rUp, .rDown { position: absolute; width: 7px; height: 7px; z-index: 1; font-size: 0;}
.rRightDown, .rLeftDown, .rLeftUp, .rRightUp, .rRight, .rLeft, .rUp, .rDown {position: absolute; background: #428bca; width: 6px; height: 6px; z-index: 5; font-size: 0;}
.rLeftDown, .rRightUp {cursor: ne-resize;}
.rRightDown, .rLeftUp {cursor: nw-resize;}
.rRight, .rLeft {cursor: e-resize;}
.rUp, .rDown {cursor: n-resize;}
.rRightDown {bottom: -3px; right: -3px; background: #2a6496;} 
.rLeftDown {bottom: -3px; left: -3px;}
.rRightUp {top: -3px; right: -3px;}
.rLeftUp {top: -3px; left: -3px;}
.rRight {right: -3px; top: 50%; margin-top: -3px;}
.rLeft {left: -3px; top: 50%; margin-top: -3px;}
.rUp {top: -3px; left: 50%;} 
.rDown {bottom: -3px; left: 50%}
.context-menu-layer {z-index: 9999;}
.context-menu-list {z-index: 9999;}
.items .checkbox-inline, .col-xs-12 .checkbox-inline {margin: 0; float: left; width: 100px;}  
.edit-left {min-height: 592px; width: 420px; float: left; }
.edit-right {min-height: 570px; width: auto; margin-left: 440px;}
</style>


<form class="form-horizontal form-validate" action=""  id="dataform" method="post" onsubmit='return save()'>
	<div class="page-header">
		当前位置：<span class="text-primary"><?php  if(empty($item)) { ?>添加<?php  } else { ?>编辑<?php  } ?>快递单模板 <?php  if(!empty($item['expressname'])) { ?>(<?php  echo $item['expressname'];?>)<?php  } ?></span>
	</div>

	<div class="page-content">
		<div class="page-sub-toolbar">
			<span class=''>
				<a class='btn btn-default  btn-sm' href="<?php  echo webUrl('exhelper/temp/express')?>">返回列表</a>
				<input type="submit" class='btn btn-primary  btn-sm' value="保存模板" />
			</span>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">快递单名称</span>
					<input type="text" class="form-control valid" value="<?php  echo $item['expressname'];?>" name="expressname" data-rule-required='true'>
					<span class="input-group-addon" style="border-left: 0; border-right: 0;">快递公司</span>
					<select class="form-control valid" name="express" id="express">
						<?php  if(is_array($express_list)) { foreach($express_list as $express) { ?>
							<option value="<?php  echo $express['express'];?>" <?php  if($item['express']==$express['express']) { ?> selected=""<?php  } ?>><?php  echo $express['name'];?></option>
						<?php  } } ?>
						<option value="">其他快递</option>
					</select>
					<span class="input-group-addon" style="border-left: 0;">是否默认</span>
					<span class="input-group-addon">
						<label style="margin-top:-7px;" class="radio-inline"><input type="radio" value="1" name="isdefault" class="valid" <?php  if(empty($item) || $item['isdefault']==1) { ?> checked="checked"<?php  } ?>> 是</label>
						<label style="margin-top:-7px;" class="radio-inline"><input type="radio" value="0" name="isdefault" class="valid" <?php  if($item['isdefault']==0) { ?> checked="checked"<?php  } ?>> 否</label>
					</span>
					<input type="hidden" name="datas" id="datas" value="" />
					<input type="hidden" name="expresscom" id="expresscom" value="" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon">参照底图</span>
					<input type="text" class="form-control valid" value="<?php  echo $item['bg'];?>" name="bg" aria-invalid="false" placeholder="请直接填入图片链接或者右侧选择">
					<span class="input-group-addon btn btn-default" style="border-left: 0; border-right: 0;" id="addbg">选择图片</span>
					<span class="input-group-addon btn btn-default" id="clearbg">清除图片</span>
					<span class="input-group-addon" style="border-left: 0;">编辑区高度</span>
					<input type="number" class="form-control valid" value="<?php  if(empty($item['height'])) { ?>130<?php  } else { ?><?php  echo $item['height'];?><?php  } ?>" name="height" aria-invalid="false" onchange="pagesize()">
					<span class="input-group-addon">毫米</span>
				</div>
			</div>
		</div>

		<div style="height: <?php  if(!empty($item['height'])) { ?><?php  echo $item['height'];?><?php  } else { ?>130<?php  } ?>mm; width: 100%; border: 1px solid #e5e6e7;"  id="container">
			<img id="bgimg" src="<?php  echo $item['bg'];?> " <?php  if(empty($item['bg'])) { ?> style="display: none;"<?php  } ?> />
			<?php  if(is_array($elements)) { foreach($elements as $k => $d) { ?>
				<div class="drag" cate="<?php  echo $d['cate'];?>" index="<?php  echo $k;?>" items="<?php  echo $d['items'];?>" item-string="<?php  echo $d['string'];?>" item-font="<?php  echo $d['font'];?>"
					item-size="<?php  echo $d['size'];?>" item-color="<?php  echo $d['color'];?>" item-bold="<?php  echo $d['bold'];?>" item-pre="<?php  echo $d['pre'];?>" item-last="<?php  echo $d['last'];?>" item-align="<?php  echo $d['align'];?>"
					style="font-size:<?php  echo $d['size'];?>pt; z-index:<?php  echo $k;?>;left:<?php  echo $d['left'];?>;top:<?php  echo $d['top'];?>;width:<?php  echo $d['width'];?>;height:<?php  echo $d['height'];?>; text-align:<?php  if($d['align']=='' || $d['align']==1) { ?>left<?php  } else if($d['align']==2) { ?>center<?php  } else if($d['align']==3) { ?>right<?php  } ?>" item-virtual="<?php  echo $d['virtual'];?>" cate="$d['cate']">

					<?php  if($d['cate']==1) { ?>
						<div class="text" style="<?php  if(!empty($d['font'])) { ?>font-family: <?php  echo $d['font'];?>;<?php  } ?> font-size:<?php  if(!empty($d['size'])) { ?><?php  echo $d['size'];?><?php  } else { ?>10<?php  } ?>pt;<?php  if(!empty($d['color'])) { ?>color: <?php  echo $d['color'];?>;<?php  } ?><?php  if(!empty($d['bold'])) { ?>font-weight:bold;<?php  } ?>">
							<?php  echo $d['pre'];?><?php  echo $d['string'];?><?php  echo $d['last'];?>
						</div>
					<?php  } else if($d['cate']==2) { ?>
						<div class="text-table" style="padding: 10px; <?php  if(!empty($d['font'])) { ?>font-family: <?php  echo $d['font'];?>;<?php  } ?> font-size:<?php  if(!empty($d['size'])) { ?><?php  echo $d['size'];?><?php  } else { ?>10<?php  } ?>pt; <?php  if(!empty($d['color'])) { ?>color: <?php  echo $d['color'];?>;<?php  } ?>">
							<?php 
								$items = explode(',',$d['items']);
								$strings = explode(',',$d['string']);
								$virtuals = explode(',',$d['virtual']);
								$stringsnum = count($strings);
							?>
							<table border="1" style="width:100%">
								<tr style="font-weight: bold;">
									<?php  if(is_array($strings)) { foreach($strings as $i => $s) { ?>
										<td><?php  echo $s;?></td>
									<?php  } } ?>
								</tr>
								<?php 
									for ($x=1; $x<5; $x++) {
								?>
									<tr>
										<?php  if(is_array($virtuals)) { foreach($virtuals as $i => $v) { ?>
											<td>
												<?php  if($v!=='') { ?>
													<?php  if($v=='number') { ?>
														<?php  echo $x;?>
													<?php  } else { ?>
														<?php  echo $v;?><?php  echo $i;?>
													<?php  } ?>
												<?php  } else { ?>
													<?php  echo $v;?>
												<?php  } ?>
											</td>
										<?php  } } ?>
									</tr>
								<?php  } ?>
								<tr>
									<?php  if(is_array($items)) { foreach($items as $i => $s) { ?>
										<td>
											<?php  if($s=="total") { ?>总计:11<?php  } ?>
											<?php  if($s=="productprice") { ?>总计:11<?php  } ?>
											<?php  if($s=="marketprice") { ?>总计:11<?php  } ?>
											<?php  if($s=="realprice") { ?>总计:11<?php  } ?>
											<?php  if($s=="allprice") { ?>总计:11<?php  } ?>
										</td>
									<?php  } } ?>
								</tr>
								<tr>
									<td colspan="<?php  echo $stringsnum;?>">提示: 以上表格数据为虚拟数据，打印时将替换为订单数据且打印时此行不会出现。</td>
								</tr>
							</table>
						</div>
					<?php  } ?>

					<div class="rRightDown"> </div><div class="rLeftDown"> </div><div class="rRightUp"> </div><div class="rLeftUp"> </div>
					<div class="rRight"></div><div class="rLeft"></div><div class="rUp"></div><div class="rDown"></div>
				</div>
			<?php  } } ?>
		</div>

		<div class="panel panel-default" style="margin-top: 15px;">
			<div class="panel-heading" style="position: relative;"><i class="fa fa-edit"></i> 元素编辑器
				<span class="pull-right" style="position: absolute; top: 5px; right: 5px; width: auto; height: auto; overflow: hidden;">
					<a href="javascript:;" onclick="delInput()" class="btn btn-default  btn-sm deleteinput" style="display: none;"><i class="fa fa-trash"></i> 删除内容框</a>
					<a href="javascript:;" onclick="addInput()" class="btn btn-default  btn-sm"><i class="fa fa-plus"></i> 普通内容框</a>
				</span>
			</div>
			<div class="panel-body">
				<!------------------->
				<style>.items .checkbox-inline, .col-xs-12 .checkbox-inline {width: 120px}</style>
				<style>.checkbox-inline {width: auto;}</style>
				<p class="item-tip">请先选中您要编辑的内容框</p>
					<div class="items" style="display: none;">
						<div class="form-group cate1" style="margin-bottom: 15px; height: auto; overflow: hidden;">
							<label class="col-sm-2 control-label">发件人信息</label>
							<div class="col-sm-10 col-xs-12">
								<label class="checkbox-inline"><input type="checkbox" value="sendername" title="发件人"> 发件人</label>
								<label class="checkbox-inline"><input type="checkbox" value="sendertel" title="发件人电话"> 发件人电话</label>
								<label class="checkbox-inline"><input type="checkbox" value="senderaddress" title="发件地址"> 发件地址</label>
								<label class="checkbox-inline"><input type="checkbox" value="sendersign" title="发件人签名"> 发件人签名</label>
								<label class="checkbox-inline"><input type="checkbox" value="sendercode" title="发件邮编"> 发件邮编</label>
								<label class="checkbox-inline"><input type="checkbox" value="sendertime" title="发件日期"> 发件日期</label>
								<label class="checkbox-inline"><input type="checkbox" value="sendinfo" title="商品明细"> 商品明细</label>
								<label class="checkbox-inline"><input type="checkbox" value="shopname" title="商城名称"> 商城名称</label>
								<label class="checkbox-inline"><input type="checkbox" value="sendercccc" title="发件城市"> 发件城市</label>
							</div>
						</div>

						<div class="form-group cate1" style="margin-bottom: 15px; height: auto; overflow: hidden;">
							<label class="col-sm-2 control-label">收件人信息</label>
							<div class="col-sm-10 col-xs-12">
								<label class="checkbox-inline"><input type="checkbox" value="realname" title="收件人"> 收件人</label>
								<label class="checkbox-inline"><input type="checkbox" value="mobile" title="收件人电话"> 收件人电话</label>
								<label class="checkbox-inline"><input type="checkbox" value="province" title="收件省份"> 收件省份</label>
								<label class="checkbox-inline"><input type="checkbox" value="city" title="收件人城市"> 收件人城市</label>
								<label class="checkbox-inline"><input type="checkbox" value="area" title="收件人区域"> 收件人区域</label>
								<label class="checkbox-inline"><input type="checkbox" value="street" title="收件人街道"> 收件人街道<br>(需要开启街道)</label>
								<label class="checkbox-inline"><input type="checkbox" value="address" title="收件人地址"> 收件人详细地址</label>
								<label class="checkbox-inline"><input type="checkbox" value="nickname" title="买家昵称"> 买家昵称</label>
								<label class="checkbox-inline"><input type="checkbox" value="expremark1" title="买家备注"> 买家备注</label>
								<label class="checkbox-inline"><input type="checkbox" value="expremark2" title="卖家备注"> 卖家备注</label>
							</div>
						</div>


								<div class="input-group" style="margin-bottom: 15px;">
									<div class="input-group-addon">字体</div>
									<select class="form-control" id="item-font">
										<option value="微软雅黑">微软雅黑</option>
										<option value="黑体">黑体</option>
										<option value="宋体">宋体</option>
										<option value="新宋体">新宋体</option>
										<option value="幼圆">幼圆</option>
										<option value="华文细黑">华文细黑</option>
										<option value="隶书">隶书</option>
										<option value="Arial">Arial</option>
										<option value="Arial Narrow">Arial Narrow</option>
									</select>

									<div class="input-group-addon">字号</div>
									<select class="form-control" id="item-size">
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
										<option value="24">24</option>
									</select>
									<div class="input-group-addon">对齐</div>
									<select class="form-control" id="item-align">
										<option value="1">居左</option>
										<option value="2">居中</option>
										<option value="3">居右</option>
									</select>
									<div class="input-group-addon">加粗</div>
									<select class="form-control" id="item-bold">
										<option value="">不加粗</option>
										<option value="bold">加粗</option>
									</select>
								</div>

								<script type="text/javascript">
										require(["jquery", "util"], function($, util) {
											$(function() {
												$(".colorpicker").each(function() {
													var elm = this;
													util.colorpicker(elm, function(color) {
														$(elm).parent().prev().prev().val(color.toHexString());
														$(elm).parent().prev().css("background-color", color.toHexString());
													});
												});
												$(".colorclean").click(function() {
													$(this).parent().prev().prev().val("");
													$(this).parent().prev().css("background-color", "#FFF");
												});
											});
										});
								</script>

								<div class="input-group" id="item-color">
									<div class="input-group-addon">前文字</div>
									<input type="text" id="item-pre" class="form-control">
									<div class="input-group-addon">后文字</div>
									<input type="text" id="item-last" class="form-control">
									<div class="input-group-addon">文字颜色</div>
									<input type="text" value="" placeholder="填写html颜色代码或右侧选择颜色" name="color" class="form-control">
									<span style="width:35px;border-left:none;background-color:" class="input-group-addon"></span>
									<span class="input-group-btn">
										<button type="button" class="btn btn-default colorpicker">选择颜色 <i class="fa fa-caret-down"></i></button>
										<button type="button" class="btn btn-default colorclean"><span><i class="fa fa-remove"></i></span></button>
									</span>
								</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</form>

	<script language='javascript'>
		$(function(){
			$("#addbg").click(function(){
				require(['jquery', 'util'], function($, util){
                    util.image('',function(data){
                        $("input[name=bg]").val(data.url);
                        $("#bgimg").attr("src",data.url).show();
                    });
				});
			});
			$("#clearbg").click(function(){
				$("input[name=bg]").val("");
				$("#bgimg").attr("src","").hide();
			});
		});
	
		function pagesize(){
			 	var _height = $("input[name=height]").val();
			 	$("#container").height(_height+"mm");
		}
		function delInput(){
			var _index = currentDrag.attr("index");
			$(".drag").each(function(){
				var index = $(this).attr("index");
				if(index==_index){
					$(this).remove();
					$('.items').hide();
					$(".item-tip").show();
					$(".deleteinput").hide(); 
				}
			});
			
		} 
		function addInput(n) {
			var index = $('#container .drag').length + 1;
			if(n==1){
				var data = '<div class="drag" cate="2" style="width: auto; height: auto; padding: 10px;" index="' + index + '" style="z-index:' + index + '" fields="" item-size="12" item-font="微软雅黑" item-align="1">';
					  data+='<div class="text-table">';
					  data+='请在左侧先选择列';
					  data+='</div>';
					  data+='<div class="rRightDown"> </div><div class="rLeftDown"> </div><div class="rRightUp"> </div><div class="rLeftUp"> </div><div class="rRight"> </div><div class="rLeft"> </div><div class="rUp"> </div><div class="rDown"></div>';
					  data+='</div>';
				var drag = $(data)
			}else{
				var drag = $('<div class="drag" cate="1" index="' + index + '" style="z-index:' + index + '" fields="" item-size="12" item-font="微软雅黑" item-align="1"><div class="text" style="font-size:12pt"></div><div class="rRightDown"> </div><div class="rLeftDown"> </div><div class="rRightUp"> </div><div class="rLeftUp"> </div><div class="rRight"> </div><div class="rLeft"> </div><div class="rUp"> </div><div class="rDown"></div></div>');
			}
			$('#container').append(drag);
			bindEvents(drag);
			setCurrentDrag(drag);
		}
		function changeBG(n) {
			if(n){
				$("#bgimg").attr("src","").hide(); 
				$("#bg").val("");
			}else{
				util.image('', function(data) {
					$("#bgimg").attr("src",data.url).show(); 
					$("#bg").val(data.url);
				});
			}
		}
		var currentDrag = false;

		function bindEvents(obj) {
			var index = obj.attr('index');
			var rs = new Resize(obj, {
				Max: true,
				mxContainer: "#container"
			});
			rs.Set($(".rRightDown", obj), "right-down");
			rs.Set($(".rLeftDown", obj), "left-down");
			rs.Set($(".rRightUp", obj), "right-up");
			rs.Set($(".rLeftUp", obj), "left-up");
			rs.Set($(".rRight", obj), "right");
			rs.Set($(".rLeft", obj), "left");
			rs.Set($(".rUp", obj), "up");
			rs.Set($(".rDown", obj), "down");
			new Drag(obj, {
				Limit: true,
				mxContainer: "#container"
			});
			$('.drag .remove').unbind('click').click(function() {
				$(this).parent().remove();
			});
			myrequire(['jquery.contextMenu'],function(){
			$.contextMenu({
				selector: '.drag[index=' + index + ']',
				callback: function(key, options) {
					var index = $(this).attr('index');
					if (key == 'next') {
						var nextdiv = $(this).next('.drag');
						if (nextdiv.length > 0) {
							nextdiv.insertBefore($(this));
						}
					}
					else if (key == 'prev') {
						var prevdiv = $(this).prev('.drag');
						if (prevdiv.length > 0) {
							$(this).insertBefore(prevdiv);
						}
					}
					else if (key == 'last') {
						var len = $('.drag').length;
						if (index >= len - 1) {
							return;
						}
						var last = $('#container .drag:last');
						if (last.length > 0) {
							$(this).insertAfter(last);
						}
					}
					else if (key == 'first') {
						var index = $(this).index();
						if (index <= 1) {
							return;
						}
						var first = $('#container .drag:first');
						if (first.length > 0) {
							$(this).insertBefore(first);
						}
					}
					else if (key == 'delete') {
						$(this).remove();
						$('.items').hide();
						$(".item-tip").show();
						$(".deleteinput").hide();
					}
					var n = 1;
					$('.drag').each(function() {
						$(this).css("z-index", n);
						n++;
					})
				},
				items: {"next": {name: "调整到上层"},"prev": {name: "调整到下层"},"last": {name: "调整到最顶层"},"first": {name: "调整到最低层"},"delete": {name: "删除元素"}}
			});
			obj.unbind('mousedown').mousedown(function() {
				setCurrentDrag(obj);
			});
			});
		}
		var timer = 0;
		function setCurrentDrag(obj) {
			currentDrag = obj;
			var cate = obj.attr('cate');
			bindItems();
			$(".item-tip").hide();
			$('.items').show();
			$(".deleteinput").show();
			if(cate==1){
				$(".cate1").show();
				$(".cate2").hide();
			}
			if(cate==2){
				$(".cate2").show();
				$(".cate1").hide(); 
			}
			$('.drag').css('border', '1px solid #aaa');
			obj.css('border', '1px solid #428bca');
		}
		function bindItems() {
			var items = currentDrag.attr('items') || "";
			var values = items.split(',');
			$('.items').find(':checkbox').each(function() {
				$(this).get(0).checked = false;
			});
			$('#item-font').val('');
			$('#item-size').val('');
			$('#item-bold').val('');
			for (var i in values) {
				if (values[i] != '') {
					$('.items').find(":checkbox[value='" + values[i] + "']").get(0).checked = true;
				}
			}
			$('#item-font').val(currentDrag.attr('item-font') || '');
			$('#item-size').val(currentDrag.attr('item-size') || '');
			$('#item-bold').val(currentDrag.attr('item-bold') || '');
			$('#item-pre').val(currentDrag.attr('item-pre') || '');
			$('#item-last').val(currentDrag.attr('item-last') || '');
			$('#item-align').val(currentDrag.attr('item-align') || '');
			var itemcolor = $('#item-color');
			var input = itemcolor.find('input:last');
			var picker = itemcolor.find('.sp-preview-inner');
			var color = currentDrag.attr('item-color') || '#000';
			input.val(color);
			picker.css({
				'background-color': color
			});
			timer = setInterval(function() {
				var cate = currentDrag.attr("cate");
				if(cate==1){
					currentDrag.attr('item-color', input.val()).find('.text').css('color', input.val());
				}
				if(cate==2){
					currentDrag.attr('item-color', input.val()).find('.text-table').css('color', input.val());
				}
				currentDrag.attr('item-pre', $('#item-pre').val());
				currentDrag.attr('item-last', $('#item-last').val());
				var pre = currentDrag.attr('item-pre') || "";
				var last = currentDrag.attr('item-last') || "";
				var string = currentDrag.attr('item-string') || "";
				currentDrag.find('.text').html(pre + string + last);
			}, 10);
		}
		$(function() {
			//$('#dataform').ajaxForm();
			$('.drag').each(function() {
				bindEvents($(this));
			})
			
			$('.items .checkbox-inline').click(function(e) {
			    if( $(e.target).find('input').length>0){
			    	return;
			    }
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var values = [];
					var titles = [];
					var datas = [];
					var vd = [];
					$('.items').find(':checkbox:checked').each(function() {
						var _titles = $(this).attr('title');
						var _values = $(this).val();
						var _vd = $(this).data('vd');
						titles.push(_titles);
						values.push(_values);
						vd.push(_vd);
						datas.push({"value":_values,"title":_titles,"vd":_vd});
					});
					if(cate==1){
						currentDrag.attr('items', values.join(',')).attr('item-string', titles.join(',')).find('.text').text(titles.join(','));
					}
					if(cate==2){
						var _table = '';
						_table += '<table border="1" style="width:100%">';
						_table+='<tr style="font-weight:bold">';
						$.each(datas, function(i,data) {
							_table+='<td>&nbsp;'+data.title+'&nbsp;</td>';
						});
						_table+='</tr>';
						for(i=1;i<5;i++){
							_table+='<tr>';
							$.each(datas, function(ii,data) {
								if(data.vd!=''){
									if(data.vd=='number'){
										_table+='<td>'+i+'</td>'; 
									}else{
										_table+='<td>'+data.vd+i+'</td>';
									}
								}else{
									_table+='<td>'+data.vd+'</td>';
								}
							});
							_table+='</tr>';
						}
						_table += '<tr><td colspan="'+datas.length+'">提示: 以上表格数据为虚拟数据，打印时将替换为订单数据且打印时此行不会出现。</td></tr>';
						_table += '</table>';
						currentDrag.attr('items', values.join(',')).attr({'item-string': titles.join(','),'item-virtual': vd.join(',')}).find('.text-table').html(_table);
					}
				}
			});
			$('#item-font').change(function() {
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var data = $(this).val();
					currentDrag.attr('item-font', data);
					if (data == '') {
						data = "微软雅黑";
					}
					if(cate==1){
						currentDrag.attr('item-font', data).find(".text").css('font-family', data);
					}
					if(cate==2){
						currentDrag.attr('item-font', data).find(".text-table").css('font-family', data);
					}
				}
			});
			$('#item-align').change(function() {
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var data = $(this).val();
					currentDrag.attr('item-align', data);
					if (data == '') {
						data = "1";
					}
					var str = '';
					if (data == 1) {
						str = "left";
					}
					if (data == 2) {
						str = "center";
					}
					if (data == 3) {
						str = "right";
					}
					
					if(cate==1){
						currentDrag.attr('item-font', data).find(".text").css('text-align', str);
					}
					if(cate==2){
						currentDrag.attr('item-font', data).find(".text-table").css('text-align', str);
					}
				}
			});
			$('#item-size').change(function() {
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var data = $(this).val();
					currentDrag.attr('item-size', data);
					if (data == '') {
						data = 12;
					}
					if(cate==1){
						currentDrag.find(".text").css('font-size', data + "pt");
					}
					if(cate==2){
						currentDrag.find(".text-table").css('font-size', data + "pt");
					}
				}
			});
			$('#item-bold').change(function() {
				if (currentDrag) {
					var cate = currentDrag.attr("cate");
					var data = $(this).val();
					currentDrag.attr('item-bold', data);
					if(cate==1){
						if (data == 'bold') {
							currentDrag.css('font-weight', 'bold');
						} else {
							currentDrag.find(".text").css('font-weight', 'normal');
						}
					}
					if(cate==2){
						if (data == 'bold') {
							currentDrag.css('font-weight', 'bold');
						} else {
							currentDrag.find(".text-table").css('font-weight', 'normal');
						}
					}
				}
			});
		});

		function save(ispreview) {
			if ($(':input[name=expressname]').isEmpty()) {
				Tip.focus($(':input[name=expressname]'), '请填写快递单名称!');
				return;
			}
			var data = [];
			$('.drag').each(function() {
				var obj = $(this);
				var d = {
					left: obj.css('left'),
					top: obj.css('top'),
					width: obj.css('width'),
					height: obj.css('height'),
					items: obj.attr('items'),
					font: obj.attr('item-font'),
					size: obj.attr('item-size'),
					color: obj.attr('item-color'),
					bold: obj.attr('item-bold'),
					string: obj.attr('item-string'),
					pre: obj.attr('item-pre'),
					last: obj.attr('item-last'),
					align: obj.attr('item-align'),
					cate: obj.attr('cate'),
					virtual: obj.attr('item-virtual')
				};
				data.push(d);
			});
			$("#expresscom").val($("#express").find("option:selected").text());
			$('#datas').val(JSON.stringify(data));
			$('.btnsave').button('loading');
//			$('#dataform').ajaxSubmit(function(data) {
//				$('.btnsave').button('reset');
//				data = eval("(" + data + ")");
//				$(':hidden[name=id]').val(data.id);
//			})
			return;
		}

	</script> 

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>