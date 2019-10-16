<?php defined('IN_IA') or exit('Access Denied');?><div class="region-goods-details row">
    <div class="region-goods-left col-sm-2">
        基本信息
    </div>
    <div class="region-goods-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">排序</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('goods' ,$item) ) { ?>
                <input type="text" name="displayorder" id="displayorder" class="form-control" value="<?php  echo $item['displayorder'];?>" />
                <span class='help-block'>数字越大，排名越靠前,如果为空，默认排序方式为创建时间</span>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $item['displayorder'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label must">商品名称</label>
            <?php if( ce('goods' ,$item) ) { ?>
            <div class="col-sm-7"  style="padding-right:0;" >
                <input type="text" name="goodsname" id="goodsname" class="form-control" value="<?php  echo $item['title'];?>" data-rule-required="true" />
            </div>
            <div class="col-sm-2" style="padding-left:5px">
                <input type="text" name="unit" id="unit" class="form-control" value="<?php  echo $item['unit'];?>" placeholder="单位, 如: 个/件/包"  />
            </div>
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['title'];?></div>
            <?php  } ?>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">副标题</label>
            <?php if( ce('goods' ,$item) ) { ?>
            <div class="col-sm-9 subtitle">
                <textarea id="" name="subtitle" id="subtitle" rows="5"  class="form-control" data-parent=".subtitle" maxlength="100" data-rule-maxlength="100"><?php  echo $item['subtitle'];?></textarea>
                <div class="help-block">副标题的长度请控制在100字以内</div>
            </div>
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['subtitle'];?></div>
            <?php  } ?>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">商品短标题</label>
            <?php if( ce('goods' ,$item) ) { ?>
            <div class="col-sm-9 subtitle">
                <input type="text" name="shorttitle" class="form-control" value="<?php  echo $item['shorttitle'];?>" />
                <div class="help-block">商品短标题 用于快递打印,以及小型热敏打印机打印</div>
            </div>

            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['shorttitle'];?></div>
            <?php  } ?>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">关键字</label>
            <?php if( ce('goods' ,$item) ) { ?>
            <div class="col-sm-9">
                <input type="text" name="keywords" class="form-control" value="<?php  echo $item['keywords'];?>"/>
                <div class="help-block">商品关键字,能准确搜到商品的,比如 : 海尔电视|电视 之类的</div>
            </div>
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['keywords'];?></div>
            <?php  } ?>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">商品类型</label>
            <div class="col-sm-9 col-xs-12">
                <input type="hidden" name="goodstype" value="9">
                <?php if( ce('goods' ,$item) ) { ?>
                <label class="radio-inline"><input type="radio" name="type" value="9" checked="true" disabled /> 周期购商品</label>
                <?php  } else { ?>
                    <div class='form-control-static'>
                      周期购商品
                    </div>
                <?php  } ?>
            </div>
        </div>
    </div>
</div>

    <!--商品信息-->
    <div class="region-goods-details row">
        <div class="region-goods-left col-sm-2">
            商品信息
        </div>
        <div class="region-goods-right col-sm-10">

            <div class="form-group">
                <label class="col-sm-2 control-label">商品分类</label>
                <div class="col-sm-8 col-xs-12">
                    <?php if( ce('goods' ,$item) ) { ?>
                    <select id="cates"  name='cates[]' class="form-control select2" style='width:605px;' multiple='' >
                        <?php  if(is_array($category)) { foreach($category as $c) { ?>
                        <option value="<?php  echo $c['id'];?>" <?php  if(is_array($cates) &&  in_array($c['id'],$cates)) { ?>selected<?php  } ?> ><?php  echo $c['name'];?></option>
                        <?php  } } ?>
                    </select>
                    <?php  } else { ?>
                    <div class='form-control-static ops'>
                        <?php  if(is_array($cates)) { foreach($cates as $c) { ?>
                        <a><?php  echo $category[$c]['name'];?></a>
                        <?php  } } ?>
                    </div>

                    <?php  } ?>
                </div>
            </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">商品属性</label>
        <div class="col-sm-9 col-xs-12" >
            <?php if( ce('goods' ,$item) ) { ?>
            <label for="isrecommand" class="checkbox-inline">
                <input type="checkbox" name="isrecommand" value="1" id="isrecommand" <?php  if($item['isrecommand'] == 1) { ?>checked="true"<?php  } ?> /> 推荐
            </label>
            <label for="isnew" class="checkbox-inline">
                <input type="checkbox" name="isnew" value="1" id="isnew" <?php  if($item['isnew'] == 1) { ?>checked="true"<?php  } ?> /> 新品
            </label>
            <label for="ishot" class="checkbox-inline">
                <input type="checkbox" name="ishot" value="1" id="ishot" <?php  if($item['ishot'] == 1) { ?>checked="true"<?php  } ?> /> 热卖
            </label>

            <label for="issendfree" class="checkbox-inline">
                <input type="checkbox" name="issendfree" value="1" id="issendfree" <?php  if($item['issendfree'] == 1) { ?>checked="true"<?php  } ?> /> 包邮
            </label>

            <label for="isnodiscount" class="checkbox-inline">
                <input type="checkbox" name="isnodiscount" value="1" id="isnodiscount" <?php  if($item['isnodiscount'] == 1) { ?>checked="true"<?php  } ?> /> 不参与会员折扣
            </label>

            <?php  } else { ?> <div class='form-control-static'>
            <?php  if($item['isnew']==1) { ?>新品; <?php  } ?>
            <?php  if($item['ishot']==1) { ?>热卖; <?php  } ?>
            <?php  if($item['isrecommand']==1) { ?>推荐; <?php  } ?>
            <?php  if($item['issendfree']==1) { ?>包邮; <?php  } ?>
            <?php  if($item['isnodiscount']==1) { ?>不参与折扣; <?php  } ?>
        </div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group price" <?php  if($item['type']==4) { ?>  style="display: block"<?php  } ?>>
        <label class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('goods' ,$item) ) { ?>
            <div class="input-group">
                <input type="text" name="marketprice" id="marketprice" class="form-control" value="<?php  echo $item['marketprice'];?>" />
                <span class="input-group-addon">元 原价</span>
                <input type="text" name="productprice" id="productprice" class="form-control" value="<?php  echo $item['productprice'];?>" />
                <span class="input-group-addon">元 成本</span>
                <input type="text" name="costprice" id="costprice" class="form-control" value="<?php  echo $item['costprice'];?>" />
                <span class="input-group-addon">元</span>
            </div>
            <span class='help-block'>尽量填写完整，有助于于商品销售的数据分析</span>
            <?php  } else { ?>
            <div class='form-control-static'>现价：<?php  echo $item['marketprice'];?> 元 原价：<?php  echo $item['productprice'];?> 元 成本：<?php  echo $item['costprice'];?> 元</div>
            <?php  } ?>
        </div>
    </div>




    <?php  if(p('offic')) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">文案营销长图</label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('goods' ,$item) ) { ?>
            <?php  echo tpl_form_field_image2('officthumb', $item['officthumb'])?>
            <span class='help-block'>营销专用商品长缩略图</span>
            <?php  } else { ?>
            <?php  if(!empty($item['officthumb'])) { ?>
            <a href="<?php  echo tomedia($item['officthumb'])?>" target="_blank">
            <img src="<?php  echo tomedia($item['officthumb'])?>" style="width:100px;border:1px solid #ccc;padding:1px" />
            </a>
            <?php  } ?>
            <?php  } ?>
        </div>
    </div>
    <?php  } ?>
    <div class="form-group">
        <label class="col-sm-2 control-label must">商品图片</label>
        <div class="col-sm-9 col-xs-12 gimgs">
            <?php if( ce('goods' ,$item) ) { ?>
            <?php  echo tpl_form_field_multi_image2('thumbs',$piclist)?>
            <span class="help-block image-block">第一张为缩略图，建议为正方型图片，其他为详情页面图片，尺寸建议宽度为640，并保持图片大小一致</span>
            <span class="help-block">您可以拖动图片改变其显示顺序 </span>
            <?php  } else { ?>
            <?php  if(is_array($piclist)) { foreach($piclist as $p) { ?>
            <a href='<?php  echo tomedia($p)?>' target='_blank'>
                <img src="<?php  echo tomedia($p)?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
            </a>
            <?php  } } ?>
            <?php  } ?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <?php if( ce('goods' ,$item) ) { ?>
            <label class="checkbox-inline"><input type="checkbox" name="thumb_first" value="1" <?php  if($item['thumb_first'] == 1) { ?>checked="true"<?php  } ?>   /> 详情显示首图</label>
            <span class="help-block"></span>
            <?php  } else { ?>
            <div class='form-control-static'><?php  if(empty($item['thumb_first'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>
    <?php  if(p('app')) { ?>
    <div class="form-group">
        <label class="col-sm-2 control-label">首图视频</label>
        <div class="col-sm-9 col-xs-12">
            <?php  echo tpl_form_field_video2('video', $item['video'], array('disabled'=>!cv('goods.edit'), 'network'=>true, 'placeholder'=>'请选择视频'))?>
            <div class='form-control-static'>设置后商品详情首图默认显示视频，目前仅支持小程序</div>
        </div>
    </div>
    <?php  } ?>

        <div class="form-group" <?php  if($item['type']==10) { ?>style="display:none"<?php  } ?>>
        <label class="col-sm-2 control-label">已出售数</label>
        <div class="col-sm-6 col-xs-12">
            <?php if( ce('goods' ,$item) ) { ?>
            <div class="input-group">
                <input type="text" name="sales" id="sales" class="form-control" value="<?php  echo $item['sales'];?>" />
                <span class="input-group-addon">件</span>
            </div>
            <?php  } else { ?>
            <div class='form-control-static'><?php  echo $item['sales'];?> 件</div>
            <?php  } ?>
        </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('goods' ,$item) ) { ?>
                <label class="checkbox-inline"><input type="checkbox" name="showsales" value="1" <?php  if($item['showsales'] == 1) { ?>checked="true"<?php  } ?>   /> 显示销量</label>
                <span class="help-block"></span>
                <?php  } else { ?>
                <div class='form-control-static'><?php  if(empty($item['showsales'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
                <?php  } ?>
            </div>
        </div>

    </div>
</div>



<div class="region-goods-details row">
    <div class="region-goods-left col-sm-2">
        商品属性
    </div>
    <div class="region-goods-right col-sm-10">
        <div class="form-group">
            <label class="col-sm-2 control-label">单品满额包邮</label>
            <div class="col-sm-8">
                <?php if( ce('goods' ,$item) ) { ?>
                <div class='input-group fixsingle-input-group'>
                    <span class="input-group-addon">满</span>
                    <input type="text" name="edmoney" value="<?php  echo $item['edmoney'];?>" class="form-control"/>
                    <span class="input-group-addon">元</span>
                </div>
                <span class="help-block">如果设置0或空，则不支持满额包邮</span>
                <?php  } else { ?>
                <div class='form-control-static'><?php  if(empty($item['edmoney'])) { ?>不支持满额包邮<?php  } else { ?>支持 <?php  } ?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">不参与单品包邮地区</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('goods' ,$item) ) { ?>
                <div id="areas" class="form-control-static"><?php  echo $item['edareas'];?></div>
                <a href="javascript:;" class="btn btn-default" onclick="selectAreas()">添加不参加满包邮的地区</a>
                <input type="hidden" id='selectedareas' name="edareas" value="<?php  echo $item['edareas'];?>"/>
                <input type="hidden" id='selectedareas_code' name="edareas_code" value="<?php  echo $item['edareas_code'];?>"/>
                <span class="help-block">如果设置0或空，则不支持满件包邮</span>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $set['enoughareas'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group dispatch_info" <?php  if(($item['type'] == 2 || $item['type'] == 3 || $item['type'] == 10)) { ?>style="display: none;"<?php  } ?>>
        <label class="col-sm-2 control-label">运费设置</label>
        <div class="col-sm-6 col-xs-6" style='padding-left:0'>
            <?php if( ce('goods' ,$item) ) { ?>
            <div class="input-group">
                <span class='input-group-addon' style='border:none'><label class="radio-inline" style='margin-top:-7px;' ><input type="radio" name="dispatchtype" value="0" <?php  if(empty($item['dispatchtype'])) { ?>checked="true"<?php  } ?>   /> 运费模板</label></span>
                <select class="form-control tpl-category-parent select2" id="dispatchid" name="dispatchid">
                    <option value="0">默认模板</option>
                    <?php  if(is_array($dispatch_data)) { foreach($dispatch_data as $dispatch_item) { ?>
                    <option value="<?php  echo $dispatch_item['id'];?>" <?php  if($item['dispatchid'] == $dispatch_item['id']) { ?>selected="true"<?php  } ?>><?php  echo $dispatch_item['dispatchname'];?></option>
                    <?php  } } ?>
                </select>
            </div>
            <span class="help-block">如果开启了同城配送，系统优先使用同城配送方式，如果未开启同城配送或者超出同城配送范围则使用普通快递方式计算运费（运费计算方式为：运费*期）</span>
            <?php  } else { ?>
            <div class='form-control-static'><?php  if(empty($item['dispatchtype'])) { ?>运费模板 <?php  if($item['dispatchid'] == 0) { ?>默认模板<?php  } else { ?><?php  if(is_array($dispatch_data)) { foreach($dispatch_data as $dispatch_item) { ?><?php  if($item['dispatchid'] == $dispatch_item['id']) { ?><?php  echo $dispatch_item['dispatchname'];?><?php  } ?><?php  } } ?><?php  } ?><?php  } else { ?>统一邮费<?php  } ?></div>
            <?php  } ?>
        </div>
    </div>
    <?php if( ce('goods' ,$item) ) { ?>
    <div class="form-group dispatch_info" <?php  if(($item['type'] == 2 || $item['type'] == 3 || $item['type'] == 10)) { ?>style="display: none;"<?php  } ?>>
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-6 col-xs-6" style='padding-left:0'>
        <div class="input-group">
            <span class='input-group-addon' style='border:none'><label class="radio-inline"  style='margin-top:-7px;' ><input type="radio"name="dispatchtype" value="1" <?php  if($item['dispatchtype'] == 1) { ?>checked="true"<?php  } ?>  /> 统一邮费</label></span>
            <input type="text" name="dispatchprice" id="dispatchprice" class="form-control" value="<?php  echo $item['dispatchprice'];?>" />
            <span class="input-group-addon">元</span>
        </div>
        <span class="help-block">如果开启了同城配送，同城运费根据统一邮费进行计算（运费计算方式为：运费*期）</span>
    </div>
</div>
<?php  } ?>

<div class="form-group">
    <label class="col-sm-2 control-label">所在地</label>
    <div class="col-sm-6 col-xs-6">
        <?php if( ce('goods' ,$item) ) { ?>

        <select id="sel-provance" name='province' onchange="selectCity();" class="form-control" style='width:200px;display: inline-block' >
            <option value="" selected="true">省/直辖市</option>
        </select>
        <select id="sel-city" name='city'  onchange="selectcounty(0)" class="form-control" style='width:200px;display: inline-block' >
            <option value="" selected="true">请选择</option>
        </select>
        <select id="sel-area" name='area'  class="form-control" style='width:200px;display: inline-block;display:none;' >
            <option value="" selected="true">请选择</option>
        </select>

        <span class='help-block'>商品所在地，显示在详情页面，如果不选择，则显示商城所在地</span>
        <script language='javascript'>
            cascdeInit("<?php  echo $new_area?>","0","<?php  echo $item['province'];?>","<?php  echo $item['city'];?>","");
        </script>
        <?php  } else { ?>
        <div class='form-control-static'><?php  echo $item['province'];?> <?php  echo $item['province'];?></div>
        <?php  } ?>
    </div>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">发票</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('goods' ,$item) ) { ?>
        <label class="checkbox-inline"><input type="checkbox" name="invoice" value="1" <?php  if(!empty($item['invoice'])) { ?>checked="true"<?php  } ?>/> 支持</label>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(!empty($item['invoice'])) { ?>支持<?php  } else { ?>不支持<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">标签</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('goods' ,$item) ) { ?>
        <label class="checkbox-inline"><input type="checkbox" name="quality" value="1" <?php  if(!empty($item['quality'])) { ?>checked="true"<?php  } ?>   /> 正品保证</label>
        <label class="checkbox-inline"><input type="checkbox" name="seven" value="1" <?php  if(!empty($item['seven'])) { ?>checked="true"<?php  } ?>   /> 7天无理由退换</label>
        <label class="checkbox-inline"><input type="checkbox" name="repair" value="1" <?php  if(!empty($item['repair'])) { ?>checked="true"<?php  } ?>   /> 保修</label>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if(!empty($item['quality'])) { ?>正品保证;<?php  } ?>
            <?php  if(!empty($item['seven'])) { ?>7天无理由退换;<?php  } ?>
            <?php  if(!empty($item['repair'])) { ?>保修;<?php  } ?>
        </div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">自定义标签</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('goods' ,$item) ) { ?>
        <?php  echo tpl_selector('labelname',
            array('text'=>'labelname',
        'multi'=>1,
        'type'=>'text',
        'placeholder'=>'自定义标签组名称',
        'buttontext'=>'选择标签',
        'items'=>$label,
        'nokeywords'=>1,
        'autosearch'=>1,
        'url'=>webUrl('goods/label/query')))?>
        <?php  } else { ?>
        <div class='form-control-static'>
            <?php  if(is_array($labelname)) { foreach($labelname as $label) { ?>
            <?php  echo $label;?>;
            <?php  } } ?>
        </div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">上架</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('goods' ,$item) ) { ?>
        <label class="radio-inline"><input type="radio" name="status" value="0" <?php  if($item['status'] == 2) { ?>disabled<?php  } ?> <?php  if(empty($item['status'])) { ?>checked="true"<?php  } ?>/> 否</label>
        <label class="radio-inline"><input type="radio" name="status" value="1" <?php  if($item['status'] == 2) { ?>disabled<?php  } ?> <?php  if($item['status'] == 1) { ?>checked="true"<?php  } ?>   /> 上架</label>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['status'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">是否选择上架时间</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('goods' ,$item) ) { ?>
        <label class="radio-inline"><input type="radio" name="isstatustime" value="1" <?php  if($item['isstatustime'] == 1) { ?>checked="true"<?php  } ?>   /> 是</label>
        <label class="radio-inline"><input type="radio" name="isstatustime" value="0" <?php  if(empty($item['isstatustime'])) { ?>checked="true"<?php  } ?>/> 否</label>
        <span class="help-block">商品在选择时间内自动上架，过期自动下架</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['isstatustime'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<div id="shelves" class="form-group" <?php  if($item['isstatustime']!=1) { ?>style="display:none"<?php  } ?>>
<label class="col-sm-2 control-label">
    上架时间
</label>
<?php if( ce('goods' ,$item) ) { ?>
<div class="col-sm-4 col-xs-6">
    <?php  echo tpl_form_field_eweishop_daterange('statustime', array('starttime'=>date('Y-m-d H:i', $item['statustimestart']),'endtime'=>date('Y-m-d H:i', $item['statustimeend'])),true);?>
</div>
<?php  } else { ?>
<div class="col-sm-6 col-xs-6">
    <div class='form-control-static'>
        <?php  if($item['status']==1) { ?> <?php  echo date('Y-m-d H:i',$item['statustimestart'])?> - <?php  echo date('Y-m-d H:i',$item['statustimeend'])?> <?php  } ?>
    </div>
</div>
<?php  } ?>
</div>


<div class="form-group">
    <label class="col-sm-2 control-label">主商城搜索结果中是否显示该商品</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('goods' ,$item) ) { ?>
        <label class="radio-inline"><input type="radio" name="nosearch" value="1" <?php  if($item['nosearch'] == 1) { ?>checked="true"<?php  } ?>   /> 隐藏</label>
        <label class="radio-inline"><input type="radio" name="nosearch" value="0" <?php  if(empty($item['nosearch'])) { ?>checked="true"<?php  } ?>/> 显示</label>

        <span class="help-block">禁止后,在主商城搜索结果中,将不会显示该商品</span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['nosearch'])) { ?>显示<?php  } else { ?>隐藏<?php  } ?></div>
        <?php  } ?>
    </div>
</div>

<?php  if(p('groups')) { ?>
<div class="form-group" style="display: none;">
    <label class="col-sm-2 control-label">是否支持拼团</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('goods' ,$item) ) { ?>
        <label class="radio-inline"><input type="radio" name="groupstype" value="1" <?php  if($item['groupstype'] == 1) { ?>checked="true"<?php  } ?>   /> 是</label>
        <label class="radio-inline"><input type="radio" name="groupstype" value="0" <?php  if(empty($item['groupstype'])) { ?>checked="true"<?php  } ?>/> 否</label>
        <span class="help-block"></span>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['groupstype'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
        <?php  } ?>
    </div>
</div>
<?php  } ?>


<div class="entity" <?php  if(($item['type'] == 2 || $item['type'] == 3 || $item['type'] == 10)) { ?>style="display: none;"<?php  } ?>>
<div class="form-group">
    <label class="col-sm-2 control-label">是否支持退换货</label>
    <div class="col-sm-9 col-xs-12">
        <?php if( ce('goods' ,$item) ) { ?>
        <label class="radio-inline"><input type="radio" name="cannotrefund" value="0" <?php  if(empty($item['cannotrefund'])) { ?>checked="true"<?php  } ?>   /> 是</label>
        <label class="radio-inline"><input type="radio" name="cannotrefund" value="1" <?php  if(!empty($item['cannotrefund'])) { ?>checked="true"<?php  } ?>/> 否</label>
        <?php  } else { ?>
        <div class='form-control-static'><?php  if(empty($item['cannotrefund'])) { ?>否<?php  } else { ?>是<?php  } ?></div>
        <?php  } ?>
    </div>
</div>

</div>
    </div>
</div>



<script language="javascript">
    require(['jquery.ui'],function(){
        $('.multi-img-details').sortable({scroll:'false'});
        $('.multi-img-details').sortable('option', 'scroll', false);
        /*$('.multi-img-details').sortable({zIndex: 50 });

        $('.multi-img-details').sortable('option','zIndex', 50);*/
    })
    $(function () {
        $("input[name=isstatustime]").off('click').on('click',function () {
            if($(this).val()==1){
                $("#shelves").show()
            }else{
                $("#shelves").hide();
            }
        })
    })
</script>

<?php  if(empty($new_area)) { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('shop/selectareas', TEMPLATE_INCLUDEPATH)) : (include template('shop/selectareas', TEMPLATE_INCLUDEPATH));?>
<?php  } else { ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('shop/selectareasNew', TEMPLATE_INCLUDEPATH)) : (include template('shop/selectareasNew', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>