<?php defined('IN_IA') or exit('Access Denied');?><div class="modal fade" id="addModal" aria-hidden="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="close">×</div>
                <h4 class="modal-title">添加自定义模板</h4>
            </div>
            <div class="modal-body form-horizontal" style="padding-bottom: 0;">
                <div class="form-group">
                    <div class="col-sm-2 control-label must">缩略图</div>
                    <div class="col-sm-10">
                        <div class="image image-nail" title="选择缩略图" data-toggle="selectImage" data-input="#image-nail" data-img="#image-nail-show">
                            <img src="" id="image-nail-show" />
                            <div class="text">重新选择</div>
                            <input type="hidden" id="image-nail" />
                        </div>
                        <div class="help-block">模板缩略图，尺寸为100 * 100（尺寸不正确可能会被拉伸）</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 control-label must">背景图</div>
                    <div class="col-sm-10">
                        <div class="image image-bg" title="选择背景图" data-toggle="selectImage" data-input="#image-bg" data-img="#image-bg-show">
                            <img src="" id="image-bg-show" />
                            <div class="text">重新选择</div>
                            <input type="hidden" id="image-bg" />
                        </div>
                        <div class="help-block">模板背景图，尺寸为750 * 1334（尺寸不正确可能会被拉伸）</div>
                        <div class="help-block">自定义模板元素位置请参照默认模板，图片大小尽量压缩到最小</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn btn-primary" id="btn-add">添加模板</div>
            </div>
        </div>
    </div>
</div>

<script type="text/html" id="tpl_editor">
    <div class="form-group">
        <div class="col-sm-2 control-label">邀请卡名称</div>
        <div class="col-sm-10">
            <?php if( ce('invitation' ,$item) ) { ?>
            <input class="form-control input-sm diy-bind" placeholder="请输入名称" value="<%title%>" data-bind="title" />
            <div class="help-block">提示：邀请卡名称将会显示在手机端，请规范填写</div>
            <?php  } else { ?>
            <div class='form-control-static'><%title%></div>
            <?php  } ?>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">邀请卡类型</div>
        <div class="col-sm-10">
            <?php if( ce('invitation' ,$item) ) { ?>
            <label class="radio-inline"><input type="radio" name="type" value="0" class="diy-bind" data-bind="type" <%if type==0%>checked="checked"<%/if%>> 直播间</label>
            <?php  } else { ?>
            <div class='form-control-static'><%if type==0%>直播间<%/if%></div>
            <?php  } ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">邀请卡状态</div>
        <div class="col-sm-10">
            <?php if( ce('invitation' ,$item) ) { ?>
            <label class="radio-inline"><input type="radio" name="status" value="1" class="diy-bind" data-bind="status" <%if status==1%>checked="checked"<%/if%>> 启用</label>
            <label class="radio-inline"><input type="radio" name="status" value="0" class="diy-bind" data-bind="status" <%if status==0%>checked="checked"<%/if%>> 禁用</label>
            <?php  } else { ?>
            <div class='form-control-static'><%if status==1%>启用<%else if status==0%>禁用<%/if%></div>
            <?php  } ?>
        </div>
    </div>
    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">二维码类型</div>
        <div class="col-sm-10">
            <?php if( ce('invitation' ,$item) ) { ?>
            <label class="radio-inline"><input type="radio" name="qrcode" value="0" class="diy-bind" data-bind="qrcode" <%if qrcode==0%>checked="checked"<%/if%>> 普通二维码</label>
            <label class="radio-inline"><input type="radio" name="qrcode" value="1" class="diy-bind" data-bind="qrcode" <%if qrcode==1%>checked="checked"<%/if%>> 微信二维码</label>
            <div class="help-block" style="margin-top: 5px;">提示：普通二维码为网址链接，微信二维码是临时二维码</div>
            <?php  } else { ?>
            <div class='form-control-static'><%if qrcode==1%>微信二维码<%else if qrcode==0%>普通二维码<%/if%></div>
            <?php  } ?>
        </div>
    </div>
    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">系统模板</div>
        <div class="col-sm-10">
            <div class="temp-list temp-default">
                <%each templist as tempid%>
                    <div class="item <%if inArray(selected, tempid)%>selected<%/if%>" data-tempid="<%tempid%>">
                        <img src="../addons/ewei_shopv2/plugin/invitation/static/templist/image_<%tempid%>_nail.jpg" />
                    </div>
                <%/each%>
            </div>
            <div class="help-block">提示：点击<span class="underline">系统模板</span>或<span class="underline">自定义模板</span>可选择使用</div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">自定义模板</div>
        <div class="col-sm-10">
            <div class="temp-list temp-upload">
                <%each upload as item tempid%>
                    <div class="item <%if inArray(selected, tempid)%>selected<%/if%>" data-tempid="<%tempid%>">
                        <img src="<%imgsrc(item.nail)%>" />
                        <?php if( ce('invitation' ,$item) ) { ?>
                        <i class="icon icon-close" title="删除自定义模板"></i>
                        <?php  } ?>
                    </div>
                <%/each%>
                <?php if( ce('invitation' ,$item) ) { ?>
                <div class="item add"></div>
                <?php  } ?>
            </div>
        </div>
    </div>
    <div class="form-group" style="margin-top: 28px;">
        <div class="col-sm-2 control-label">已选择模板</div>
        <div class="col-sm-10">
            <div class="temp-list temp-selected" id="selectedList">
                <%each selected as tempid index%>
                    <div class="item <%if index==0%>selected<%/if%>" data-tempid="<%tempid%>">
                        <img src="<%getNail(tempid)%>" />
                        <?php if( ce('invitation' ,$item) ) { ?>
                        <i class="icon icon-close" title="移除选择"></i>
                        <?php  } ?>
                    </div>
                <%/each%>
            </div>
            <div class="help-block">提示：点击<span class="underline">已选择模板</span>可在左侧预览，拖动可排序</div>
        </div>
    </div>
    <?php if( ce('invitation' ,$item) ) { ?>
    <div class="form-group">
        <div class="col-sm-2 control-label"></div>
        <div class="col-sm-10">
            <div class="btn btn-primary" id="btn-save">保存</div>
        </div>
    </div>
    <?php  } ?>
</script>

<script type="text/html" id="tpl_show_live">
    <img class="headimg" src="../addons/ewei_shopv2/static/images/customer.jpg" />
    <img class="qrcode" src="../addons/ewei_shopv2/plugin/invitation/static/images/baidu.png" />

    <div class="nickname">王小花</div>
    <div class="sharetext">向你推荐了一个商城</div>
    <div class="cardtitle">XX商城 · 一个特好用的商城</div>
    <div class="cardname">如何做一个好的商城？</div>
    <div class="descname">商城简介</div>
    <div class="desctext">XX商城是一个XXX的商城，商城简介商城简介商城简介商城简介商城简介商城简介商城简介商城简介商城简介</div>
</script>
