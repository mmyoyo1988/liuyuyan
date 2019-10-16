<?php defined('IN_IA') or exit('Access Denied');?><div class="form-group-title">通知模版设置</div>
<div class="form-group">
    <label class="col-lg control-label">模版id</label>
    <div class="col-sm-9 col-xs-10">
        <input type="text" class="form-control " id="sendtemplateid" name="data[sendtemplateid]" value="<?php  echo $data['sendtemplateid'];?>">
        <span class="help-block">模版搜索关键字：业务处理通知/OPENTM413117078</span>
    </div>
</div>


<!--新用户扫描成功通知(任务执行者)-->
<h3 class="form-group-title">优惠券发送通知</h3>
<div class="form-group">
    <label class="col-lg control-label">通知信息头部</label>
    <div class="col-sm-9 col-xs-10">
            <input type="text" class="form-control" id="frist" name="data[frist]"  value="<?php  echo $data['frist'];?>">
    </div>
    <div class="col-sm-1 col-xs-2">
            <input type="color" id="fristcolor" name="data[fristcolor]" value="<?php  echo $data['fristcolor'];?>" style="width:32px;height:32px;">
    </div>
</div>

<div class="form-group">
    <label class="col-lg control-label">通知信息1</label>
    <div class="col-sm-9 col-xs-12">
        <textarea id="keyword1" name="data[keyword1]" rows="5" class="form-control"><?php  if(!empty($data['keyword1'])) { ?><?php  echo $data['keyword1'];?><?php  } else { ?>恭喜您获得优惠卷<?php  } ?></textarea>
    </div>
    <div class="col-sm-1 col-xs-2">
        <input id="keyword1color" type="color" name="data[keyword1color]" value="<?php  echo $data['keyword1color'];?>" style="width:32px;height:32px;" />
    </div>
</div>

<div class="form-group">
    <label class="col-lg control-label">通知信息2</label>
    <div class="col-sm-9 col-xs-12">
        <textarea id="keyword2" name="data[keyword2]" rows="5" class="form-control"><?php  if(!empty($data['keyword2'])) { ?><?php  echo $data['keyword2'];?><?php  } else { ?>请您点击查看<?php  } ?></textarea>
    </div>
    <div class="col-sm-1 col-xs-2">
        <input type="color" id="keyword2color" name="data[keyword2color]" value="<?php  echo $data['keyword2color'];?>" style="width:32px;height:32px;" />
    </div>
</div>

<div class="form-group">
    <label class="col-lg control-label">模板信息结尾</label>
    <div class="col-sm-9 col-xs-12">
        <input type="text" id="remark" class="form-control " name="data[remark]"  value="<?php  echo $data['remark'];?>">
    </div>
    <div class="col-sm-1 col-xs-2">
        <input type="color" id="remarkcolor" name="data[remarkcolor]" value="<?php  echo $data['remarkcolor'];?>" style="width:32px;height:32px;" />
    </div>
</div>

<div class="form-group">
    <label class="col-lg control-label">推送链接</label>
    <div class="col-sm-9 col-xs-12">
        <div class="input-group form-group" style="margin: 0;">
            <input type="text" id="templateurl" name="data[templateurl]" class="form-control" value="<?php  echo $data['templateurl'];?>" id="templateurl" />
            <span data-input="#templateurl" data-toggle="selectUrl" data-full="true" class="input-group-addon btn btn-default">选择链接</span>
        </div>
        <span class='help-block'>消息推送点击的链接，为空默认为优惠券详情</span>
    </div>
</div>