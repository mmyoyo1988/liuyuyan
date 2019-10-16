<?php defined('IN_IA') or exit('Access Denied');?><div class="region-goods-details row">
	<div class="region-goods-left  col-sm-2">
		规格
	</div>
	<div class="region-goods-right  col-sm-10">
		<div id='tboption' style="padding-left:15px;" >
			<div class="alert alert-info">
				1. 拖动规格可调整规格显示顺序, 更改规格及规格项后请点击下方的【刷新规格项目表】来更新数据。<br/>
				2. 每一种规格代表不同型号，例如颜色为一种规格，尺寸为一种规格，如果设置多规格，手机用户必须每一种规格都选择一个规格项，才能添加购物车或购买。
			</div>
			<div id='specs'>
				<?php  if(empty($allspecs)) { ?>
					<div class="spec_item" id="spec_new_cycelbuy_group">
						<div style="border:1px solid #e7eaec;padding:10px;margin-bottom: 10px;">
							<input name="spec_id[]" type="hidden" class="form-control spec_id" value="new_cycelbuy_group" />
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<input name="spec_title[new_cycelbuy_group]" type="text" class="form-control spec_title" value="套餐类型" readonly style="background-color:#efefef"/>
										<div class="input-group-btn">
											<a href="javascript:;" id="add-specitem-new_cycelbuy_group" specid="new_cycelbuy_group" class="btn btn-info add-specitem" onclick="addSpecItem('new_cycelbuy_group',0)"><i class="fa fa-plus"></i> 添加规格项</a>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div id="spec_item_new_cycelbuy_group" class="spec_item_items">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="spec_item" id="spec_new_cycelbuy_periodic">
						<div style="border:1px solid #e7eaec;padding:10px;margin-bottom: 10px;">
							<input name="spec_id[]" type="hidden" class="form-control spec_id" value="new_cycelbuy_periodic" />
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<input name="spec_title[new_cycelbuy_periodic]" type="text" class="form-control spec_title" value="套餐规格" readonly style="background-color:#efefef"/>
										<div class="input-group-btn">
											<a href="javascript:;" id="add-specitem-new_cycelbuy_periodic" specid="new_cycelbuy_periodic" class="btn btn-info add-specitem" onclick="addSpecItem('new_cycelbuy_periodic',1)"><i class="fa fa-plus"></i> 添加规格项</a>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-12">
									<div id="spec_item_new_cycelbuy_periodic" class="spec_item_items">
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php  } else { ?>
					<?php  if(is_array($allspecs)) { foreach($allspecs as $spec) { ?>
							<div class='spec_item' id='spec_<?php  echo $spec['id'];?>' >
								<div style='border:1px solid #e7eaec;padding:10px;margin-bottom: 10px;' >
									<input name="spec_id[]" type="hidden" class="form-control spec_id" value="<?php  echo $spec['id'];?>"/>
									<div class="form-group">
										<div class="col-sm-12">
											<?php if( ce('goods' ,$item) ) { ?>
											<div class='input-group'>
												<input name="spec_title[<?php  echo $spec['id'];?>]" type="text" class="form-control spec_title" value="<?php  echo $spec['title'];?>"  readonly style="background-color:#efefef"/>
												<div class='input-group-btn'>
													<a href="javascript:;" id="add-specitem-<?php  echo $spec['id'];?>" specid='<?php  echo $spec['id'];?>' class='btn btn-info add-specitem' onclick="addSpecItem('<?php  echo $spec['id'];?>',<?php  echo $spec['iscycelbuy'];?>)"><i class="fa fa-plus"></i> 添加规格项</a>
												</div>
											</div>
											<?php  } else { ?>
											<div class='form-control-static'><?php  echo $spec['title'];?></div>
											<?php  } ?>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-12">
											<div id='spec_item_<?php  echo $spec['id'];?>' class='spec_item_items'>
											<?php  if(is_array($spec['items'])) { foreach($spec['items'] as $specitem) { ?>
												<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('cycelbuy/goods/tpl/spec_item', TEMPLATE_INCLUDEPATH)) : (include template('cycelbuy/goods/tpl/spec_item', TEMPLATE_INCLUDEPATH));?>
											<?php  } } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php  } } ?>
				<?php  } ?>
			</div>
			<?php if( ce('goods' ,$item) ) { ?>
			<table class="table">
				<tr>
					<td>
						<h4>
							<a href="javascript:;" onclick="refreshOptions();" title="刷新规格项目表" class="btn btn-primary"><i class="fa fa-refresh"></i> 刷新规格项目表</a></h4>
					</td>
				</tr>
				<tr style="display: none;" id="optiontip">
					<td>
						<div class="alert alert-danger">警告：规格数据有变动，请重新点击上方 [刷新规格项目表] 按钮！</div>
					</td>
				</tr>
			</table>
			<?php  } ?>
		<div id="options" style="padding:0;"><?php  echo $html;?></div>
	</div>

	</div>
</div>
<input type="hidden" name="optionArray" value=''>
<input type="hidden" name="isdiscountDiscountsArray" value=''>
<input type="hidden" name="discountArray" value=''>
<input type="hidden" name="commissionArray" value=''>
<script language="javascript">
	$(function(){
		$(document).on('input propertychange change', '#specs input', function () {
			// 改变规格锁定提交
			window.optionchanged = true;
			$('#optiontip').show();
		});


		$(".spec_item_thumb").find('i').click(function(){
			var group  =$(this).parent();
			group.find('img').attr('src',"<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg");
			group.find(':hidden').val('');
			$(this).hide();
			group.find('img').popover('destroy');
		});

			require(['jquery.ui'],function(){
//			$('#specs').sortable({
//				stop: function(){
//					refreshOptions();
//				}
//			});
			$('.spec_item_items').sortable(
			{
						handle:'.fa-arrows',
						stop: function(){
							refreshOptions();
						}
					}
			);
	    });
	});
	function selectSpecItemImage(obj){
		util.image('',function(val){
			$(obj).attr('src',val.url).popover({
				trigger: 'hover',
				html: true,
				container: $(document.body),
				content: "<img src='" + val.url  + "' style='width:100px;height:100px;' />",
				placement: 'top'
			});

			var group  =$(obj).parent();

			group.find(':hidden').val(val.attachment), group.find('i').show().unbind('click').click(function(){
				$(obj).attr('src',"<?php echo EWEI_SHOPV2_LOCAL;?>static/images/nopic100.jpg");
				group.find(':hidden').val('');
				group.find('i').hide();
				$(obj).popover('destroy');
			});
		});
	}
	function addSpec(){
                    var len = $(".spec_item").length;

                    if(type==3 && virtual==0 && len>=1){
						tip.msgbox.err('您的商品类型为：虚拟物品(卡密)的多规格形式，只能添加一种规格！');
                        return;
                    }

					if(type==4 && virtual==0 && len>=2){
						tip.msgbox.err('您的商品类型为：批发商品的多规格形式，只能添加两种规格！');
						return;
					}

					if(type==10 && len>=1){
						tip.msgbox.err('您的商品类型为：话费流量充值，只能添加一种规格！')
						return;
					}

	         $("#add-spec").html("正在处理...").attr("disabled", "true").toggleClass("btn-primary");
		var url = "<?php  echo webUrl('cycelbuy/goods/tpl',array('tpl'=>'spec'))?>";
		$.ajax({
			"url": url,
			success:function(data){
				$("#add-spec").html('<i class="fa fa-plus"></i> 添加规格').removeAttr("disabled").toggleClass("btn-primary");
				$('#specs').append(data);
				var len = $(".add-specitem").length -1;
				$(".add-specitem:eq(" +len+ ")").focus();
                                        refreshOptions();
			}
		});
	}
	function removeSpec(specid){
		if (confirm('确认要删除此规格?')){
			$("#spec_" + specid).remove();
			refreshOptions();
		}
	}
	function addSpecItem(specid,iscycelbuy){
	         $("#add-specitem-" + specid).html("正在处理...").attr("disabled", "true");
		var url = "<?php  echo webUrl('cycelbuy/goods/tpl',array('tpl'=>'specitem'))?>" + "&specid=" + specid+"&iscycelbuy="+iscycelbuy;
		$.ajax({
			"url": url,
			success:function(data){
				$("#add-specitem-" + specid).html('<i class="fa fa-plus"></i> 添加规格项').removeAttr("disabled");
				$('#spec_item_' + specid).append(data);
				var len = $("#spec_" + specid + " .spec_item_title").length -1;
				$("#spec_" + specid + " .spec_item_title:eq(" +len+ ")").focus();
				refreshOptions();
			}
		});
	}
	function removeSpecItem(obj){
		$(obj).closest('.spec_item_item').remove();
		refreshOptions();
	}

	function refreshOptions(){
		// 刷新后重置
		window.optionchanged = false;
		$('#optiontip').hide();


 var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
	var specs = [];
         if($('.spec_item').length<=0){
             $("#options").html('');
			 $("#discount").html('');
			 $("#isdiscount_discounts").html('');
			 $("#commission").html('');
			 <?php  if(p('commission') && !empty($com_set['level'])) { ?>
			 	commission_change();
			 <?php  } ?>
			 	isdiscount_change();
             return;
         }
	$(".spec_item").each(function(i){
		var _this = $(this);
		var spec = {
			id: _this.find(".spec_id").val(),
			title: _this.find(".spec_title").val()
		};

		var items = [];
		_this.find(".spec_item_item").each(function(){
			var __this = $(this);
			var item = {
				id: __this.find(".spec_item_id").val(),
				title: __this.find(".spec_item_title").val(),
                period: __this.find(".spec_item_period").val(),
                time_unit: __this.find(".spec_item_time_unit").val(),
                number: __this.find(".spec_item_number").val(),
				show:__this.find(".spec_item_show").get(0).checked?"1":"0"
			}
			items.push(item);
		});
		spec.items = items;
		specs.push(spec);
	});

	specs.sort(function(x,y){
		if (x.items.length > y.items.length){
			return 1;
		}
		if (x.items.length < y.items.length) {
			return -1;
		}
	});

	var len = specs.length;
	var newlen = 1;
	var h = new Array(len);
	var rowspans = new Array(len);
	for(var i=0;i<len;i++){
		html+="<th>" + specs[i].title + "</th>";
		var itemlen = specs[i].items.length;
		if(itemlen<=0) { itemlen = 1 };
		newlen*=itemlen;

		h[i] = new Array(newlen);
		for(var j=0;j<newlen;j++){
			h[i][j] = new Array();
		}
		var l = specs[i].items.length;
		rowspans[i] = 1;
		for(j=i+1;j<len;j++){
			rowspans[i]*= specs[j].items.length;
		}
	}

	html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">库存</div><div class="input-group"><input type="text" class="form-control  input-sm option_stock_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_stock\');"></a></span></div></div></th>';
	html += '<th class="type-4"><div class=""><div style="padding-bottom:10px;text-align:center;">现价</div><div class="input-group"><input type="text" class="form-control  input-sm option_marketprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_marketprice\');"></a></span></div></div></th>';
	html+='<th class="type-4"><div class=""><div style="padding-bottom:10px;text-align:center;">原价</div><div class="input-group"><input type="text" class="form-control  input-sm option_productprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_productprice\');"></a></span></div></div></th>';
	html+='<th class="type-4"><div class=""><div style="padding-bottom:10px;text-align:center;">成本价</div><div class="input-group"><input type="text" class="form-control  input-sm option_costprice_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_costprice\');"></a></span></div></div></th>';
	html+='<th><div class=""><div style="padding-bottom:10px;text-align:center;">编码</div><div class="input-group"><input type="text" class="form-control  input-sm option_goodssn_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_goodssn\');"></a></span></div></div></th>';
	html+='<th><div class=""><div style="padding-bottom:10px;text-align:center;">条码</div><div class="input-group"><input type="text" class="form-control  input-sm option_productsn_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_productsn\');"></a></span></div></div></th>';
	html+='<th><div class=""><div style="padding-bottom:10px;text-align:center;">重量（克）</div><div class="input-group"><input type="text" class="form-control  input-sm option_weight_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'option_weight\');"></a></span></div></div></th>';
	html+='</tr></thead>';

	for(var m=0;m<len;m++){
		var k = 0,kid = 0,n=0;
		for(var j=0;j<newlen;j++){
			var rowspan = rowspans[m];
            var title=specs[m].items[kid].title;
            var cycelbuy_periodic='';
            if(title==undefined){
                var time_unit=['天','周','月'];
                title=specs[m].items[kid].period+time_unit[specs[m].items[kid].time_unit]+"一期，共"+specs[m].items[kid].number+"期";
                cycelbuy_periodic=specs[m].items[kid].period+","+specs[m].items[kid].time_unit+","+specs[m].items[kid].number;
            }

			if( j % rowspan==0){
				h[m][j]={title: title,html: "<td class='full' rowspan='" +rowspan + "'>"+ title+"</td>\r\n",id: specs[m].items[kid].id,cycelbuy_periodic:cycelbuy_periodic};
			}
			else{
				h[m][j]={title:title, html: "",id: specs[m].items[kid].id,cycelbuy_periodic:cycelbuy_periodic};
			}
			n++;
			if(n==rowspan){
			kid++; if(kid>specs[m].items.length-1) { kid=0; }
			n=0;
			}
		}
	}

	var hh = "";
	for(var i=0;i<newlen;i++){
		hh+="<tr>";
		var ids = [];
		var titles = [];
		var cycelbuy_periodics=[];
		for(var j=0;j<len;j++){
			hh+=h[j][i].html;
			ids.push( h[j][i].id);
			titles.push( h[j][i].title);
			if(h[j][i].cycelbuy_periodic!=''){
                cycelbuy_periodics.push(h[j][i].cycelbuy_periodic);
			}
		}
		ids =ids.join('_');
		titles= titles.join('+');
        cycelbuy_periodics=cycelbuy_periodics.join();
		var val ={ id : "",title:titles,stock : "",cycelbuy_periodic:"",costprice : "",productprice : "",marketprice : "",weight:"",productsn:"",goodssn:""};


		if( $(".option_id_" + ids).length>0){
			val ={
				id : $(".option_id_" + ids+":eq(0)").val(),
				title: titles,
                cycelbuy_periodics: cycelbuy_periodics,
                stock : $(".option_stock_" + ids+":eq(0)").val(),
                costprice : $(".option_costprice_" + ids+":eq(0)").val(),
				productprice : $(".option_productprice_" + ids+":eq(0)").val(),
				marketprice : $(".option_marketprice_" + ids +":eq(0)").val(),
				goodssn : $(".option_goodssn_" + ids +":eq(0)").val(),
				productsn : $(".option_productsn_" + ids +":eq(0)").val(),
				weight : $(".option_weight_" + ids+":eq(0)").val()
			}
		}

		hh += '<td>'
        hh += '<input data-name="option_cycelbuy_periodic_' + ids+'" type="hidden" class="form-control option_cycelbuy_periodic option_cycelbuy_periodic_' + ids +'" value="' +(val.cycelbuy_periodics=='undefined'?'':val.cycelbuy_periodics )+'"/>';
        hh += '<input data-name="option_stock_' + ids +'" type="text" class="form-control option_stock option_stock_' + ids +'" value="' +(val.stock=='undefined'?'':val.stock )+'"/></td>';
		hh += '<input data-name="option_id_' + ids+'" type="hidden" class="form-control option_id option_id_' + ids +'" value="' +(val.id=='undefined'?'':val.id )+'"/>';
		hh += '<input data-name="option_ids" type="hidden" class="form-control option_ids option_ids_' + ids +'" value="' + ids +'"/>';
		hh += '<input data-name="option_title_' + ids +'" type="hidden" class="form-control option_title option_title_' + ids +'" value="' +(val.title=='undefined'?'':val.title )+'"/></td>';
		hh += '</td>';
		hh += '<td class="type-4"><input data-name="option_marketprice_' + ids+'" type="text" class="form-control option_marketprice option_marketprice_' + ids +'" value="' +(val.marketprice=='undefined'?'':val.marketprice )+'"/></td>';
		hh += '<td class="type-4"><input data-name="option_productprice_' + ids+'" type="text" class="form-control option_productprice option_productprice_' + ids +'" " value="' +(val.productprice=='undefined'?'':val.productprice )+'"/></td>';
		hh += '<td class="type-4"><input data-name="option_costprice_' +ids+'" type="text" class="form-control option_costprice option_costprice_' + ids +'" " value="' +(val.costprice=='undefined'?'':val.costprice )+'"/></td>';
		hh += '<td><input data-name="option_goodssn_' +ids+'" type="text" class="form-control option_goodssn option_goodssn_' + ids +'" " value="' +(val.goodssn=='undefined'?'':val.goodssn )+'"/></td>';
		hh += '<td><input data-name="option_productsn_' +ids+'" type="text" class="form-control option_productsn option_productsn_' + ids +'" " value="' +(val.productsn=='undefined'?'':val.productsn )+'"/></td>';
		hh += '<td><input data-name="option_weight_' + ids +'" type="text" class="form-control option_weight option_weight_' + ids +'" " value="' +(val.weight=='undefined'?'':val.weight )+'"/></td>';
		hh += "</tr>";
	}
	html+=hh;
	html+="</table>";
	$("#options").html(html);
		refreshDiscount();
		refreshIsDiscount();
		<?php  if(p('commission') && !empty($com_set['level'])) { ?>
		refreshCommission();
		commission_change();
		<?php  } ?>
		isdiscount_change();

		if(window.type=='4'){
			$('.type-4').hide();
		}else{
			$('.type-4').show();
		}
}

	function refreshDiscount() {
		var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
		var specs = [];

		$(".spec_item").each(function (i) {
			var _this = $(this);

			var spec = {
				id: _this.find(".spec_id").val(),
				title: _this.find(".spec_title").val()
			};

			var items = [];
			_this.find(".spec_item_item").each(function () {
				var __this = $(this);
				var item = {
					id: __this.find(".spec_item_id").val(),
                    title: __this.find(".spec_item_title").val(),
                    period: __this.find(".spec_item_period").val(),
                    time_unit: __this.find(".spec_item_time_unit").val(),
                    number: __this.find(".spec_item_number").val(),
					show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
				}
				items.push(item);
			});
			spec.items = items;
			specs.push(spec);
		});
		specs.sort(function (x, y) {
			if (x.items.length > y.items.length) {
				return 1;
			}
			if (x.items.length < y.items.length) {
				return -1;
			}
		});

		var len = specs.length;
		var newlen = 1;
		var h = new Array(len);
		var rowspans = new Array(len);
		for (var i = 0; i < len; i++) {
			html += "<th>" + specs[i].title + "</th>";
			var itemlen = specs[i].items.length;
			if (itemlen <= 0) {
				itemlen = 1
			}
			;
			newlen *= itemlen;

			h[i] = new Array(newlen);
			for (var j = 0; j < newlen; j++) {
				h[i][j] = new Array();
			}
			var l = specs[i].items.length;
			rowspans[i] = 1;
			for (j = i + 1; j < len; j++) {
				rowspans[i] *= specs[j].items.length;
			}
		}

		<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
		<?php  if($level['key']=='default') { ?>
		html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;"><?php  echo $level['levelname'];?></div><div class="input-group"><input type="text" class="form-control  input-sm discount_<?php  echo $level["key"];?>_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'discount_<?php  echo $level["key"];?>\');"></a></span></div></div></th>';
		<?php  } else { ?>
		html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;"><?php  echo $level['levelname'];?></div><div class="input-group"><input type="text" class="form-control  input-sm discount_level<?php  echo $level['id'];?>_all"VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'discount_level<?php  echo $level['id'];?>\');"></a></span></div></div></th>';
		<?php  } ?>
		<?php  } } ?>
		html += '</tr></thead>';

		for (var m = 0; m < len; m++) {
			var k = 0, kid = 0, n = 0;
			for (var j = 0; j < newlen; j++) {
				var rowspan = rowspans[m];

                var title=specs[m].items[kid].title;
                if(title==undefined){
                    var time_unit=['天','周','月'];
                    title=specs[m].items[kid].period+time_unit[specs[m].items[kid].time_unit]+"一期，共"+specs[m].items[kid].number+"期";
                }

				if (j % rowspan == 0) {
					h[m][j] = {
						title: title,
						html: "<td class='full' rowspan='" + rowspan + "'>" + title + "</td>\r\n",
						id: specs[m].items[kid].id
					};
				}
				else {
					h[m][j] = {
						title: title,
						html: "",
						id: specs[m].items[kid].id
					};
				}

				n++;
				if (n == rowspan) {
					kid++;
					if (kid > specs[m].items.length - 1) {
						kid = 0;
					}
					n = 0;
				}
			}
		}



		var hh = "";
		for (var i = 0; i < newlen; i++) {
			hh += "<tr>";
			var ids = [];
			var titles = [];
			for (var j = 0; j < len; j++) {
				hh += h[j][i].html;
				ids.push(h[j][i].id);
				titles.push(h[j][i].title);
			}
			ids = ids.join('_');
			titles = titles.join('+');
			var val = {
				id: "",
				title: titles,
				<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
				<?php  if($level['key']=='default') { ?>
				level<?php  echo $level['key'];?>: '',
				<?php  } else { ?>
				level<?php  echo $level['id'];?>: '',
				<?php  } ?>
				<?php  } } ?>
				costprice: "",
				presell: "",
				productprice: "",
				marketprice: "",
				weight: "",
				productsn: "",
				goodssn: ""
			};

			var val ={ id : "",title:titles,<?php  if(is_array($levels)) { foreach($levels as $level) { ?><?php  if($level['key']=='default') { ?> level<?php  echo $level['key'];?>: '',<?php  } else { ?> level<?php  echo $level['id'];?>: '',<?php  } ?><?php  } } ?>costprice : "",productprice : "",marketprice : "",weight:"",productsn:"",goodssn:""};
			if ($(".discount_id_" + ids).length > 0) {
				val = {
					id: $(".discount_id_" + ids + ":eq(0)").val(),
					title: titles,
					<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
				<?php  if($level['key']=='default') { ?>
					level<?php  echo $level['key'];?>: $(".discount_<?php  echo $level['key'];?>_" + ids + ":eq(0)").val(),
				<?php  } else { ?>
					level<?php  echo $level['id'];?>: $(".discount_level<?php  echo $level['id'];?>_" + ids + ":eq(0)").val(),
				<?php  } ?>
					<?php  } } ?>
					costprice: $(".discount_costprice_" + ids + ":eq(0)").val(),
					productprice: $(".discount_productprice_" + ids + ":eq(0)").val(),
					marketprice: $(".discount_marketprice_" + ids + ":eq(0)").val(),
					goodssn: $(".discount_goodssn_" + ids + ":eq(0)").val(),
					productsn: $(".discount_productsn_" + ids + ":eq(0)").val(),
					weight: $(".discount_weight_" + ids + ":eq(0)").val()
				}
			}

			<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
			hh += '<td>'
			<?php  if($level['key']=='default') { ?>
			hh += '<input data-name="discount_level_<?php  echo $level['key'];?>_' + ids +'"type="text" class="form-control discount_<?php  echo $level['key'];?> discount_<?php  echo $level['key'];?>_' + ids +'" value="' +(val.level<?php  echo $level['key'];?>=='undefined'?'':val.level<?php  echo $level['key'];?> )+'"/>';
			<?php  } else { ?>
			hh += '<input data-name="discount_level_<?php  echo $level['id'];?>_' + ids +'"type="text" class="form-control discount_level<?php  echo $level['id'];?> discount_level<?php  echo $level['id'];?>_' + ids +'" value="' +(val.level<?php  echo $level['id'];?>=='undefined'?'':val.level<?php  echo $level['id'];?> )+'"/>';
			<?php  } ?>
			hh += '</td>';
			<?php  } } ?>
			hh += '<input data-name="discount_id_' + ids+'"type="hidden" class="form-control discount_id discount_id_' + ids +'" value="' +(val.id=='undefined'?'':val.id )+'"/>';
			hh += '<input data-name="discount_ids"type="hidden" class="form-control discount_ids discount_ids_' + ids +'" value="' + ids +'"/>';
			hh += '<input data-name="discount_title_' + ids +'"type="hidden" class="form-control discount_title discount_title_' + ids +'" value="' +(val.title=='undefined'?'':val.title )+'"/></td>';
			hh += "</tr>";
		}
		html += hh;
		html += "</table>";

		$("#discount").html(html);
	}

	function refreshIsDiscount() {
		var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
		var specs = [];

		$(".spec_item").each(function (i) {
			var _this = $(this);

			var spec = {
				id: _this.find(".spec_id").val(),
				title: _this.find(".spec_title").val()
			};

			var items = [];
			_this.find(".spec_item_item").each(function () {
				var __this = $(this);
				var item = {
					id: __this.find(".spec_item_id").val(),
					title: __this.find(".spec_item_title").val(),
                    period: __this.find(".spec_item_period").val(),
                    time_unit: __this.find(".spec_item_time_unit").val(),
                    number: __this.find(".spec_item_number").val(),
					show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
				}
				items.push(item);
			});
			spec.items = items;
			specs.push(spec);
		});
		specs.sort(function (x, y) {
			if (x.items.length > y.items.length) {
				return 1;
			}
			if (x.items.length < y.items.length) {
				return -1;
			}
		});

		var len = specs.length;
		var newlen = 1;
		var h = new Array(len);
		var rowspans = new Array(len);
		for (var i = 0; i < len; i++) {
			html += "<th>" + specs[i].title + "</th>";
			var itemlen = specs[i].items.length;
			if (itemlen <= 0) {
				itemlen = 1
			}
			;
			newlen *= itemlen;

			h[i] = new Array(newlen);
			for (var j = 0; j < newlen; j++) {
				h[i][j] = new Array();
			}
			var l = specs[i].items.length;
			rowspans[i] = 1;
			for (j = i + 1; j < len; j++) {
				rowspans[i] *= specs[j].items.length;
			}
		}

		<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
		<?php  if($level['key']=='default') { ?>
		html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;"><?php  echo $level['levelname'];?></div><div class="input-group"><input type="text" class="form-control  input-sm isdiscount_discounts_<?php  echo $level['key'];?>_all" VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'isdiscount_discounts_<?php  echo $level['key'];?>\');"></a></span></div></div></th>';
		<?php  } else { ?>
		html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;"><?php  echo $level['levelname'];?></div><div class="input-group"><input type="text" class="form-control  input-sm isdiscount_discounts_level<?php  echo $level['id'];?>_all" VALUE=""/><span class="input-group-addon"><a href="javascript:;" class="fa fa-angle-double-down" title="批量设置" onclick="setCol(\'isdiscount_discounts_level<?php  echo $level['id'];?>\');"></a></span></div></div></th>';
		<?php  } ?>
		<?php  } } ?>
		html += '</tr></thead>';

		for (var m = 0; m < len; m++) {
			var k = 0, kid = 0, n = 0;
			for (var j = 0; j < newlen; j++) {
				var rowspan = rowspans[m];
                var title=specs[m].items[kid].title;
                if(title==undefined){
                    var time_unit=['天','周','月'];
                    title=specs[m].items[kid].period+time_unit[specs[m].items[kid].time_unit]+"一期，共"+specs[m].items[kid].number+"期";
                }
				if (j % rowspan == 0) {
					h[m][j] = {
						title: title,
						html: "<td class='full' rowspan='" + rowspan + "'>" + title + "</td>\r\n",
						id: specs[m].items[kid].id
					};
				}
				else {
					h[m][j] = {
						title: title,
						html: "",
						id: specs[m].items[kid].id
					};
				}
				n++;
				if (n == rowspan) {
					kid++;
					if (kid > specs[m].items.length - 1) {
						kid = 0;
					}
					n = 0;
				}
			}
		}

		var hh = "";
		for (var i = 0; i < newlen; i++) {
			hh += "<tr>";
			var ids = [];
			var titles = [];
			for (var j = 0; j < len; j++) {
				hh += h[j][i].html;
				ids.push(h[j][i].id);
				titles.push(h[j][i].title);
			}
			ids = ids.join('_');
			titles = titles.join('+');
			var val = {
				id: "",
				title: titles,
			<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
			<?php  if($level['key']=='default') { ?>
			level<?php  echo $level['key'];?>: '',
			<?php  } else { ?>
			level<?php  echo $level['if'];?>: '',
			<?php  } ?>
			<?php  } } ?>
			costprice: "",
					presell: "",
					productprice: "",
					marketprice: "",
					weight: "",
					productsn: "",
					goodssn: ""
		};

			var val ={ id : "",title:titles,<?php  if(is_array($levels)) { foreach($levels as $level) { ?><?php  if($level['key']=='default') { ?> level<?php  echo $level['key'];?>: '',<?php  } else { ?> level<?php  echo $level['id'];?>: '',<?php  } ?><?php  } } ?>costprice : "",productprice : "",marketprice : "",weight:"",productsn:"",goodssn:""};
			if ($(".isdiscount_discounts_id_" + ids).length > 0) {
				val = {
					id: $(".isdiscount_discounts_id_" + ids + ":eq(0)").val(),
					title: titles,
				<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
				<?php  if($level['key']=='default') { ?>
				level<?php  echo $level['key'];?>: $(".isdiscount_discounts_<?php  echo $level['key'];?>_" + ids + ":eq(0)").val(),
				<?php  } else { ?>
				level<?php  echo $level['id'];?>: $(".isdiscount_discounts_level<?php  echo $level['id'];?>_" + ids + ":eq(0)").val(),
				<?php  } ?>
				<?php  } } ?>
				costprice: $(".isdiscount_discounts_costprice_" + ids + ":eq(0)").val(),
						productprice: $(".isdiscount_discounts_productprice_" + ids + ":eq(0)").val(),
						marketprice: $(".isdiscount_discounts_marketprice_" + ids + ":eq(0)").val(),
						presell: $(".isdiscount_discounts_presell_" + ids + ":eq(0)").val(),
						goodssn: $(".isdiscount_discounts_goodssn_" + ids + ":eq(0)").val(),
						productsn: $(".isdiscount_discounts_productsn_" + ids + ":eq(0)").val(),
						weight: $(".isdiscount_discounts_weight_" + ids + ":eq(0)").val()
			}
			}

			<?php  if(is_array($levels)) { foreach($levels as $level) { ?>
			hh += '<td>'
			<?php  if($level['key']=='default') { ?>
			hh += '<input data-name="isdiscount_discounts_level_<?php  echo $level['key'];?>_' + ids +'"type="text" class="form-control isdiscount_discounts_<?php  echo $level['key'];?> isdiscount_discounts_<?php  echo $level['key'];?>_' + ids +'" value="' +(val.level<?php  echo $level['key'];?>=='undefined'?'':val.level<?php  echo $level['key'];?> )+'"/>';
			<?php  } else { ?>
			hh += '<input data-name="isdiscount_discounts_level_<?php  echo $level['id'];?>_' + ids +'"type="text" class="form-control isdiscount_discounts_level<?php  echo $level['id'];?> isdiscount_discounts_level<?php  echo $level['id'];?>_' + ids +'" value="' +(val.level<?php  echo $level['id'];?>=='undefined'?'':val.level<?php  echo $level['id'];?> )+'"/>';
			<?php  } ?>
			hh += '</td>';
			<?php  } } ?>
			hh += '<input data-name="isdiscount_discounts_id_' + ids+'"type="hidden" class="form-control isdiscount_discounts_id isdiscount_discounts_id_' + ids +'" value="' +(val.id=='undefined'?'':val.id )+'"/>';
			hh += '<input data-name="isdiscount_discounts_ids"type="hidden" class="form-control isdiscount_discounts_ids isdiscount_discounts_ids_' + ids +'" value="' + ids +'"/>';
			hh += '<input data-name="isdiscount_discounts_title_' + ids +'"type="hidden" class="form-control isdiscount_discounts_title isdiscount_discounts_title_' + ids +'" value="' +(val.title=='undefined'?'':val.title )+'"/></td>';
			hh += "</tr>";
		}
		html += hh;
		html += "</table>";
		$("#isdiscount_discounts").html(html);
	}

	function refreshCommission() {
		var commission_level = <?php  echo json_encode($commission_level)?>;
		var html = '<table class="table table-bordered table-condensed"><thead><tr class="active">';
		var specs = [];

		$(".spec_item").each(function (i) {
			var _this = $(this);

			var spec = {
				id: _this.find(".spec_id").val(),
				title: _this.find(".spec_title").val()
			};

			var items = [];
			_this.find(".spec_item_item").each(function () {
				var __this = $(this);
				var item = {
					id: __this.find(".spec_item_id").val(),
					title: __this.find(".spec_item_title").val(),
                    period: __this.find(".spec_item_period").val(),
                    time_unit: __this.find(".spec_item_time_unit").val(),
                    number: __this.find(".spec_item_number").val(),
					show: __this.find(".spec_item_show").get(0).checked ? "1" : "0"
				}
				items.push(item);
			});
			spec.items = items;
			specs.push(spec);
		});


		specs.sort(function (x, y) {
			if (x.items.length > y.items.length) {
				return 1;
			}
			if (x.items.length < y.items.length) {
				return -1;
			}
		});

		var len = specs.length;
		var newlen = 1;
		var h = new Array(len);
		var rowspans = new Array(len);
		for (var i = 0; i < len; i++) {
			html += "<th>" + specs[i].title + "</th>";
			var itemlen = specs[i].items.length;
			if (itemlen <= 0) {
				itemlen = 1
			}
			;
			newlen *= itemlen;

			h[i] = new Array(newlen);
			for (var j = 0; j < newlen; j++) {
				h[i][j] = new Array();
			}
			var l = specs[i].items.length;
			rowspans[i] = 1;
			for (j = i + 1; j < len; j++) {
				rowspans[i] *= specs[j].items.length;
			}
		}
		$.each(commission_level,function (key,level) {
			html += '<th><div class=""><div style="padding-bottom:10px;text-align:center;">'+level.levelname+'</div></div></th>';
		})
		html += '</tr></thead>';

		for (var m = 0; m < len; m++) {
			var k = 0, kid = 0, n = 0;
			for (var j = 0; j < newlen; j++) {
				var rowspan = rowspans[m];
                var title=specs[m].items[kid].title;
                if(title==undefined){
                    var time_unit=['天','周','月'];
                    title=specs[m].items[kid].period+time_unit[specs[m].items[kid].time_unit]+"一期，共"+specs[m].items[kid].number+"期";
                }
				if (j % rowspan == 0) {
					h[m][j] = {
						title: title,
						html: "<td class='full' rowspan='" + rowspan + "'>" + title + "</td>\r\n",
						id: specs[m].items[kid].id
					};
				}
				else {
					h[m][j] = {
						title: title,
						html: "",
						id: specs[m].items[kid].id
					};
				}
				n++;
				if (n == rowspan) {
					kid++;
					if (kid > specs[m].items.length - 1) {
						kid = 0;
					}
					n = 0;
				}
			}
		}
		var hh = "";
		for (var i = 0; i < newlen; i++) {
			hh += "<tr>";
			var ids = [];
			var titles = [];
			for (var j = 0; j < len; j++) {
				hh += h[j][i].html;
				ids.push(h[j][i].id);
				titles.push(h[j][i].title);
			}
			ids = ids.join('_');
			titles = titles.join('+');

			var val = {
				id: "",
				title: titles,
			<?php  if(is_array($commission_level)) { foreach($commission_level as $level) { ?>
			<?php  if($level["key"] == "default") { ?>
			level<?php  echo $level['key'];?>: '',
			<?php  } else { ?>
			level<?php  echo $level['id'];?>: '',
			<?php  } ?>
			<?php  } } ?>
			costprice: "",
					presell: "",
					productprice: "",
					marketprice: "",
					weight: "",
					productsn: "",
					goodssn: "",
		};

			var val ={ id : "",title:titles,<?php  if(is_array($commission_level)) { foreach($commission_level as $level) { ?> <?php  if($level["key"] == "default") { ?>level<?php  echo $level['key'];?>: '',<?php  } else { ?>level<?php  echo $level['id'];?>: '',<?php  } ?><?php  } } ?>costprice : "",productprice : "",marketprice : "",weight:"",productsn:"",goodssn:""};
			<?php  if(is_array($commission_level)) { foreach($commission_level as $level) { ?>
			<?php  if($level["key"] == "default") { ?>
			var level<?php  echo $level['key'];?> = new Array(3);
			$(".commission_<?php  echo $level['key'];?>_"+ ids).each(function(index,val){
				level<?php  echo $level['key'];?>[index] = val;
			})
			<?php  } else { ?>
			var level<?php  echo $level['id'];?> = new Array(3);
			$(".commission_level<?php  echo $level['id'];?>_"+ ids).each(function(index,val){
				level<?php  echo $level['id'];?>[index] = val;
			})
			<?php  } ?>
			<?php  } } ?>
			if ($(".commission_id_" + ids).length > 0) {
				val = {
					id: $(".commission_id_" + ids + ":eq(0)").val(),
					title: titles,
					costprice: $(".commission_costprice_" + ids + ":eq(0)").val(),
					presell: $(".commission_presell_" + ids + ":eq(0)").val(),
						productprice: $(".commission_productprice_" + ids + ":eq(0)").val(),
						marketprice: $(".commission_marketprice_" + ids + ":eq(0)").val(),
						goodssn: $(".commission_goodssn_" + ids + ":eq(0)").val(),
						productsn: $(".commission_productsn_" + ids + ":eq(0)").val(),
						weight: $(".commission_weight_" + ids + ":eq(0)").val()
				}
			}
			<?php  if(is_array($commission_level)) { foreach($commission_level as $level) { ?>
			hh += '<td>';
			var level_temp = <?php  if($level['key'] == 'default') { ?>level<?php  echo $level['key'];?><?php  } else { ?>level<?php  echo $level['id'];?><?php  } ?>;
			if (len >= i && typeof (level_temp) != 'undefined')
			{
				if('<?php  echo $level['key'];?>' == 'default')
				{
					for (var li = 0; li<<?php  echo $shopset_level;?>;li++)
					{
						if (typeof (level_temp[li])!= "undefined")
						{
							hh += '<input data-name="commission_level_<?php  echo $level['key'];?>_' +ids+ '"  type="text" class="form-control commission_<?php  echo $level['key'];?> commission_<?php  echo $level['key'];?>_' +ids+ '" value="' +$(level_temp[li]).val()+ '" style="display:inline;width: '+96/parseInt(<?php  echo $shopset_level;?>)+'%;"/> ';
						}
						else
						{
							hh += '<input data-name="commission_level_<?php  echo $level['key'];?>_' +ids+ '"  type="text" class="form-control commission_<?php  echo $level['key'];?> commission_<?php  echo $level['key'];?>_' +ids+ '" value="" style="display:inline;width: '+96/parseInt(<?php  echo $shopset_level;?>)+'%;"/> ';
						}
					}
				}
				else
				{
					for (var li = 0; li<<?php  echo $shopset_level;?>;li++)
					{
						if (typeof (level_temp[li])!= "undefined")
						{
							hh += '<input data-name="commission_level_<?php  echo $level['id'];?>_' +ids+ '"  type="text" class="form-control commission_level<?php  echo $level['id'];?> commission_level<?php  echo $level['id'];?>_' +ids+ '" value="' +$(level_temp[li]).val()+ '" style="display:inline;width: '+96/parseInt(<?php  echo $shopset_level;?>)+'%;"/> ';
						}
						else
						{
							hh += '<input data-name="commission_level_<?php  echo $level['id'];?>_' +ids+ '"  type="text" class="form-control commission_level<?php  echo $level['id'];?> commission_level<?php  echo $level['id'];?>_' +ids+ '" value="" style="display:inline;width: '+96/parseInt(<?php  echo $shopset_level;?>)+'%;"/> ';
						}
					}
				}
			}
			else
			{
				if('<?php  echo $level['key'];?>' == 'default')
				{
					for (var li = 0; li<<?php  echo $shopset_level;?>;li++)
					{
						if (typeof (level_temp[li])!= "undefined")
						{
							hh += '<input data-name="commission_level_<?php  echo $level['key'];?>_' +ids+ '"  type="text" class="form-control commission_<?php  echo $level['key'];?> commission_<?php  echo $level['key'];?>_' +ids+ '" value="' +$(level_temp[li]).val()+ '" style="display:inline;width: '+96/parseInt(<?php  echo $shopset_level;?>)+'%;"/> ';
						}
						else
						{
							hh += '<input data-name="commission_level_<?php  echo $level['key'];?>_' +ids+ '"  type="text" class="form-control commission_<?php  echo $level['key'];?> commission_<?php  echo $level['key'];?>_' +ids+ '" value="" style="display:inline;width: '+96/parseInt(<?php  echo $shopset_level;?>)+'%;"/> ';
						}
					}
				}
				else
				{
					for (var li = 0; li<<?php  echo $shopset_level;?>;li++)
					{
						if (typeof (level_temp[li])!= "undefined")
						{
							hh += '<input data-name="commission_level_<?php  echo $level['id'];?>_' +ids+ '"  type="text" class="form-control commission_level<?php  echo $level['id'];?> commission_level<?php  echo $level['id'];?>_' +ids+ '" value="' +$(level_temp[li]).val()+ '" style="display:inline;width: '+96/parseInt(<?php  echo $shopset_level;?>)+'%;"/> ';
						}
						else
						{
							hh += '<input data-name="commission_level_<?php  echo $level['id'];?>_' +ids+ '"  type="text" class="form-control commission_level<?php  echo $level['id'];?> commission_level<?php  echo $level['id'];?>_' +ids+ '" value="" style="display:inline;width: '+96/parseInt(<?php  echo $shopset_level;?>)+'%;"/> ';
						}
					}
				}
			}
			hh += '</td>';
			<?php  } } ?>
			hh += '<input data-name="commission_id_' + ids+'"type="hidden" class="form-control commission_id commission_id_' + ids +'" value="' +(val.id=='undefined'?'':val.id )+'"/>';
			hh += '<input data-name="commission_ids"type="hidden" class="form-control commission_ids commission_ids_' + ids +'" value="' + ids +'"/>';
			hh += '<input data-name="commission_title_' + ids +'"type="hidden" class="form-control commission_title commission_title_' + ids +'" value="' +(val.title=='undefined'?'':val.title )+'"/></td>';
			hh += "</tr>";
		}
		html += hh;
		html += "</table>";
		$("#commission").html(html);
	}

function setCol(cls){
	$("."+cls).val( $("."+cls+"_all").val());
}
function showItem(obj){
	var show = $(obj).get(0).checked?"1":"0";
	$(obj).parents('.spec_item_item').find('.spec_item_show:eq(0)').val(show);
}
function nofind(){
	var img=event.srcElement;
	img.src="./resource/image/module-nopic-small.jpg";
	img.onerror=null;
}

    function choosetemp(id){
    $('#modal-module-chooestemp').modal();
    $('#modal-module-chooestemp').data("temp",id);
}
function addtemp(){
    var id = $('#modal-module-chooestemp').data("temp");
    var temp_id = $('#modal-module-chooestemp').find("select").val();
    var temp_name = $('#modal-module-chooestemp option[value='+temp_id+']').text();
    //alert(temp_id+":"+temp_name);
    $("#temp_name_"+id).val(temp_name);
    $("#temp_id_"+id).val(temp_id);
    $('#modal-module-chooestemp .close').click();
    refreshOptions()
}

function setinterval(type)
{
	var intervalfloor =$('#intervalfloor').val();
	if(intervalfloor=="")
	{
		intervalfloor=0;
	}
	intervalfloor = parseInt(intervalfloor);

	if(type=='plus')
	{
		if(intervalfloor==3)
		{
			tip.msgbox.err("最多添加三个区间价格");
			return;
		}
		intervalfloor=intervalfloor+1;
	}
	else if(type=='minus')
	{
		if(intervalfloor==0)
		{
			tip.msgbox.err("请最少添加一个区间价格");
			return;
		}
		intervalfloor=intervalfloor-1;
	}else
	{
		return;
	}

	if(intervalfloor<1)
	{

		$('#interval1').hide();
		$('#intervalnum1').val("");
		$('#intervalprice1').val("");
	}else
	{
		$('#interval1').show();
	}

	if(intervalfloor<2)
	{

		$('#interval2').hide();
		$('#intervalnum2').val("");
		$('#intervalprice2').val("");
	}else
	{
		$('#interval2').show();
	}

	if(intervalfloor<3)
	{

		$('#interval3').hide();
		$('#intervalnum3').val("");
		$('#intervalprice3').val("");
	}else
	{
		$('#interval3').show();
	}


	$('#intervalfloor').val(intervalfloor);

}


</script>