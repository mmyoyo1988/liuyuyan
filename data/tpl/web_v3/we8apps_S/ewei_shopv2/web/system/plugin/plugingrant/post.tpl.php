<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    .multi-img-details .multi-item img{height:100px;}
    .input-group-date{padding:5px 0;}
    .input-group-remove{cursor: pointer;}
</style>
<div class="page-header">
    当前位置：<span class="text-primary"><?php  if(!empty($item['id'])) { ?>查看<?php  } else { ?>添加<?php  } ?>授权管理 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></span>
</div>

<div class="page-content">
    <div class="page-sub-toolbar">
        <a class='btn btn-primary btn-sm' href="<?php  echo webUrl('system/plugin/plugingrant/add')?>"><i class='fa fa-plus'></i> 添加公众号授权</a>
    </div>
    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
            <div class="tab-content ">
                <div class="tab-pane active">
                    <div class="panel-body">
                        <div class="form-group type-wechat">
                            <label class="col-lg control-label must">选择公众号</label>
                            <div class="col-sm-9 col-xs-12">
                                <?php  if(!empty($item['id'])) { ?>
                                <div class="group-date-all">
                                    <div class="input-group input-group-date"><?php  echo $account['title'];?></div>
                                </div>
                                <?php  } else { ?>
                                <?php  echo tpl_selector('uniacid',array(
                    'preview'=>false,
                                'text'=>'name',
                                'key'=>'acid',
                                'url'=>webUrl('system/plugin/plugingrant/query'),
                                'items'=>$account,
                                'nokeywords'=>1,
                                'autosearch'=>1,
                                'placeholder'=>'公众号名称',
                                'buttontext'=>"选择公众号"))
                                ?>
                                <?php  } ?>
                            </div>
                        </div>

                        <div class="form-group" id="product">
                            <label class="col-lg control-label must">选择应用</label>
                            <div class="col-sm-9 col-xs-12">
                                <?php  if(!empty($item['id'])) { ?>
                                <div class="input-group multi-img-details container">
                                    <div class="multi-item" data-id="3" data-name="pluginid">
                                        <img class="img-responsive img-thumbnail" src="<?php  echo tomedia($plugin['thumb'])?>">
                                        <div class="img-nickname"><?php  echo $item['title'];?></div>
                                        <input type="hidden" value="3" name="pluginid">
                                        <div style="clear:both;"></div>
                                    </div>
                                </div>
                                <?php  } else { ?>
                                <?php  echo tpl_selector_new('pluginid',
                            array(
                            'multi'=>1,
                                'type'=>'image',
                                'value'=>$item['name'],
                                'placeholder'=>'指定应用名称',
                                'buttontext'=>'选择应用',
                                'items'=>$plugin,
                                'nokeywords'=>1,
                                'autosearch'=>1,
                                'url'=>webUrl('system/plugin/plugingrant/queryplugin')))?>
                                <?php  } ?>

                            </div>
                        </div>

                        <div class="form-group cgt cgt-2">
                            <label class="col-lg control-label">授权时长</label>
                            <div class="col-sm-9 col-xs-12">
                                <?php  if(!empty($item['id'])) { ?>
                                <div class="group-date-all">
                                    <div class="input-group fixsingle-input-group input-group-date"><?php  if($item['month']==0) { ?>永久<?php  } else { ?><?php  echo $item['month'];?>个月<?php  } ?></div>
                                </div>
                                <?php  } else { ?>
                                <div class="group-date-all">
                                    <div class="input-group fixsingle-input-group input-group-date">
                                        <input type="number" class="form-control" name="month" value="<?php  echo $item['month'];?>">
                                        <span class="input-group-addon">个月</span>
                                    </div>
                                </div>
                                <?php  } ?>
                                <div class="alert alert-warning" style="margin-top:10px;margin-bottom:0px;">注意：使用时长设置为0，期限为永久。</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg control-label">是否授权</label>
                            <div class="col-xs-12 col-sm-8">
                                <?php  if(!empty($item['id'])) { ?>
                                <div class="group-date-all">
                                    <div class="input-group input-group-date">
                                        <span class='label <?php  if($item['isperm']==1) { ?>label-danger<?php  } else { ?>label-default<?php  } ?>'
                                        <?php  if($item['isperm']==0) { ?>
                                        data-toggle='ajaxSwitch'
                                        data-switch-value='<?php  echo $item['isperm'];?>'
                                        data-switch-value0='0|授权|label label-default|<?php  echo webUrl('system/plugin/plugingrant/grant',array('id'=>$item['id']))?>'
                                        data-switch-value1='1|已授权|label label-danger|<?php  echo webUrl('system/plugin/plugingrant/grant',array('id'=>$item['id']))?>'<?php  } ?>>
                                        <?php  if($item['isperm']==1) { ?>已授权<?php  } else { ?>授权<?php  } ?></span>
                                    </div>
                                </div>
                                <?php  } else { ?>
                                <div class="input-group">
                                    <label class="radio radio-inline">
                                        <input type="radio" name="isperm" value="1" <?php  if(intval($item['isperm']) ==1 ) { ?>checked="checked"<?php  } ?>> 是
                                    </label>
                                    <label class="radio radio-inline">
                                        <input type="radio" name="isperm" value="0" <?php  if(intval($item['isperm']) ==0) { ?>checked="checked"<?php  } ?>> 否
                                    </label>
                                </div>
                                <?php  } ?>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

    <div class="form-group">
        <label class="col-lg control-label"></label>
        <div class="col-sm-9 col-xs-12">
            <?php  if(!empty($item['id'])) { ?>
            <a class="btn btn-default  btn-sm" href="<?php  echo webUrl('system/plugin/plugingrant')?>">返回列表</a>
            <?php  } else { ?>
            <input type="submit"  value="提交" class="btn btn-primary" />
            <a class="btn btn-default " href="<?php  echo webUrl('system/plugin/plugingrant')?>">返回列表</a>
            <?php  } ?>
        </div>
    </div>

    </form>
</div>
<script type="text/javascript">
    $(function () {

    })
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
