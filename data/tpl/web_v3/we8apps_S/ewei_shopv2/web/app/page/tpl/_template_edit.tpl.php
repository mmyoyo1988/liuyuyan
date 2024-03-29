<?php defined('IN_IA') or exit('Access Denied');?><script type="text/html" id="edit-del">
    <!--<div class="btn-edit-del">-->
        <!--<div class="btn-edit">编辑</div>-->
        <!--<div class="btn-del">删除</div>-->
    <!--</div>-->
</script>

<script type="text/html" id="tpl_navs">

    <nav class="btn btn-link page-setup" data-id="page"><i class="fa fa-cog"></i> 页面设置</nav>
    <%if navpageType != 4%>
    <div class="btns-global">
        <div class="title" >全局</div>
        <%each global as nav %>
            <nav class="btn btn-link <%if nav.type==type%>special<%/if%>" data-id="<%nav.id%>"> <%nav.name%></nav>
        <%/each%>
    </div>
    <%/if%>
    <div class="btns-local">
        <div class="title">基础</div>
        <div style="<%if navpageType != 4%>border-left: 1px solid #ededed;<%/if%>padding-left: 24px;" id="">
            <%each basic as nav %>
                <nav class="btn btn-link <%if nav.type==type%>special<%/if%>" data-id="<%nav.id%>"> <%nav.name%></nav>
            <%/each%>
        </div>
    </div>
</script>

<script type="text/html" id="tpl_edit_page">
    <div class="form-group">
        <div class="col-sm-2 control-label">页面名称</div>
        <div class="col-sm-10">
            <input class="form-control input-sm diy-bind" data-bind="name" data-placeholder="请输入名称" placeholder="请输入名称" value="<%page.name%>" />
            <div class="help-block">注意：页面名称是便于后台查找。</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">页面标题</div>
        <div class="col-sm-10">
            <input class="form-control input-sm diy-bind" data-bind="title" data-placeholder="请输入标题" placeholder="请输入标题" value="<%page.title%>" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">页面介绍</div>
        <div class="col-sm-10">
            <textarea class="form-control richtext diy-bind" cols="70" rows="5" placeholder="请输入页面介绍" data-bind="desc" data-placeholder=""><%page.desc%></textarea>
        </div>
    </div>

    <div class="form-group" style="display: none">
        <div class="col-sm-2 control-label">封面图</div>
        <div class="col-sm-10">
            <div class="input-group">
                <input class="form-control input-sm diy-bind" data-bind="icon" data-placeholder="" placeholder="" value="<%page.icon%>" id="iconsrc" />
                <span data-input="#iconsrc" data-img="#iconimg" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
            </div>
            <div class="input-group " style="margin-top:.5em;">
                <img src="<%imgsrc page.icon%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png';" class="img-responsive img-thumbnail" width="150" id="iconimg">
                <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="$('#iconsrc').val('').trigger('change');$(this).prev().attr('src', '')">×</em>
            </div>
        </div>
    </div>

    <div class="form-group" style="<?php  if($_GPC['type']!=2) { ?>display: none;<?php  } ?>">
        <div class="col-sm-2 control-label">启动广告</div>
        <div class="col-sm-10">
            <select class="form-control input-sm diy-bind" data-bind="diyadv">
                <option value="0" <%if page.diyadv=='0'||!page.diyadv%>selected="selected"<%/if%>>不显示</option>
                <%each diyadvs as diyadv%>
                <option value="<%diyadv.id%>" <%if page.diyadv==diyadv.id%>selected="selected"<%/if%>><%diyadv.name%></option>
                <%/each%>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">页面背景</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind="background" value="<%page.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#f3f3f3">重置</span>
            </div>
        </div>
    </div>
    <%if !page.seckill %>
    <div class="form-group">
        <div class="col-sm-2 control-label">标题栏背景</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind="titlebarbg" value="<%page.titlebarbg%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
    </div>
    <%/if%>
    <div class="form-group">
        <div class="col-sm-2 control-label">标题栏文字</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="titlebarcolor" value="#000000" class="diy-bind" data-bind="titlebarcolor" <%if page.titlebarcolor=='#000000'||!page.titlebarcolor%>checked="checked"<%/if%> > 黑色</label>
            <label class="radio-inline"><input type="radio" name="titlebarcolor" value="#ffffff" class="diy-bind" data-bind="titlebarcolor" <%if page.titlebarcolor=='#ffffff'%>checked="checked"<%/if%> > 白色</label>
        </div>
    </div>
    <%if page.seckill%>
        <div class="form-group">
            <div class="col-sm-2 control-label">秒杀样式</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="seckillstyle" value="style1" class="diy-bind" data-bind="style"  data-bind-child="seckill"<%if page.seckill.style=='style1'%>checked="checked"<%/if%> > 样式一</label>
                <label class="radio-inline"><input type="radio" name="seckillstyle" value="style2" class="diy-bind" data-bind="style"   data-bind-child="seckill"<%if page.seckill.style=='style2'%>checked="checked"<%/if%> > 样式二</label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">秒杀风格颜色</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="seckillcolor" value="red" class="diy-bind" data-bind="color"  data-bind-child="seckill"  <%if page.seckill.color=='red'%>checked="checked"<%/if%> > 红</label>
                <label class="radio-inline"><input type="radio" name="seckillcolor" value="blue" class="diy-bind" data-bind="color"  data-bind-child="seckill" <%if page.seckill.color=='blue'%>checked="checked"<%/if%> > 蓝</label>
                <label class="radio-inline"><input type="radio" name="seckillcolor" value="purple" class="diy-bind" data-bind="color"  data-bind-child="seckill"  <%if page.seckill.color=='purple'%>checked="checked"<%/if%> > 紫</label>
                <label class="radio-inline"><input type="radio" name="seckillcolor" value="pink" class="diy-bind" data-bind="color"  data-bind-child="seckill"  <%if page.seckill.color=='pink'%>checked="checked"<%/if%> > 粉</label>
                <label class="radio-inline"><input type="radio" name="seckillcolor" value="orange" class="diy-bind" data-bind="color"  data-bind-child="seckill"  <%if page.seckill.color=='orange'%>checked="checked"<%/if%> > 橙</label>
            </div>
        </div>
    <%/if%>
</script>

<script type="text/html" id="tpl_edit_notice">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="color" value="<%style.color%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#666666">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">图标颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="iconcolor" value="<%style.iconcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#fd5454">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">公告图标</div>
        <div class="col-sm-10">
            <div class="input-group">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="iconurl" data-bind-init="true" value="<%params.iconurl%>" id="iconsrc" />
                <span data-input="#iconsrc" data-img="#iconimg" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
                <%if params.iconurl!='../addons/ewei_shopv2/static/images/hotdot.jpg'%>
                <span class="input-group-addon btn btn-default" onclick="$('#iconsrc').val('../addons/ewei_shopv2/static/images/hotdot.jpg').trigger('change');$(this).prev().attr('src', '../addons/ewei_shopv2/static/images/hotdot.jpg')">重置图片</span>
                <%/if%>
            </div>
            <div class="input-group " style="margin-top:.5em;">
                <img src="<%imgsrc params.iconurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" class="img-responsive img-thumbnail" width="150" id="iconimg">
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">滚动速度</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%params.speed%>" data-min="1" data-max="10"></div>
                <div class="col-sm-4 control-labe count"><span><%params.speed%></span>秒</div>
                <input class="diy-bind input" data-bind-child="params" data-bind="speed" value="<%params.speed%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">公告内容</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="noticedata" value="0" class="diy-bind" data-bind-child="params" data-bind="noticedata" data-bind-init="true" <%if params.noticedata=='0'%>checked="checked"<%/if%> > 读取商城公告</label>
            <label class="radio-inline"><input type="radio" name="noticedata" value="1" class="diy-bind" data-bind-child="params" data-bind="noticedata" data-bind-init="true" <%if params.noticedata=='1'%>checked="checked"<%/if%>> 手动填写</label>
        </div>
    </div>

    <%if params.noticedata=='1'%>
    <div class="form-items indent" data-min="1">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image drag-btn square">拖动排序</div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <span class="input-group-addon">标题</span>
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="title" placeholder="请输入公告标题" value="<%child.title%>" />
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链接地址" value="<%child.linkurl%>" readonly />
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#curl-<%itemid%>">选择链接</span>
                        <%if child.linkurl%>
                        <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#curl-<%itemid%>">清除链接</span>
                        <%/if%>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
    <%/if%>

    <%if params.noticedata=='0'%>
    <div class="form-group">
        <div class="col-sm-2 control-label">读取数量</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="noticenum" value="5" class="diy-bind" data-bind-child="params" data-bind="noticenum" <%if params.noticenum=='5'%>checked="checked"<%/if%> > 5条</label>
            <label class="radio-inline"><input type="radio" name="noticenum" value="10" class="diy-bind" data-bind-child="params" data-bind="noticenum" <%if params.noticenum=='10'%>checked="checked"<%/if%>> 10条</label>
            <label class="radio-inline"><input type="radio" name="noticenum" value="20" class="diy-bind" data-bind-child="params" data-bind="noticenum" <%if params.noticenum=='20'%>checked="checked"<%/if%>> 20条</label>
        </div>
    </div>
    <%/if%>
</script>

<script type="text/html" id="tpl_edit_title">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">清除</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="color" value="<%style.color%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#666666">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">标题文字</div>
        <div class="col-sm-10">
            <div class="input-group form-group" style="margin: 0;">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="title" data-placeholder="" placeholder="请输入标题" value="<%params.title%>" />
                <input class="diy-bind" type="hidden" data-bind-child="params" data-bind="icon" data-bind-init="true" value="<%params.icon%>" id="titleicon" />
                <span data-input="#titleicon" data-toggle="selectIcon3" class="input-group-addon btn btn-default">选择图标</span>
                <%if params.icon%>
                <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#titleicon">清除图标</span>
                <%/if%>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">标题链接</div>
        <div class="col-sm-10">
            <div class="input-group form-group" style="margin: 0;">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="link" data-bind-init="true" placeholder="请选择链接地址" value="<%params.link%>" id="titlelink" readonly />
                <span data-input="#titlelink" data-toggle="selectUrl" data-platform="wxapp" class="input-group-addon btn btn-default">选择链接</span>
                <%if params.link%>
                <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#titlelink">清除链接</span>
                <%/if%>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">对齐方向</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="textalign" value="left" class="diy-bind" data-bind-child="style" data-bind="textalign" data-bind-init="true" <%if style.textalign=='left'%>checked="checked"<%/if%> > 居左</label>
            <label class="radio-inline"><input type="radio" name="textalign" value="center" class="diy-bind" data-bind-child="style" data-bind="textalign" data-bind-init="true" <%if style.textalign=='center'%>checked="checked"<%/if%>> 居中</label>
            <label class="radio-inline"><input type="radio" name="textalign" value="right" class="diy-bind" data-bind-child="style" data-bind="textalign" data-bind-init="true" <%if style.textalign=='right'%>checked="checked"<%/if%>> 居右</label>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">文字大小</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.fontsize%>" data-min="9" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.fontsize%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="fontsize" value="<%style.fontsize%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">上下边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.paddingtop%>" data-min="1" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingtop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<%style.paddingtop%>" type="hidden" />
            </div>
        </div>
    </div>

    <%if style.textalign != 'center'%>
    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">左右边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.paddingleft%>" data-min="1" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingleft%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<%style.paddingleft%>" type="hidden" />
            </div>
        </div>
    </div>
    <%/if%>
</script>

<script type="text/html" id="tpl_edit_search">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#f1f1f2">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">输入框背景</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="inputbackground" value="<%style.inputbackground%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="color" value="<%style.color%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#999999">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">图标颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="iconcolor" value="<%style.iconcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#b4b4b4">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">提示文字</div>
        <div class="col-sm-10">
            <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="placeholder" data-placeholder="" placeholder="请输入提示文字(不填则不显示，最长20字)" value="<%params.placeholder%>" maxlength="20" />
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">上下边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.paddingtop%>" data-min="2" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingtop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<%style.paddingtop%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">左右边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.paddingleft%>" data-min="2" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingleft%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<%style.paddingleft%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">搜索框样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="searchstyle" value="" class="diy-bind" data-bind-child="style" data-bind="searchstyle" <%if style.searchstyle==''%>checked="checked"<%/if%> > 方形</label>
            <label class="radio-inline"><input type="radio" name="searchstyle" value="radius" class="diy-bind" data-bind-child="style" data-bind="searchstyle" <%if style.searchstyle=='radius'%>checked="checked"<%/if%>> 圆角</label>
            <label class="radio-inline"><input type="radio" name="searchstyle" value="round" class="diy-bind" data-bind-child="style" data-bind="searchstyle" <%if style.searchstyle=='round'%>checked="checked"<%/if%>> 圆弧</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">文字对齐</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="textalign" value="left" class="diy-bind" data-bind-child="style" data-bind="textalign" <%if style.textalign=='left'%>checked="checked"<%/if%> > 居左</label>
            <label class="radio-inline"><input type="radio" name="textalign" value="center" class="diy-bind" data-bind-child="style" data-bind="textalign" <%if style.textalign=='center'%>checked="checked"<%/if%>> 居中</label>
            <label class="radio-inline"><input type="radio" name="textalign" value="right" class="diy-bind" data-bind-child="style" data-bind="textalign" <%if style.textalign=='right'%>checked="checked"<%/if%>> 居右</label>
        </div>
    </div>
</script>

<script type="text/html" id="tpl_edit_fixedsearch">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#000000">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">透明度</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8 " data-value="<%style.opacity%>" data-min="0" data-max="10" data-decimal="10"></div>
                <div class="col-sm-4 control-labe count"><span><%style.opacity%></span>(最大是1)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="opacity" value="<%style.opacity%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">左侧按钮</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="leftnav" value="0" class="diy-bind" data-bind-child="params" data-bind="leftnav" data-bind-init="true" <%if params.leftnav=='0'||!params.leftnav%>checked="checked"<%/if%>> 不显示</label>
            <label class="radio-inline"><input type="radio" name="leftnav" value="1" class="diy-bind" data-bind-child="params" data-bind="leftnav" data-bind-init="true" <%if params.leftnav=='1'%>checked="checked"<%/if%> > 图标</label>
            <label class="radio-inline"><input type="radio" name="leftnav" value="2" class="diy-bind" data-bind-child="params" data-bind="leftnav" data-bind-init="true" <%if params.leftnav=='2'%>checked="checked"<%/if%> > 图片</label>
        </div>
    </div>

    <%if params.leftnav==1%>
    <div class="form-group">
        <div class="col-sm-2 control-label">图标设置</div>
        <div class="col-sm-7">
            <div class="input-group input-group-sm">
                <span class="form-control" style="line-height: 28px; text-align: center; width: 40px;"><i class="icox <%params.leftnavicon||'icon-shop'%>" id="showleftnavicon"></i></span>
                <span data-input="#leftnavicon" data-element="#showleftnavicon" data-toggle="selectIcon3" class="input-group-addon btn btn-default">选择图标</span>
                <input type="hidden" class="diy-bind" data-bind-child="params" data-bind="leftnavicon" value="<%params.leftnavicon%>" id="leftnavicon" />
                <div class="input-group-addon" style="border-left: 0; border-right: 0;">图标颜色</div>
                <input class="form-control color diy-bind" type="color" style="width: 80px;" data-bind-child="style" data-bind="leftnavcolor" value="<%style.leftnavcolor%>"  />
            </div>
        </div>
    </div>
    <%/if%>

    <%if params.leftnav==2%>
    <div class="form-group">
        <div class="col-sm-2 control-label">选择图片</div>
        <div class="col-sm-10">
            <div class="input-group">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="leftnavimg" value="<%params.leftnavimg%>" id="leftnavimg" />
                <span data-input="#leftnavimg" data-img="#showleftnavimg" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
            </div>
            <div class="input-group " style="margin-top:.5em;">
                <img src="<%imgsrc params.leftnavimg%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" class="img-responsive img-thumbnail" style="height: 50px; background: #eee;" id="showleftnavimg">
                <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="$('#leftnavimg').val('').trigger('change');$(this).prev().attr('src', '')">×</em>
            </div>
        </div>
    </div>
    <%/if%>

    <%if params.leftnav==1||params.leftnav==2%>
    <div class="form-group">
        <div class="col-sm-2 control-label">选择链接</div>
        <div class="col-sm-10">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="leftnavlink"  value="<%params.leftnavlink%>" id="leftnavlink" />
                <span data-input="#leftnavlink" data-toggle="selectUrl" data-platform="wxapp" class="input-group-addon btn btn-default">选择链接</span>
            </div>
        </div>
    </div>
    <%/if%>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">右侧按钮</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="rightnav" value="0" class="diy-bind" data-bind-child="params" data-bind="rightnav" data-bind-init="true" <%if params.rightnav=='0'||!params.rightnav%>checked="checked"<%/if%>> 不显示</label>
            <label class="radio-inline"><input type="radio" name="rightnav" value="1" class="diy-bind" data-bind-child="params" data-bind="rightnav" data-bind-init="true" <%if params.rightnav=='1'%>checked="checked"<%/if%> > 图标</label>
            <label class="radio-inline"><input type="radio" name="rightnav" value="2" class="diy-bind" data-bind-child="params" data-bind="rightnav" data-bind-init="true" <%if params.rightnav=='2'%>checked="checked"<%/if%> > 图片</label>
        </div>
    </div>

    <%if params.rightnav==1%>
    <div class="form-group">
        <div class="col-sm-2 control-label">选择图标</div>
        <div class="col-sm-7">
            <div class="input-group input-group-sm">
                <span class="form-control" style="line-height: 28px; text-align: center; width: 40px;"><i class="icox <%params.rightnavicon||'icon-shop'%>" id="showrightnavicon"></i></span>
                <span data-input="#rightnavicon" data-element="#showrightnavicon" data-toggle="selectIcon3" class="input-group-addon btn btn-default">选择图标</span>
                <input type="hidden" class="diy-bind" data-bind-child="params" data-bind="rightnavicon" value="<%params.rightnavicon%>" id="rightnavicon" />
                <div class="input-group-addon" style="border-left: 0; border-right: 0;">图标颜色</div>
                <input class="form-control color diy-bind" type="color" style="width: 80px;" data-bind-child="style" data-bind="rightnavcolor" value="<%style.rightnavcolor%>"  />
            </div>
        </div>
    </div>
    <%/if%>

    <%if params.rightnav==2%>
    <div class="form-group">
        <div class="col-sm-2 control-label">选择图片</div>
        <div class="col-sm-10">
            <div class="input-group">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="rightnavimg"  value="<%params.rightnavimg%>" id="rightnavimg" />
                <span data-input="#rightnavimg" data-img="#showrightnavimg" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
            </div>
            <div class="input-group " style="margin-top:.5em;">
                <img src="<%imgsrc params.rightnavimg%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" class="img-responsive img-thumbnail" style="height: 50px; background: #eee;" id="showrightnavimg">
                <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="$('#rightnavimg').val('').trigger('change');$(this).prev().attr('src', '')">×</em>
            </div>
        </div>
    </div>
    <%/if%>

    <%if params.rightnav==1||params.rightnav==2%>
    <%if params.rightnavclick=='0'||!params.rightnavclick%>
    <div class="form-group">
        <div class="col-sm-2 control-label">选择链接</div>
        <div class="col-sm-10">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="rightnavlink"  value="<%params.rightnavlink%>" id="rightnavlink" />
                <span data-input="#rightnavlink" data-toggle="selectUrl" data-platform="wxapp" class="input-group-addon btn btn-default">选择链接</span>
            </div>
        </div>
    </div>
    <%/if%>
    <%/if%>

    <div class="line"></div>
    <div class="form-group">
        <div class="col-sm-2 control-label">搜索框背景</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="searchbackground" value="<%style.searchbackground%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">搜索文字颜色</div>
        <div class="col-sm-10">
            <div class="input-group input-group-sm" style="width: 127px;">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="searchtextcolor" value="<%style.searchtextcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
            <div class="help-block">提示：此处是搜索文字颜色并不是提示文字颜色</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">搜索框样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="searchstyle" value="" class="diy-bind" data-bind-child="params" data-bind="searchstyle"<%if params.searchstyle==''||!params.searchstyle%>checked="checked"<%/if%>> 直角</label>
            <label class="radio-inline"><input type="radio" name="searchstyle" value="round" class="diy-bind" data-bind-child="params" data-bind="searchstyle"<%if params.searchstyle=='round'%>checked="checked"<%/if%> > 圆弧</label>
            <label class="radio-inline"><input type="radio" name="searchstyle" value="circle" class="diy-bind" data-bind-child="params" data-bind="searchstyle" <%if params.searchstyle=='circle'%>checked="checked"<%/if%> > 圆角</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">搜索提示文字</div>
        <div class="col-sm-10">
            <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="placeholder" value="<%params.placeholder%>" data-placeholder="请输入关键字进行搜索" placeholder="请输入关键字进行搜索" />
        </div>
    </div>
    <div class="alert alert-danger" style="margin-bottom: 0;">注意：由于搜索框固定在页面顶部，有可能遮挡底层元素，建议页面首个元素放置幻灯片等较高高度的元素。<br>如果您在本页面添加了顶部菜单，那么此搜索框会被隐藏。</div>
</script>

<script type="text/html" id="tpl_edit_line">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">线条颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="bordercolor" value="<%style.bordercolor%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#000000">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">线条样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="linestyle" value="solid" class="diy-bind" data-bind-child="style" data-bind="linestyle" <%if style.linestyle=='solid'%>checked="checked"<%/if%> > 实线</label>
            <label class="radio-inline"><input type="radio" name="linestyle" value="dashed" class="diy-bind" data-bind-child="style" data-bind="linestyle" <%if style.linestyle=='dashed'%>checked="checked"<%/if%>> 虚线(长方形)</label>
            <label class="radio-inline"><input type="radio" name="linestyle" value="dotted" class="diy-bind" data-bind-child="style" data-bind="linestyle" <%if style.linestyle=='dotted'%>checked="checked"<%/if%>> 虚线(正方形)</label>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">线条高度</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.height%>" data-min="1" data-max="20"></div>
                <div class="col-sm-4 control-labe count"><span><%style.height%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="height" value="<%style.height%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">上下边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.padding%>" data-min="1" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.padding%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="padding" value="<%style.padding%>" type="hidden" />
            </div>
        </div>
    </div>

</script>

<script type="text/html" id="tpl_edit_blank">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">清除</span>
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">元素高度</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.height%>" data-min="1" data-max="200"></div>
                <div class="col-sm-4 control-labe count"><span><%style.height%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="height" value="<%style.height%>" type="hidden" />
            </div>
        </div>
    </div>
</script>

<script type="text/html" id="tpl_edit_menu">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">按钮形状</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="navstyle" value="" class="diy-bind" data-bind-child="style" data-bind="navstyle" <%if style.navstyle==''%>checked="checked"<%/if%>> 正方形</label>
            <label class="radio-inline"><input type="radio" name="navstyle" value="radius" class="diy-bind" data-bind-child="style" data-bind="navstyle" <%if style.navstyle=='radius'%>checked="checked"<%/if%>> 圆角</label>
            <label class="radio-inline"><input type="radio" name="navstyle" value="circle" class="diy-bind" data-bind-child="style" data-bind="navstyle" <%if style.navstyle=='circle'%>checked="checked"<%/if%>> 圆形</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">显示方式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="showtype" value="0" class="diy-bind" data-bind-child="style" data-bind="showtype" data-bind-init="true" <%if style.showtype=='0'||!style.showtype%>checked="checked"<%/if%>>单页显示</label>
            <label class="radio-inline"><input type="radio" name="showtype" value="1" class="diy-bind" data-bind-child="style" data-bind="showtype" data-bind-init="true" <%if style.showtype=='1'%>checked="checked"<%/if%>> 多页滑动显示</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">每行数量</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="rownum" value="3" class="diy-bind" data-bind-child="style" data-bind="rownum" <%if style.rownum=='3'%>checked="checked"<%/if%>> 3个</label>
            <label class="radio-inline"><input type="radio" name="rownum" value="4" class="diy-bind" data-bind-child="style" data-bind="rownum" <%if style.rownum=='4'%>checked="checked"<%/if%>> 4个</label>
            <label class="radio-inline"><input type="radio" name="rownum" value="5" class="diy-bind" data-bind-child="style" data-bind="rownum" <%if style.rownum=='5'%>checked="checked"<%/if%>> 5个</label>
        </div>
    </div>

    <%if style.showtype>0%>
    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">每页数量</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.pagenum||8%>" data-min="3" data-max="20"></div>
                <div class="col-sm-4 control-labe count"><span><%style.pagenum||8%></span>个</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="pagenum" value="<%style.pagenum||8%>" type="hidden" />
            </div>
            <div class="help-block">超出设定数量自动分页</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">分页按钮</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="showdot" value="0" class="diy-bind" data-bind-child="style" data-bind="showdot" <%if style.showdot=='0'||!style.showdot%>checked="checked"<%/if%>> 隐藏</label>
            <label class="radio-inline"><input type="radio" name="showdot" value="1" class="diy-bind" data-bind-child="style" data-bind="showdot" <%if style.showdot=='1'%>checked="checked"<%/if%>> 显示</label>
        </div>
    </div>
    <%/if%>

    <div class="form-items" data-min="1">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image square">
                    <div class="text" data-toggle="selectImg" data-input="#cimg-<%itemid%>" data-img="#pimg-<%itemid%>">选择图片</div>
                    <img src="<%imgsrc child.imgurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" id="pimg-<%itemid%>" />
                    <input type="hidden" class="diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="imgurl"  id="cimg-<%itemid%>" value="<%child.imgurl%>" />
                </div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <span class="input-group-addon">文字</span>
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="text" placeholder="请选择图片或输入图片地址" value="<%child.text%>" style="width: 60%" />
                        <input class="form-control input-sm diy-bind color " data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="color" value="<%child.color%>" type="color" style="width: 40%" />
                        <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#666666">重置颜色</span>
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链接地址" value="<%child.linkurl%>" readonly />
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-type="menu" data-input="#curl-<%itemid%>">选择链接</span>
                        <%if child.linkurl%>
                        <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#curl-<%itemid%>">清除链接</span>
                        <%/if%>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>

<script type="text/html" id="tpl_edit_menu2">
    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
    </div>

    <div class="form-items indent" data-min="1" data-max="3">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-body">
                    <div class="item-image drag-btn square" style="height: 110px; line-height: 110px;">拖动排序</div>
                    <div class="item-form">
                        <div class="input-group" style="margin-bottom:0px; ">
                            <input class="diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="iconclass" value="<%child.iconclass%>" type="hidden" id="iconclass-<%itemid%>" data-bind-init="true" />
                            <span class="input-group-addon input-sm btn btn-default" style="line-height: 28px; padding: 0 16px;" data-toggle="selectIcon3" data-input="#iconclass-<%itemid%>" data-element="#iconshow-<%itemid%>">选择图标</span>
                            <span class="input-group-addon btn btn-default" style="border-left: 0; line-height: 28px; padding: 0 16px;" data-toggle="setNull" data-element="#iconclass-<%itemid%>">清除图标</span>
                            <span class="input-group-addon" style="border-left: 0; border-right: 0; padding: 0 12px;">图标颜色</span>
                            <input type="color" class="form-control input-sm diy-bind color" value="<%child.iconcolor%>" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="iconcolor" style="width: 105px;">
                        </div>
                        <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                            <span class="input-group-addon">文字</span>
                            <input type="text" class="form-control input-sm diy-bind" value="<%child.text%>" placeholder="留空则不显示" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="text" maxlength="20">
                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">文字颜色</span>
                            <input type="color" class="form-control input-sm diy-bind color" value="<%child.textcolor%>" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="textcolor" style="width: 107px;">
                        </div>
                        <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                            <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链接地址" value="<%child.linkurl%>" readonly>
                            <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#curl-<%itemid%>">选择链接</span>
                            <%if child.linkurl%>
                            <span class="input-group-addon btn btn-default" data-toggle="setNull" data-input="#curl-<%itemid%>">取消链接</span>
                            <%/if%>
                        </div>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>

<script type="text/html" id="tpl_edit_listmenu">
    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="restColor" data-color="#ffffff">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">图标颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="iconcolor" value="<%style.iconcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#999999">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#000000">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">提示文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="remarkcolor" value="<%style.remarkcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#888888">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-items indent" data-min="1" data-max="8">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-body">
                    <div class="item-image square">
                        <span class="btn-del" title="清空图标" onclick="$('#cicon-<%itemid%>').val('').trigger('change')"></span>
                        <div class="icon-main">
                            <span class="icox <%child.iconclass%>" id="picon-<%itemid%>"></span>
                        </div>
                        <div class="text" data-toggle="selectIcon3" data-input="#cicon-<%itemid%>" data-element="#picon-<%itemid%>">选择图标</div>
                        <input type="hidden" id="cicon-<%itemid%>" class="diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="iconclass" data-bind-init="true">
                    </div>
                    <div class="item-form">
                        <div class="input-group" style="margin-bottom:0px; ">
                            <span class="input-group-addon">文字</span>
                            <input type="text" class="form-control input-sm diy-bind" value="<%child.text%>" placeholder="留空则不显示" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="text" maxlength="20">
                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">提示</span>
                            <input type="text" class="form-control input-sm diy-bind" value="<%child.remark%>" placeholder="留空则不显示" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="remark" maxlength="6" style="width: 80px;">
                        </div>
                        <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                            <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链地址" value="<%child.linkurl%>" readonly />
                            <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#curl-<%itemid%>" data-type="listmenu">选择链接</span>
                            <%if child.linkurl%>
                            <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#curl-<%itemid%>">清除链接</span>
                            <%/if%>
                        </div>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
    <div class="alert alert-danger" style="margin: 10px 10px 0;">提示：如果链接目标功能未开启，系统会自动过滤不显示。</div>
</script>

<script type="text/html" id="tpl_edit_picture">
    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">上下边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.paddingtop%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingtop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<%style.paddingtop%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">左右边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.paddingleft%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingleft%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<%style.paddingleft%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
    </div>

    <div class="form-items indent" data-min="1">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image">
                    <img src="<%imgsrc child.imgurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" id="pimg-<%itemid%>" />
                </div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="imgurl"  id="cimg-<%itemid%>" placeholder="请选择图片或输入图片地址" value="<%child.imgurl%>" />
                        <span class="input-group-addon btn btn-default" data-toggle="selectImg" data-input="#cimg-<%itemid%>" data-img="#pimg-<%itemid%>">选择图片</span>
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链接地址" value="<%child.linkurl%>" readonly />
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#curl-<%itemid%>" data-type="picture">选择链接</span>
                        <%if child.linkurl%>
                        <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#curl-<%itemid%>">清除链接</span>
                        <%/if%>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>

<script type="text/html" id="tpl_edit_picturew">
    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">上下边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.paddingtop%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingtop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<%style.paddingtop%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">左右边距</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.paddingleft%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingleft%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<%style.paddingleft%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">布局方式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="row" value="2" class="diy-bind" data-bind-child="params" data-bind="row" data-bind-init="true" <%if params.row=='2'%>checked="checked"<%/if%>> 堆积两列</label>
            <label class="radio-inline"><input type="radio" name="row" value="1" class="diy-bind" data-bind-child="params" data-bind="row" data-bind-init="true" <%if params.row=='1'%>checked="checked"<%/if%>> 橱窗样式</label>
            <label class="radio-inline"><input type="radio" name="row" value="3" class="diy-bind" data-bind-child="params" data-bind="row" data-bind-init="true" <%if params.row=='3'%>checked="checked"<%/if%> > 堆积三列</label>
            <label class="radio-inline"><input type="radio" name="row" value="4" class="diy-bind" data-bind-child="params" data-bind="row" data-bind-init="true" <%if params.row=='4'%>checked="checked"<%/if%> > 堆积四列</label>
            <%if params.row==1%>
            <div class="help-block">橱窗样式布局请参考 <a href="<?php  echo webUrl('shop/cube')?>" target="_blank">首页魔方</a>，单组最多显示四个，超出隐藏</div>
            <%/if%>
            <%if params.row>1%>
            <div class="help-block">图片大小不限制，但请确保所有图片的尺寸/比例相同。</div>
            <%/if%>
        </div>
    </div>

    <div class="form-items indent" data-min="2" data-max="20">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image">
                    <img src="<%imgsrc child.imgurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" id="pimg-<%itemid%>" />
                </div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="imgurl"  id="cimg-<%itemid%>" placeholder="请选择图片或输入图片地址" value="<%child.imgurl%>" />
                        <span class="input-group-addon btn btn-default" data-toggle="selectImg" data-input="#cimg-<%itemid%>" data-img="#pimg-<%itemid%>">选择图片</span>
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链接地址" value="<%child.linkurl%>" readonly />
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#curl-<%itemid%>" data-type="picturew">选择链接</span>
                        <%if child.linkurl%>
                        <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#curl-<%itemid%>">清除链接</span>
                        <%/if%>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>

<script type="text/html" id="tpl_edit_banner">
    <div class="form-group">
        <div class="col-sm-2 control-label">按钮形状</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="dotstyle" value="rectangle" class="diy-bind" data-bind-child="style" data-bind="dotstyle" <%if style.dotstyle=='rectangle'%>checked="checked"<%/if%> > 长方形</label>
            <label class="radio-inline"><input type="radio" name="dotstyle" value="square" class="diy-bind" data-bind-child="style" data-bind="dotstyle" <%if style.dotstyle=='square'%>checked="checked"<%/if%>> 正方形</label>
            <label class="radio-inline"><input type="radio" name="dotstyle" value="round" class="diy-bind" data-bind-child="style" data-bind="dotstyle" <%if style.dotstyle=='round'%>checked="checked"<%/if%>> 圆形</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">按钮颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm" style="display: none;">
        <div class="col-sm-2 control-label">透明度</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8 " data-value="<%style.opacity%>" data-min="0" data-max="10" data-decimal="10"></div>
                <div class="col-sm-4 control-labe count"><span><%style.opacity%></span>(最大是1)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="opacity" value="<%style.opacity%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-items" data-min="1">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image">
                    <img src="<%imgsrc child.imgurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" id="pimg-<%itemid%>" />
                </div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="imgurl"  id="cimg-<%itemid%>" placeholder="请选择图片或输入图片地址" value="<%child.imgurl%>" />
                        <span class="input-group-addon btn btn-default" data-toggle="selectImg" data-input="#cimg-<%itemid%>" data-img="#pimg-<%itemid%>">选择图片</span>
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链地址" value="<%child.linkurl%>" readonly />
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#curl-<%itemid%>" data-type="banner">选择链接</span>
                        <%if child.linkurl%>
                        <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#curl-<%itemid%>">清除链接</span>
                        <%/if%>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>

<script type="text/html" id="tpl_edit_pictures">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">上下间距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.paddingtop%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingtop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<%style.paddingtop%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">左右间距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.paddingleft%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.paddingleft%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<%style.paddingleft%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">显示方式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="showtype" value="0" class="diy-bind" data-bind-child="params" data-bind="showtype" data-bind-init="true" <%if params.showtype=='0'||!params.showtype%>checked="checked"<%/if%>>单页显示</label>
            <label class="radio-inline"><input type="radio" name="showtype" value="1" class="diy-bind" data-bind-child="params" data-bind="showtype" data-bind-init="true" <%if params.showtype=='1'%>checked="checked"<%/if%>> 单行滑动模式</label>
        </div>
    </div>

    <%if params.showtype==1%>
    <div class="form-group" style="display: none;">
        <div class="col-sm-2 control-label">分页按钮</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="showbtn" value="0" class="diy-bind" data-bind-child="params" data-bind="showbtn" data-bind-init="true" <%if params.showbtn=='0'||!params.showbtn%>checked="checked"<%/if%>>隐藏</label>
            <label class="radio-inline"><input type="radio" name="showbtn" value="1" class="diy-bind" data-bind-child="params" data-bind="showbtn" data-bind-init="true" <%if params.showbtn=='1'%>checked="checked"<%/if%>> 显示</label>
        </div>
    </div>
    <%/if%>

    <div class="form-group">
        <div class="col-sm-2 control-label">每行数量</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="rownum" value="1" class="diy-bind" data-bind-child="params" data-bind="rownum" <%if params.rownum=='1'%>checked="checked"<%/if%>> 1个</label>
            <label class="radio-inline"><input type="radio" name="rownum" value="2" class="diy-bind" data-bind-child="params" data-bind="rownum" <%if params.rownum=='2'%>checked="checked"<%/if%>> 2个</label>
            <label class="radio-inline"><input type="radio" name="rownum" value="3" class="diy-bind" data-bind-child="params" data-bind="rownum" <%if params.rownum=='3'%>checked="checked"<%/if%>> 3个</label>
            <label class="radio-inline"><input type="radio" name="rownum" value="4" class="diy-bind" data-bind-child="params" data-bind="rownum" <%if params.rownum=='4'%>checked="checked"<%/if%>> 4个</label>
            <label class="radio-inline"><input type="radio" name="rownum" value="5" class="diy-bind" data-bind-child="params" data-bind="rownum" <%if params.rownum=='5'%>checked="checked"<%/if%>> 5个</label>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">上标题颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="titlecolor" value="<%style.titlecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">下标题颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">上标题对齐</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="titlealign" value="left" class="diy-bind" data-bind-child="style" data-bind="titlealign" <%if style.titlealign=='left'||!style.titlealign%>checked="checked"<%/if%>> 左对齐</label>
            <label class="radio-inline"><input type="radio" name="titlealign" value="center" class="diy-bind" data-bind-child="style" data-bind="titlealign" <%if style.titlealign=='center'%>checked="checked"<%/if%>> 居中显示</label>
            <label class="radio-inline"><input type="radio" name="titlealign" value="right" class="diy-bind" data-bind-child="style" data-bind="titlealign" <%if style.titlealign=='right'%>checked="checked"<%/if%>> 右对齐</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">下标题对齐</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="textalign" value="left" class="diy-bind" data-bind-child="style" data-bind="textalign" <%if style.textalign=='left'||!style.titlealign%>checked="checked"<%/if%>> 左对齐</label>
            <label class="radio-inline"><input type="radio" name="textalign" value="center" class="diy-bind" data-bind-child="style" data-bind="textalign" <%if style.textalign=='center'%>checked="checked"<%/if%>> 居中显示</label>
            <label class="radio-inline"><input type="radio" name="textalign" value="right" class="diy-bind" data-bind-child="style" data-bind="textalign" <%if style.textalign=='right'%>checked="checked"<%/if%>> 右对齐</label>
        </div>
    </div>

    <div class="form-items indent" data-min="1">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image" style="height: 110px;">
                    <img src="<%imgsrc child.imgurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" id="pimg-<%itemid%>" style="height: 100%; width: auto;" />
                </div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <span class="input-group-addon">上标题</span>
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="title" placeholder="请输入上标题" value="<%child.title%>" />
                        <span class="input-group-addon" style="border-right: 0; border-left: 0;">下标题</span>
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="text" placeholder="请输入下标题" value="<%child.text%>" />
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="imgurl"  id="cimg-<%itemid%>" placeholder="请选择图片或输入图片地址" value="<%child.imgurl%>" />
                        <span class="input-group-addon btn btn-default" data-toggle="selectImg" data-input="#cimg-<%itemid%>" data-img="#pimg-<%itemid%>">选择图片</span>
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链地址" value="<%child.linkurl%>" readonly />
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#curl-<%itemid%>">选择链接</span>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>

    <div class="alert alert-primary" style="margin-top: 10px; margin-bottom: 0;">注意：如果上标题 、下标题为空则不显示</div>
</script>

<script type="text/html" id="tpl_edit_icongroup">
    <div class="form-group">
        <div class="col-sm-2 control-label">每行数量</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="style" value="3" class="diy-bind" data-bind-child="params" data-bind="rownum" data-bind-init="true" <%if params.rownum=='3'%>checked="checked"<%/if%>> 3个</label>
            <label class="radio-inline"><input type="radio" name="style" value="4" class="diy-bind" data-bind-child="params" data-bind="rownum" data-bind-init="true" <%if params.rownum=='4' || params.style==''%>checked="checked"<%/if%>> 4个</label>
            <label class="radio-inline"><input type="radio" name="style" value="5" class="diy-bind" data-bind-child="params" data-bind="rownum" data-bind-init="true" <%if params.rownum=='5'%>checked="checked"<%/if%> > 5个</label>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">图标颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="iconcolor" value="<%style.iconcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#000000').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">角标背景</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="dotcolor" value="<%style.dotcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff5555').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-items indent" data-min="3" data-max="10">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-body">
                    <div class="item-image square">
                        <div class="icon-main">
                            <span class="icon <%child.iconclass%>" id="picon-<%itemid%>"></span>
                        </div>
                        <div class="text" data-toggle="selectIcon3" data-input="#cicon-<%itemid%>" data-element="#picon-<%itemid%>">选择图标</div>
                        <input type="hidden" id="cicon-<%itemid%>" class="diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="iconclass" data-bind-init="true">
                    </div>
                    <div class="item-form">
                        <div class="input-group" style="margin-bottom:0px; ">
                            <span class="input-group-addon">文字</span>
                            <input type="text" class="form-control input-sm diy-bind" value="<%child.text%>" placeholder="留空则不显示" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="text" maxlength="20">
                        </div>
                        <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                            <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链地址" value="<%child.linkurl%>" readonly />
                            <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#curl-<%itemid%>">选择链接</span>
                        </div>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
    <div class="alert alert-danger" style="margin: 10px 10px 0;">提示：选择链接后，系统会根据你选择的链接判断显示角标。</div>
</script>

<script type="text/html" id="tpl_edit_audio">

    <div class="form-group">
        <div class="col-sm-2 control-label">选择音频</div>
        <div class="col-sm-10">
            <div class="input-group input-group-sm">
                <input class="form-control diy-bind" name="" placeholder="请点击右侧按钮选择音频" value="<%params.audiourl%>" data-bind-child="params" data-bind="audiourl" id="audiourl" data-bind-init="true" />
                <span class="input-group-addon btn audio-player" style="border-left: 0;"><i class="fa fa-play"></i></span>
                <audio src="<%imgsrc params.audiourl%>"></audio>
                <span class="input-group-addon btn btn-default" data-toggle="selectAudio" data-input="#audiourl">选择音频</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">播放样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="playerstyle" value="0" class="diy-bind" data-bind-child="params" data-bind="playerstyle" data-bind-init="true" <%if params.playerstyle=='0'||!params.playerstyle%>checked="checked"<%/if%>> 样式一</label>
            <label class="radio-inline"><input type="radio" name="playerstyle" value="1" class="diy-bind" data-bind-child="params" data-bind="playerstyle" data-bind-init="true" <%if params.playerstyle=='1'%>checked="checked"<%/if%>> 样式二</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">标题文字</div>
        <div class="col-sm-10">
            <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="title" data-placeholder="" placeholder="请输入标题" value="<%params.title%>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">副标题</div>
        <div class="col-sm-10">
            <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="subtitle" data-placeholder="" placeholder="副标题，不填则不显示" value="<%params.subtitle%>" />
        </div>
    </div>
    <%if params.playerstyle==0%>
        <%if params.headtype==0||!params.headtype%>
        <div class="form-group">
            <div class="col-sm-2 control-label">选择图片</div>
            <div class="col-sm-10">
                <div class="input-group input-group-sm">
                    <input class="form-control diy-bind" placeholder="请点击右侧按钮选择图片" value="<%params.headurl%>" name="headurl" data-bind-child="params" data-bind="headurl" id="headurl" />
                    <span class="input-group-addon btn btn-default" data-toggle="selectImg" data-input="#headurl">选择图片</span>
                </div>
                <div class="help-block">提示：如果自定义头像为空则也将显示商城logo</div>
            </div>
        </div>
        <%/if%>
    <%/if%>

    <div class="line"></div>
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#f1f1f1').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <div class="col-sm-2 control-label">边框颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="bordercolor" value="<%style.bordercolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ededed').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">标题颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#333333').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">副标题颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="subtitlecolor" value="<%style.subtitlecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <%if params.playerstyle=='0'||!params.playerstyle%>
    <div class="form-group">
        <div class="col-sm-2 control-label">时间颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="timecolor" value="<%style.timecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <%/if%>

    <div class="line"></div>
    <div class="form-group" style="display: none;">
        <div class="col-sm-2 control-label">自动播放</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="autoplay" value="0" class="diy-bind" data-bind-child="params" data-bind="autoplay" <%if params.autoplay=='0'||!params.autoplay%>checked="checked"<%/if%>> 关闭</label>
            <label class="radio-inline"><input type="radio" name="autoplay" value="1" class="diy-bind" data-bind-child="params" data-bind="autoplay" <%if params.autoplay=='1'%>checked="checked"<%/if%>> 启用</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">循环播放</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="loopplay" value="0" class="diy-bind" data-bind-child="params" data-bind="loopplay" <%if params.loopplay=='0'||!params.loopplay%>checked="checked"<%/if%>> 关闭</label>
            <label class="radio-inline"><input type="radio" name="loopplay" value="1" class="diy-bind" data-bind-child="params" data-bind="loopplay" <%if params.loopplay=='1'%>checked="checked"<%/if%>> 启用</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">播放设置</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="pausestop" value="0" class="diy-bind" data-bind-child="params" data-bind="pausestop" <%if params.pausestop=='0'||!params.pausestop%>checked="checked"<%/if%>> 暂停后再恢复播放时，继续播放</label>
            <label class="radio-inline"><input type="radio" name="pausestop" value="1" class="diy-bind" data-bind-child="params" data-bind="pausestop" <%if params.pausestop=='1'%>checked="checked"<%/if%>> 暂停后再恢复播放时，从头播放</label>
        </div>
    </div>

    <div class="alert alert-primary" style="margin-bottom: 0;">提示：编辑页面播放只提供播放/停止功能，更多动画、功能请在手机端查看</div>

</script>

<script type="text/html" id="tpl_edit_coupon">
    <div class="form-group">
        <div class="col-sm-2 control-label">上下边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">左右边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.marginleft%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.marginleft%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="marginleft" value="<%style.marginleft%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">选择样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="couponstyle" value="2" class="diy-bind" data-bind-child="params" data-bind="couponstyle" data-bind-init="true" <%if params.couponstyle=='2'%>checked="checked"<%/if%>> 每行2个</label>
            <label class="radio-inline"><input type="radio" name="couponstyle" value="3" class="diy-bind" data-bind-child="params" data-bind="couponstyle" data-bind-init="true" <%if params.couponstyle=='3'%>checked="checked"<%/if%> > 每行3个</label>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-items indent" data-min="1">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image square drag-btn square" style="height: 110px; line-height: 110px;">拖动排序</div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <span class="input-group-addon">优惠券</span>
                        <input class="form-control input-sm diy-bind" value="<%child.name||'未设置'%>" readonly="readonly" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="price" />
                        <span class="input-group-addon btn btn-default coupon-selector">选择</span>
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px;">
                        <span class="input-group-addon">价值</span>
                        <input class="form-control input-sm diy-bind" value="<%child.price%>" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="price" readonly />
                        <span class="input-group-addon" style="border-left: 0; border-right: 0;">使用条件</span>
                        <input class="form-control input-sm diy-bind" value="<%child.desc%>" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="desc" readonly />
                    </div>
                    <div class="input-group " style="margin-top:10px; margin-bottom:0px; ">
                        <span class="input-group-addon">色调</span>
                        <span class="form-control input-sm" style="padding-top: 0;">
                            <label class="radio-inline">
                                <input type="radio" name="couponcolor-<%itemid%>" value="#55b5ff" class="diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="couponcolor" <%if child.couponcolor=='#55b5ff'||!child.couponcolor%>checked<%/if%>> 蓝</label>
                            <label class="radio-inline">
                                <input type="radio" name="couponcolor-<%itemid%>" value="#ff5555" class="diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="couponcolor" <%if child.couponcolor=='#ff5555'%>checked<%/if%>> 红</label>
                            <label class="radio-inline">
                                <input type="radio" name="couponcolor-<%itemid%>" value="#ff913f" class="diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="couponcolor" <%if child.couponcolor=='#ff913f'%>checked<%/if%>> 橙</label>
                            <label class="radio-inline">
                                <input type="radio" name="couponcolor-<%itemid%>" value="#fd72d4" class="diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="couponcolor" <%if child.couponcolor=='#fd72d4'%>checked<%/if%>> 粉</label>
                        </span>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>

<script type="text/html" id="tpl_edit_richtext">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ffffff">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group form-group-sm">
        <div class="col-sm-2 control-label">边距设置</div>
        <div class="col-sm-10">
            <div class="form-control-static">
                <div class="slider col-sm-8" data-value="<%style.padding%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.padding%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="padding" value="<%style.padding%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-richtext">
        <div id="rich"></div>
        <textarea id="richtext" class="diy-bind" data-bind-child="params" data-bind="content" style="display: none"></textarea>
    </div>
    <div class="alert alert-danger" style="margin-top: 10px; margin-bottom: 0;">注意：请勿将富文本里再填写JS代码块</div>
</script>

<script type="text/html" id="tpl_edit_goods">

    <ul class="nav nav-tabs">
        <li class="active"><a data-tab="goods">商品</a></li>
        <li><a data-tab="style">样式</a></li>
    </ul>

    <div class="tab-content" data-tab="goods" style="display: block;">
        <div class="form-group">
            <div class="col-sm-2 control-label">选择商品</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="goodsdata" value="0" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='0'%>checked="checked"<%/if%>> 手动选择</label>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="1" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='1'%>checked="checked"<%/if%> > 选择分类</label>
                <%if !params.goodstype||params.goodstype==0%>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="2" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='2'%>checked="checked"<%/if%> > 选择分组</label>
                <%/if%>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label">选择商品<br>(商品类型)</div>
            <div class="col-sm-10">
                <%if params.goodstype=='0'||!params.goodstype%>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="3" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='3'%>checked="checked"<%/if%> > 新品商品</label>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="4" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='4'%>checked="checked"<%/if%> > 热卖商品</label>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="6" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='6'%>checked="checked"<%/if%> > 促销商品</label>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="7" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='7'%>checked="checked"<%/if%> > 包邮商品</label>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="8" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='8'%>checked="checked"<%/if%> > 限时卖商品</label>
                <%/if%>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="5" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='5'%>checked="checked"<%/if%> > 推荐商品</label>
                <%if params.goodstype==1%>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="9" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='9'%>checked="checked"<%/if%> > 积分兑换商品</label>
                <label class="radio-inline"><input type="radio" name="goodsdata" value="10" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <%if params.goodsdata=='10'%>checked="checked"<%/if%> > 积分抽奖商品</label>
                <%/if%>
            </div>
        </div>

        <%if params.goodsdata=='0'%>
        <div class="form-items indent" data-min="1">
            <div class="inner" id="form-items">
                <%each data as child itemid %>
                <div class="item" data-id="<%itemid%>">
                    <span class="btn-del" title="删除"></span>
                    <div class="item-image square">
                        <div class="text goods-selector" data-goodstype="<%params.goodstype%>"  data-pagetype ="<%params.pagetype%>">选择商品</div>
                        <img src="<%imgsrc child.thumb%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" id="pimg-<%itemid%>" />
                        <input type="hidden" class="diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="imgurl"  id="cimg-<%itemid%>" value="<%child.imgurl%>" />
                    </div>
                    <div class="item-form">
                        <div class="input-group" style="margin-bottom:0px; ">
                            <span class="input-group-addon">名称</span>
                            <input class="form-control input-sm" value="<%child.title||'未设置'%>" readonly="readonly" />
                        </div>
                        <%if params.goodstype==0||!params.goodstype%>
                        <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                            <span class="input-group-addon">价格</span>
                            <input class="form-control input-sm" value="￥<%child.price%>" readonly="readonly" />
                        </div>
                        <%else%>
                        <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                            <span class="input-group-addon">价格</span>
                            <input class="form-control input-sm" value="<%child.price%>" readonly="readonly" />
                            <span class="input-group-addon" style="border-left: 0; border-right: 0;">元</span>
                            <input class="form-control input-sm" value="<%child.credit%>" readonly="readonly" />
                            <span class="input-group-addon">积分</span>
                        </div>
                        <%/if%>
                    </div>
                </div>
                <%/each%>
            </div>
            <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
        </div>
        <%/if%>

        <%if params.goodsdata=='1'%>
        <div class="form-group">
            <div class="col-sm-2 control-label">选择分类</div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="请点击选择分类" value="<%params.catename%>" readonly="readonly"/>
                    <span class="input-group-addon btn btn-default category-selector" data-goodstype="<%params.goodstype%>">选择分类</span>
                </div>
            </div>
        </div>
        <%/if%>

        <%if params.goodsdata=='2'%>
        <div class="form-group">
            <div class="col-sm-2 control-label">选择分组</div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input type="text" class="form-control input-sm" placeholder="请点击选择分组" value="<%params.groupname%>" readonly="readonly"/>
                    <span class="input-group-addon btn btn-default group-selector">选择分组</span>
                </div>
            </div>
        </div>
        <%/if%>

        <%if params.goodsdata>0%>
        <div class="form-group">
            <div class="col-sm-2 control-label">商品排序</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="goodssort" value="0" class="diy-bind" data-bind-child="params" data-bind="goodssort" <%if params.goodssort=='0'%>checked="checked"<%/if%>> 综合</label>
                <label class="radio-inline"><input type="radio" name="goodssort" value="1" class="diy-bind" data-bind-child="params" data-bind="goodssort" <%if params.goodssort=='1'%>checked="checked"<%/if%> > 按销量</label>
                <label class="radio-inline"><input type="radio" name="goodssort" value="2" class="diy-bind" data-bind-child="params" data-bind="goodssort" <%if params.goodssort=='2'%>checked="checked"<%/if%> > 价格降序</label>
                <label class="radio-inline"><input type="radio" name="goodssort" value="3" class="diy-bind" data-bind-child="params" data-bind="goodssort" <%if params.goodssort=='3'%>checked="checked"<%/if%> > 价格升序</label>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <div class="col-sm-2 control-label">显示数量</div>
            <div class="col-sm-10">
                <div class="form-control-static">
                    <div class="slider col-sm-8" data-value="<%params.goodsnum%>" data-min="1" data-max="20"></div>
                    <div class="col-sm-4 control-labe count"><span><%params.goodsnum%></span>个</div>
                    <input class="diy-bind input" data-bind-child="params" data-bind="goodsnum" value="<%params.goodsnum%>" type="hidden" />
                </div>
            </div>
        </div>
        <%/if%>
    </div>

    <div class="tab-content" data-tab="style">
        <div class="form-group">
            <div class="col-sm-2 control-label">背景颜色</div>
            <div class="col-sm-4">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                    <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#f3f3f3">重置</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label">显示类型</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="goodsscroll" value="0" class="diy-bind" data-bind-child="params" data-bind="goodsscroll" data-bind-init="true" <%if params.goodsscroll=='0'||!params.goodsscroll%>checked="checked"<%/if%>> 普通模式</label>
                <%if style.liststyle!=''%>
                <label class="radio-inline"><input type="radio" name="goodsscroll" value="1" class="diy-bind" data-bind-child="params" data-bind="goodsscroll" data-bind-init="true" <%if params.goodsscroll=='1'%>checked="checked"<%/if%> > 单行滑动模式</label>
                <%/if%>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label">列表样式</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="liststyle" value="block one" class="diy-bind" data-bind-child="style" data-bind="liststyle" data-bind-init="true" <%if style.liststyle=='block one'%>checked="checked"<%/if%> > 单列显示</label>
                <label class="radio-inline"><input type="radio" name="liststyle" value="block" class="diy-bind" data-bind-child="style" data-bind="liststyle" data-bind-init="true" <%if style.liststyle=='block'%>checked="checked"<%/if%>> 双列显示</label>
                <%if params.goodstype==0||!params.goodstype%>
                <label class="radio-inline"><input type="radio" name="liststyle" value="block three" class="diy-bind" data-bind-child="style" data-bind="liststyle" data-bind-init="true" <%if style.liststyle=='block three'%>checked="checked"<%/if%>> 三列显示</label>
                <%/if%>
                <%if params.goodsscroll=='0'||!params.goodsscroll%>
                <label class="radio-inline"><input type="radio" name="liststyle" value="" class="diy-bind" data-bind-child="style" data-bind="liststyle" data-bind-init="true" <%if style.liststyle==''%>checked="checked"<%/if%>> 列表显示</label>
                <%/if%>
                <%if style.liststyle=='block three' && params.goodstype!=1%>
                <div class="help-block text-danger">提示："三列显示商品"显示商品原价及销量可能会造成样式错乱</div>
                <%/if%>
            </div>
        </div>

        <div class="line"></div>

        <div class="form-group">
            <div class="col-sm-2 control-label">商品名称</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="showtitle" value="0" class="diy-bind" data-bind-child="params" data-bind="showtitle" <%if params.showtitle=='0'%>checked="checked"<%/if%>> 不显示</label>
                <label class="radio-inline"><input type="radio" name="showtitle" value="1" class="diy-bind" data-bind-child="params" data-bind="showtitle" <%if params.showtitle=='1'%>checked="checked"<%/if%> > 显示</label>
            </div>
        </div>

        <%if params.showtitle=='1'%>
        <div class="form-group">
            <div class="col-sm-2 control-label">名称颜色</div>
            <div class="col-sm-4">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="titlecolor" value="<%style.titlecolor%>" type="color" />
                    <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#000000">重置</span>
                </div>
            </div>
        </div>
        <%/if%>

        <div class="form-group">
            <div class="col-sm-2 control-label">商品价格</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="showprice" value="0" class="diy-bind" data-bind-child="params" data-bind="showprice" data-bind-init="true" <%if params.showprice=='0'||!params.showprice%>checked="checked"<%/if%>> 不显示</label>
                <label class="radio-inline"><input type="radio" name="showprice" value="1" class="diy-bind" data-bind-child="params" data-bind="showprice" data-bind-init="true" <%if params.showprice=='1'%>checked="checked"<%/if%> > 显示</label>
            </div>
        </div>

        <%if params.showprice=='1'%>
        <div class="form-group">
            <div class="col-sm-2 control-label">价格颜色</div>
            <div class="col-sm-4">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="pricecolor" value="<%style.pricecolor%>" type="color" />
                    <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ff5555">重置</span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label">商品原价</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="showproductprice" value="0" class="diy-bind" data-bind-child="params" data-bind="showproductprice" data-bind-init="true" <%if params.showproductprice=='0'||!params.showproductprice%>checked="checked"<%/if%>> 不显示</label>
                <label class="radio-inline"><input type="radio" name="showproductprice" value="1" class="diy-bind" data-bind-child="params" data-bind="showproductprice" data-bind-init="true" <%if params.showproductprice=='1'%>checked="checked"<%/if%> > 显示</label>
            </div>
        </div>

        <%if params.showproductprice==1%>
        <div class="form-group">
            <div class="col-sm-2 control-label">原价颜色</div>
            <div class="col-sm-4">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="productpricecolor" value="<%style.productpricecolor%>" type="color" />
                    <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#999999">重置</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">原价文字</div>
            <div class="col-sm-10">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="productpricetext" value="<%params.productpricetext||'原价'%>" style="width: 128px;" />
                <div class="help-block">提示：建议在三字以内</div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">原价删除线</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="productpriceline" value="0" class="diy-bind" data-bind-child="params" data-bind="productpriceline" <%if params.productpriceline=='0'||!params.productpriceline%>checked="checked"<%/if%>> 不显示</label>
                <label class="radio-inline"><input type="radio" name="productpriceline" value="1" class="diy-bind" data-bind-child="params" data-bind="productpriceline" <%if params.productpriceline=='1'%>checked="checked"<%/if%> > 显示</label>
            </div>
        </div>
        <div class="line"></div>
        <%/if%>

        <div class="form-group">
            <div class="col-sm-2 control-label">商品销量</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="showsales" value="0" class="diy-bind" data-bind-child="params" data-bind="showsales" data-bind-init="true" <%if params.showsales=='0'||!params.showsales%>checked="checked"<%/if%>> 不显示</label>
                <label class="radio-inline"><input type="radio" name="showsales" value="1" class="diy-bind" data-bind-child="params" data-bind="showsales" data-bind-init="true" <%if params.showsales=='1'%>checked="checked"<%/if%> > 显示</label>
            </div>
        </div>

        <%if params.showsales==1%>
        <div class="form-group">
            <div class="col-sm-2 control-label">销量颜色</div>
            <div class="col-sm-4">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="salescolor" value="<%style.salescolor%>" type="color" />
                    <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#999999">重置</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2 control-label">销量文字</div>
            <div class="col-sm-10">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="salestext" value="<%params.salestext||'销量'%>" style="width: 128px;" />
                <div class="help-block">提示：建议在三字以内</div>
            </div>
        </div>
        <div class="line"></div>
        <%/if%>

        <div class="form-group">
            <div class="col-sm-2 control-label">购买按钮</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="buystyle" value="" class="diy-bind" data-bind-child="style" data-bind="buystyle" data-bind-init="true" <%if style.buystyle==''%>checked="checked"<%/if%> > 不显示</label>
                <label class="radio-inline"><input type="radio" name="buystyle" value="buybtn-1" class="diy-bind" data-bind-child="style" data-bind="buystyle" data-bind-init="true" <%if style.buystyle=='buybtn-1'%>checked="checked"<%/if%>> 样式一</label>
                <label class="radio-inline"><input type="radio" name="buystyle" value="buybtn-2" class="diy-bind" data-bind-child="style" data-bind="buystyle" data-bind-init="true" <%if style.buystyle=='buybtn-2'%>checked="checked"<%/if%>> 样式二</label>
                <label class="radio-inline"><input type="radio" name="buystyle" value="buybtn-3" class="diy-bind" data-bind-child="style" data-bind="buystyle" data-bind-init="true" <%if style.buystyle=='buybtn-3'%>checked="checked"<%/if%>> 样式三</label>
                <label class="radio-inline"><input type="radio" name="buystyle" value="buybtn-4" class="diy-bind" data-bind-child="style" data-bind="buystyle" data-bind-init="true" <%if style.buystyle=='buybtn-4'%>checked="checked"<%/if%>> 样式四</label>
                <label class="radio-inline"><input type="radio" name="buystyle" value="buybtn-5" class="diy-bind" data-bind-child="style" data-bind="buystyle" data-bind-init="true" <%if style.buystyle=='buybtn-5'%>checked="checked"<%/if%>> 样式五</label>
                <label class="radio-inline"><input type="radio" name="buystyle" value="buybtn-6" class="diy-bind" data-bind-child="style" data-bind="buystyle" data-bind-init="true" <%if style.buystyle=='buybtn-6'%>checked="checked"<%/if%>> 样式六</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label">按钮颜色</div>
            <div class="col-sm-10">
                <div class="input-group" style="width: 130px;">
                    <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="buybtncolor" value="<%style.buybtncolor%>" type="color" />
                    <span class="input-group-addon btn btn-default" data-toggle="resetColor" data-color="#ff5555">重置</span>
                </div>
            </div>
        </div>
        <%/if%>

        <div class="line"></div>

        <div class="form-group">
            <div class="col-sm-2 control-label">商品图标</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="showicon" value="0" class="diy-bind" data-bind-child="params" data-bind="showicon" data-bind-init="true" <%if params.showicon=='0'%>checked="checked"<%/if%>> 不显示</label>
                <label class="radio-inline"><input type="radio" name="showicon" value="1" class="diy-bind" data-bind-child="params" data-bind="showicon" data-bind-init="true" <%if params.showicon=='1'%>checked="checked"<%/if%> > 系统图标</label>
                <label class="radio-inline"><input type="radio" name="showicon" value="2" class="diy-bind" data-bind-child="params" data-bind="showicon" data-bind-init="true" <%if params.showicon=='2'%>checked="checked"<%/if%> > 自定义</label>
            </div>
        </div>

        <%if params.showicon=='1'%>

        <div class="form-group">
            <div class="col-sm-2 control-label">图标样式</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="goodsiconstyle" value="triangle" class="diy-bind" data-bind-child="style" data-bind="iconstyle" <%if style.iconstyle=='triangle'%>checked="checked"<%/if%>> 样式一</label>
                <label class="radio-inline"><input type="radio" name="goodsiconstyle" value="circle" class="diy-bind" data-bind-child="style" data-bind="iconstyle" <%if style.iconstyle=='circle'%>checked="checked"<%/if%>> 样式二</label>
                <label class="radio-inline"><input type="radio" name="goodsiconstyle" value="square" class="diy-bind" data-bind-child="style" data-bind="iconstyle" <%if style.iconstyle=='square'%>checked="checked"<%/if%>> 样式三</label>
                <label class="radio-inline"><input type="radio" name="goodsiconstyle" value="echelon" class="diy-bind" data-bind-child="style" data-bind="iconstyle" <%if style.iconstyle=='echelon'%>checked="checked"<%/if%>> 样式四</label>
                <label class="radio-inline"><input type="radio" name="goodsiconstyle" value="rectangle" class="diy-bind" data-bind-child="style" data-bind="iconstyle" <%if style.iconstyle=='rectangle'%>checked="checked"<%/if%>> 样式五</label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label">图标属性</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="goodsicon" value="recommand" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <%if style.goodsicon=='recommand'%>checked="checked"<%/if%>> 推荐</label>
                <label class="radio-inline"><input type="radio" name="goodsicon" value="hotsale" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <%if style.goodsicon=='hotsale'%>checked="checked"<%/if%>> 热销</label>
                <label class="radio-inline"><input type="radio" name="goodsicon" value="isnew" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <%if style.goodsicon=='isnew'%>checked="checked"<%/if%>> 新上</label>
                <label class="radio-inline"><input type="radio" name="goodsicon" value="sendfree" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <%if style.goodsicon=='sendfree'%>checked="checked"<%/if%>> 包邮</label>
                <label class="radio-inline"><input type="radio" name="goodsicon" value="istime" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <%if style.goodsicon=='istime'%>checked="checked"<%/if%>> 限时卖</label>
                <label class="radio-inline"><input type="radio" name="goodsicon" value="bigsale" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <%if style.goodsicon=='bigsale'%>checked="checked"<%/if%>> 促销</label>
            </div>
        </div>
        <%/if%>

        <%if params.showicon=='2'%>
        <div class="form-group">
            <div class="col-sm-2 control-label">自定义图标</div>
            <div class="col-sm-10">
                <div class="input-group">
                    <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="goodsiconsrc" placeholder="请输入图片地址或选择图片" value="<%params.goodsiconsrc%>" id="goodsiconsrc" />
                    <span data-input="#goodsiconsrc" data-img="#goodsicon" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
                </div>
                <div class="input-group " style="margin-top:.5em;">
                    <img src="<%imgsrc params.goodsiconsrc%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" class="img-responsive img-thumbnail" id="goodsicon" style="width: 60px; height: 60px;">
                    <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="$('#goodsiconsrc').val('').trigger('change');$(this).prev().attr('src', '')">×</em>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-2 control-label">图标位置</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="iconposition" value="left top" class="diy-bind" data-bind-child="params" data-bind="iconposition" data-bind-init="true" <%if params.iconposition=='left top'%>checked="checked"<%/if%>> 左上</label>
                <label class="radio-inline"><input type="radio" name="iconposition" value="right top" class="diy-bind" data-bind-child="params" data-bind="iconposition" data-bind-init="true" <%if params.iconposition=='right top'%>checked="checked"<%/if%> > 右上</label>
                <label class="radio-inline"><input type="radio" name="iconposition" value="left bottom" class="diy-bind" data-bind-child="params" data-bind="iconposition" data-bind-init="true" <%if params.iconposition=='left bottom'%>checked="checked"<%/if%> > 左下</label>
                <label class="radio-inline"><input type="radio" name="iconposition" value="right bottom" class="diy-bind" data-bind-child="params" data-bind="iconposition" data-bind-init="true" <%if params.iconposition=='right bottom'%>checked="checked"<%/if%> > 右下</label>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <div class="col-sm-2 control-label">上下偏移</div>
            <div class="col-sm-10">
                <div class="form-control-static">
                    <div class="slider col-sm-8" data-value="<%style.iconpaddingtop%>" data-min="0" data-max="30"></div>
                    <div class="col-sm-4 control-labe count"><span><%style.iconpaddingtop%></span>px(像素)</div>
                    <input class="diy-bind input" data-bind-child="style" data-bind="iconpaddingtop" value="<%style.iconpaddingtop%>" type="hidden" />
                </div>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <div class="col-sm-2 control-label">左右偏移</div>
            <div class="col-sm-10">
                <div class="form-control-static">
                    <div class="slider col-sm-8" data-value="<%style.iconpaddingleft%>" data-min="0" data-max="30"></div>
                    <div class="col-sm-4 control-labe count"><span><%style.iconpaddingleft%></span>px(像素)</div>
                    <input class="diy-bind input" data-bind-child="style" data-bind="iconpaddingleft" value="<%style.iconpaddingleft%>" type="hidden" />
                </div>
            </div>
        </div>

        <div class="form-group form-group-sm">
            <div class="col-sm-2 control-label">图标缩放</div>
            <div class="col-sm-10">
                <div class="form-control-static">
                    <div class="slider col-sm-8" data-value="<%style.iconzoom%>" data-min="1" data-max="100"></div>
                    <div class="col-sm-4 control-labe count"><span><%style.iconzoom%></span>%</div>
                    <input class="diy-bind input" data-bind-child="style" data-bind="iconzoom" value="<%style.iconzoom%>" type="hidden" />
                </div>
            </div>
        </div>
        <%/if%>

        <div class="line"></div>

        <div class="form-group">
            <div class="col-sm-2 control-label">售罄图标</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="saleout" value="-1" class="diy-bind" data-bind-child="params" data-bind="saleout" data-bind-init="true" <%if params.saleout=='-1'%>checked="checked"<%/if%>> 不显示</label>
                <label class="radio-inline"><input type="radio" name="saleout" value="1" class="diy-bind" data-bind-child="params" data-bind="saleout" data-bind-init="true" <%if params.saleout=='1'%>checked="checked"<%/if%> > 内置图标</label>
                <label class="radio-inline"><input type="radio" name="saleout" value="0" class="diy-bind" data-bind-child="params" data-bind="saleout" data-bind-init="true" <%if params.saleout=='0'||!params.saleout%>checked="checked"<%/if%> > 读取系统设置</label>
            </div>
        </div>
        <%if params.saleout==1%>
        <div class="form-group">
            <div class="col-sm-2 control-label">图标样式</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="saleoutstyle" value="1" class="diy-bind" data-bind-child="style" data-bind="saleoutstyle" data-bind-init="true" <%if style.saleoutstyle=='1'%>checked="checked"<%/if%>> 样式一</label>
                <label class="radio-inline"><input type="radio" name="saleoutstyle" value="2" class="diy-bind" data-bind-child="style" data-bind="saleoutstyle" data-bind-init="true" <%if style.saleoutstyle=='2'%>checked="checked"<%/if%>> 样式二</label>
                <label class="radio-inline"><input type="radio" name="saleoutstyle" value="3" class="diy-bind" data-bind-child="style" data-bind="saleoutstyle" data-bind-init="true" <%if style.saleoutstyle=='3'%>checked="checked"<%/if%>> 样式三</label>
            </div>
        </div>
        <%/if%>
    </div>
</script>

<script type="text/html" id="tpl_edit_video">
    <div class="form-group">
        <div class="col-sm-2 control-label">视频样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="ratio" value="0" class="diy-bind" data-bind-child="style" data-bind="ratio" data-bind-init="true" <%if style.ratio=='0'%>checked="checked"<%/if%>> 16:9</label>
            <label class="radio-inline"><input type="radio" name="ratio" value="1" class="diy-bind" data-bind-child="style" data-bind="ratio" data-bind-init="true" <%if style.ratio=='1'%>checked="checked"<%/if%>> 4:3</label>
            <label class="radio-inline"><input type="radio" name="ratio" value="2" class="diy-bind" data-bind-child="style" data-bind="ratio" data-bind-init="true" <%if style.ratio=='2'%>checked="checked"<%/if%>> 1:1</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">视频封面</div>
        <div class="col-sm-10">
            <div class="input-group">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="poster" data-bind-init="true" value="<%params.poster%>" id="poster" placeholder="请选择图片或输入图片地址" />
                <span data-input="#poster" data-img="#showposter" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
            </div>
            <div class="input-group " style="margin-top:.5em;">
                <img src="<%imgsrc params.poster%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" class="img-responsive img-thumbnail" width="150" id="showposter">
            </div>
            <div class="form-control-static">请上传<%if style.ratio=='0'%>16:9<%/if%><%if style.ratio=='1'%>4:3<%/if%><%if style.ratio=='2'%>1:1<%/if%>比例的图片</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">选择视频</div>
        <div class="col-sm-10">
            <div class="input-group">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="videourl" data-bind-init="true" value="<%params.videourl%>" data-url="<%imgsrc params.videourl%>" id="videourl" placeholder="请选择视频或输入视频地址" />
                <span data-input="#videourl" data-img="#showvideo" data-toggle="selectVideo" data-network="true" class="input-group-addon btn btn-default">选择视频</span>
            </div>
            <% if params.videourl%>
                <div class="input-group">
                    <div class="multi-item" style="display: block" title="预览视频" data-toggle="previewVideo" data-input="#videourl">
                        <div class="img-responsive img-thumbnail img-video" style="width: 100px; height: 100px; position: relative; text-align: center; cursor: pointer;" src="">
                            <i class="fa fa-play-circle" style="font-size: 60px; line-height: 90px; color: #999;"></i>
                        </div>
                        <em class="close" title="移除视频" data-toggle="setNull" data-element="#videourl">×</em>
                    </div>
                </div>
            <%/if%>
        </div>
    </div>
</script>

<script type="text/html" id="tpl_edit_copyright"><div class="form-group">

    <div class="form-group">
        <div class="col-sm-2 control-label">选择样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="ratio" value="0" class="diy-bind" data-bind-child="style" data-bind="showtype" data-bind-init="false" <%if style.showtype =='0'%>checked="checked"<%/if%>> 样式一</label>
            <label class="radio-inline"><input type="radio" name="ratio" value="1" class="diy-bind" data-bind-child="style" data-bind="showtype" data-bind-init="false" <%if style.showtype !='0'%>checked="checked"<%/if%> > 样式二</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">填写内容</div>
        <div class="col-sm-10">
            <input class="form-control input-sm diy-bind" maxlength="40" data-bind="copyright" data-bind-child="params" value="<%params.copyright%>" style="border: 1px solid #ededed;"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label"></div>
        <div class="col-sm-10">
            <div style="font-size: 10px;color: #999;">版权内容最长可填写40个字符</div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">启用logo</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="showimg" value="1" class="diy-bind" data-bind-child="params" data-bind="showimg" data-bind-init="true" <%if params.showimg=='1'%>checked="checked"<%/if%>> 是</label>
            <label class="radio-inline"><input type="radio" name="showimg" value="0" class="diy-bind" data-bind-child="params" data-bind="showimg" data-bind-init="true" <%if params.showimg !='1'%>checked="checked"<%/if%> > 否</label>
        </div>
    </div>
    <%if params.showimg =='1'%>
    <div class="form-group">
        <div class="col-sm-2 control-label">上传logo</div>
        <div class="col-sm-10">
            <div class="input-group">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="imgurl" value="<%params.imgurl%>" id="imgurl" />
                <span data-input="#imgurl" data-img="#showimgurl" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
            </div>
            <div style="width: 100px;height: 100px;border: 1px solid #ededed; text-align: center;padding-top:9px;margin-top: 20px;">
                <img src="<%imgsrc params.imgurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" id="showimgurl" style="width: 80px;height: 80px;"/>
            </div>
            <div style="font-size: 10px;color: #999;line-height: 24px;">建议尺寸80px*80px</div>
        </div>
    </div>
    <%/if%>

</script>

<!--会员中心-->
<script type="text/html" id="tpl_edit_member">
    <div class="form-group">
        <div class="col-sm-2 control-label">样式选择</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="style" value="default1" class="diy-bind" data-bind-child="params" data-bind="style" data-bind-init="true" <%if params.style=='default1' || params.style==''%>checked="checked"<%/if%>> 样式一</label>
            <label class="radio-inline"><input type="radio" name="style" value="default2" class="diy-bind" data-bind-child="params" data-bind="style" data-bind-init="true" <%if params.style=='default2'%>checked="checked"<%/if%> > 样式二</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fe5455').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">高亮颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textlight" value="<%style.textlight%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fef31f').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">头像样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="headstyle" value="" class="diy-bind" data-bind-child="style" data-bind="headstyle" data-bind-init="true" <%if style.headstyle==''%>checked="checked"<%/if%>> 圆形</label>
            <label class="radio-inline"><input type="radio" name="headstyle" value="radius" class="diy-bind" data-bind-child="style" data-bind="headstyle" data-bind-init="true" <%if style.headstyle=='radius'%>checked="checked"<%/if%> > 圆角</label>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">等级说明链接</div>
        <div class="col-sm-10">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind" id="levellink" data-bind-child="params" data-bind="levellink" value="<%params.levellink%>" placeholder="等级说明链接, 不填则不跳转" />
                <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#levellink" data-type="levellink">选择链接</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <!--<div class="form-group">-->
        <!--<div class="col-sm-2 control-label">设置按钮</div>-->
        <!--<div class="col-sm-10">-->
            <!--<div class="input-group input-group-sm">-->
                <!--<span class="input-group-addon"><i class="icon <%params.seticon%>" id="seticonshow" style="line-height: 1;"></i></span>-->
                <!--<span class="form-control input-sm btn btn-default" data-toggle="selectIcon" data-input="#seticon" data-element="#seticonshow" style="line-height: 28px;">选择图标</span>-->
                <!--<input class="diy-bind" data-bind-child="params" data-bind="seticon" value="<%params.seticon%>" type="hidden" id="seticon" />-->
                <!--<span class="input-group-addon noblr">链接</span>-->
                <!--<input class="form-control input-sm diy-bind" id="setlink" data-bind-child="params" data-bind="setlink" value="<%params.setlink%>" placeholder="设置按钮链接" />-->
                <!--<span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#setlink">选择链接</span>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
    <%if params.style=='default1'%>
    <div class="form-group">
        <div class="col-sm-2 control-label">左侧按钮</div>
        <div class="col-sm-10">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">文字</span>
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="leftnav" value="<%params.leftnav%>" style="width: 70px;" maxlength="4" placeholder="最大四字" />
                <span class="input-group-addon noblr">链接</span>
                <input class="form-control input-sm diy-bind" id="leftnavlink" data-bind-child="params" data-bind="leftnavlink" value="<%params.leftnavlink%>" placeholder="左侧按钮链接" />
                <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#leftnavlink">选择链接</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">右侧按钮</div>
        <div class="col-sm-10">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">文字</span>
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="rightnav" value="<%params.rightnav%>" style="width: 70px;" maxlength="4" placeholder="最大四字" />
                <span class="input-group-addon noblr">链接</span>
                <input class="form-control input-sm diy-bind" id="rightnavlink" data-bind-child="params" data-bind="rightnavlink" value="<%params.rightnavlink%>" placeholder="右侧按钮链接" />
                <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#rightnavlink">选择链接</span>
            </div>
        </div>
    </div>
    <%/if%>

</script>



<script type="text/html" id="tpl_edit_bindmobile">
    <div class="form-group">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">标题颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="titlecolor" value="<%style.titlecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff0011').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#999999').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">图标设置</div>
        <div class="col-sm-10">
            <div class="input-group input-group-sm">
                <span class="input-group-addon" style="width: 50px;"><i class="icon <%params.iconclass%>" id="iconshow" style="line-height: 1;"></i></span>
                <span class="form-control input-sm btn btn-default" data-toggle="selectIcon" data-input="#iconclass" data-element="#iconshow" style="line-height: 28px; width: 70px;">选择图标</span>
                <span class="input-group-addon btn btn-default" onclick="$('#iconshow').attr('class', 'icon');$('#iconclass').val('').trigger('change');">清除图标</span>
                <input class="diy-bind" data-bind-child="params" data-bind="iconclass" value="" type="hidden" id="iconclass">
                <span class="input-group-addon noblr">颜色</span>
                <input class="form-control input-sm diy-bind" data-bind-child="style" data-bind="iconcolor" value="<%style.iconcolor%>" type="color" style="width: 95px;"/>
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff0011').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">标题文字</div>
        <div class="col-sm-10">
            <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="title" data-placeholder="绑定手机号" placeholder="请输入标题" value="<%params.title%>" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">介绍文字</div>
        <div class="col-sm-10">
            <textarea class="form-control richtext diy-bind" cols="70" rows="3" placeholder="请输入介绍文字" data-bind-child="params" data-bind="text" data-placeholder=""><%params.text%></textarea>
        </div>
    </div>
    <div class="alert alert-danger" style="margin: 10px 10px 0;">提示：此元素仅在开启wap功能并且用户未绑定手机时显示。</div>
</script>




<script type="text/html" id="tpl_edit_verify">

    <div class="form-group">
        <div class="col-sm-2 control-label">样式选择</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="style" value="" class="diy-bind" data-bind-child="params" data-bind="style" <%if params.style==''||!params.style%>checked<%/if%>> 样式一</label>
            <label class="radio-inline"><input type="radio" name="style" value="style2" class="diy-bind" data-bind-child="params" data-bind="style" <%if params.style=='style2'%>checked<%/if%>> 样式二</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">标题文字</div>
        <div class="col-sm-10">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind" style="width: 175px;" value="<%params.title%>" data-bind-child="params" data-bind="title" />
                <span class="input-group-addon" style="border-left: 0; border-right: 0;">提示文字</span>
                <input class="form-control input-sm diy-bind" style="width: 120px;" value="<%params.remark%>" data-bind-child="params" data-bind="remark" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">标题颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="titlecolor" value="<%style.titlecolor%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#333333').trigger('propertychange')">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">提示文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="remarkcolor" value="<%style.remarkcolor%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#888888').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">标题背景</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="titlebg" value="<%style.titlebg%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">整体背景</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
</script>
<!--小程序会员中心-->
<!--商品图-->
<script type="text/html" id="tpl_edit_detail_swipe">
    <div class="form-group">
        <div class="col-sm-2 control-label">按钮形状</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="dotstyle" value="rectangle" class="diy-bind" data-bind-child="style" data-bind="dotstyle" <%if style.dotstyle=='rectangle'%>checked="checked"<%/if%> > 长方形</label>
            <label class="radio-inline"><input type="radio" name="dotstyle" value="square" class="diy-bind" data-bind-child="style" data-bind="dotstyle" <%if style.dotstyle=='square'%>checked="checked"<%/if%>> 正方形</label>
            <label class="radio-inline"><input type="radio" name="dotstyle" value="round" class="diy-bind" data-bind-child="style" data-bind="dotstyle" <%if style.dotstyle=='round'%>checked="checked"<%/if%>> 圆形</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">按钮位置</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="dotalign" value="left" class="diy-bind" data-bind-child="style" data-bind="dotalign" <%if style.dotalign=='left'%>checked="checked"<%/if%> > 居左</label>
            <label class="radio-inline"><input type="radio" name="dotalign" value="center" class="diy-bind" data-bind-child="style" data-bind="dotalign" <%if style.dotalign=='center'%>checked="checked"<%/if%>> 居中</label>
            <label class="radio-inline"><input type="radio" name="dotalign" value="right" class="diy-bind" data-bind-child="style" data-bind="dotalign" <%if style.dotalign=='right'%>checked="checked"<%/if%>> 居右</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">按钮颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">左右边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.leftright%>" data-min="5" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.leftright%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="leftright" value="<%style.leftright%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">底部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.bottom%>" data-min="5" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.bottom%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="bottom" value="<%style.bottom%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">透明度</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8 " data-value="<%style.opacity%>" data-min="0" data-max="10" data-decimal="10"></div>
                <div class="col-sm-4 control-labe count"><span><%style.opacity%></span>(最大是1)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="opacity" value="<%style.opacity%>" type="hidden" />
            </div>
        </div>
    </div>
</script>
<!--商品信息-->
<script type="text/html" id="tpl_edit_detail_info">
    <div class="form-group">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">底部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.marginbottom%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.marginbottom%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="marginbottom" value="<%style.marginbottom%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="form-group">
        <div class="col-sm-2 control-label">标题颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="titlecolor" value="<%style.titlecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#000000').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">副标题颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="subtitlecolor" value="<%style.subtitlecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#999999').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">价格颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="pricecolor" value="<%style.pricecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff5555').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">副色调颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="form-group">
        <div class="col-sm-2 control-label">分享按钮</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="hideshare" value="0" class="diy-bind" data-bind-child="params" data-bind="hideshare" data-bind-init="true" <%if params.hideshare=='0' || !params.hideshare%>checked="checked"<%/if%> > 显示</label>
            <label class="radio-inline"><input type="radio" name="hideshare" value="1" class="diy-bind" data-bind-child="params" data-bind="hideshare" data-bind-init="true" <%if params.hideshare=='1'%>checked="checked"<%/if%>> 隐藏</label>
        </div>
    </div>
    <%if params.hideshare=='0'||!params.hideshare%>
    <div class="form-group">
        <div class="col-sm-2 control-label">自定义</div>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-addon">文字</span>
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="share" data-placeholder="分享" placeholder="分享" value="<%params.share%>" maxlength="2" style="width: 60px;" />
                <span class="input-group-addon" style="border-left: 0; border-right: 0">链接</span>
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="share_link" value="<%params.share_link%>" id="sharelink" />
                <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-input="#sharelink">选择</span>
            </div>
            <div class="input-group" style="margin-top: 10px; width: 150px;">
                <span class="input-group-addon">图标</span>
                <span class="input-group-addon"><i class="icon <%params.share_icon||'icon-share'%>" id="showshareicon"></i> </span>
                <input type="hidden" class="form-control input-sm diy-bind" data-bind-child="params" data-bind="share_icon" value="<%params.share_icon%>" id="shareicon" />
                <span class="input-group-addon btn btn-default" data-toggle="selectIcon" data-input="#shareicon" data-element="#showshareicon">选择</span>
            </div>
            <span class="help-block">提示: 链接不填则读取系统默认</span>
        </div>
    </div>
    <%/if%>
    <div class="line"></div>
    <div class="form-group">
        <div class="col-sm-2 control-label">限时购颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="timecolor" data-bind-init="true" value="<%style.timecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fff2e2').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">倒计时颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="timetextcolor" data-bind-init="true" value="<%style.timetextcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff8000').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    </div>
</script>
<!--营销信息-->
<script type="text/html" id="tpl_edit_detail_sale">
    <div class="form-group">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">底部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.marginbottom%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.marginbottom%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="marginbottom" value="<%style.marginbottom%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" data-bind-init="true" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">文字高亮</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolorhigh" data-bind-init="true" value="<%style.textcolorhigh%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ef4f4f').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
</script>
<!--商品规格-->
<script type="text/html" id="tpl_edit_detail_spec">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#333333').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">底部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.marginbottom%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.marginbottom%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="marginbottom" value="<%style.marginbottom%>" type="hidden" />
            </div>
        </div>
    </div>
</script>
<!--相关套餐-->
<script type="text/html" id="tpl_edit_detail_package">
    <div class="form-group">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">底部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.marginbottom%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.marginbottom%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="marginbottom" value="<%style.marginbottom%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">标题颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#000000').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
</script>
<!--店铺信息-->
<script type="text/html" id="tpl_edit_detail_shop">
    <div class="form-group">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">底部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.marginbottom%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.marginbottom%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="marginbottom" value="<%style.marginbottom%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">logo样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="logostyle" value="" class="diy-bind" data-bind-child="params" data-bind="logostyle" <%if params.logostyle=='0' || !params.logostyle%>checked="checked"<%/if%> > 正方形</label>
            <label class="radio-inline"><input type="radio" name="logostyle" value="radius" class="diy-bind" data-bind-child="params" data-bind="logostyle" <%if params.logostyle=='radius'%>checked="checked"<%/if%>> 圆角</label>
            <label class="radio-inline"><input type="radio" name="logostyle" value="circle" class="diy-bind" data-bind-child="params" data-bind="logostyle" <%if params.logostyle=='circle'%>checked="checked"<%/if%>> 圆形</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">名称颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="shopnamecolor" value="<%style.shopnamecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#000000').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">介绍颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="shopdesccolor" value="<%style.shopdesccolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">按钮颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="rightnavcolor" value="<%style.rightnavcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff5555').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="alert alert-danger" style="margin: 10px 10px 0;">提示：信息读取商城、商品设置</div>

</script>
<!--购买可见-->
<script type="text/html" id="tpl_edit_detail_buyshow">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">底部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.marginbottom%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.marginbottom%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="marginbottom" value="<%style.marginbottom%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="alert alert-primary" style="margin-bottom: 0;">提示：这里是购买可见区域，购买可见内容请到商品中设置</div>
</script>
<!--商品评价-->
<script type="text/html" id="tpl_edit_detail_comment">
    <div class="form-group">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">底部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.marginbottom%>" data-min="0" data-max="30"></div>
                <div class="col-sm-4 control-labe count"><span><%style.marginbottom%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="marginbottom" value="<%style.marginbottom%>" type="hidden" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">主色调</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="maincolor" value="<%style.maincolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff5555').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">副色调</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="subcolor" value="<%style.subcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#999999').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">评价颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
</script>
<!--底部导航-->
<script type="text/html" id="tpl_edit_detail_navbar">
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">图标颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="iconcolor" value="<%style.iconcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#999999').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<%style.textcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#999999').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">角标颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="dotcolor" value="<%style.dotcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff0011').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <%if params.hidecart=='0' || !params.showcart%>
    <div class="form-group">
        <div class="col-sm-2 control-label">购物车颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="cartcolor" value="<%style.cartcolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fe9402').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <%/if%>
    <div class="form-group">
        <div class="col-sm-2 control-label">购买按钮颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="buycolor" value="<%style.buycolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fd5555').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>


    <div class="form-group">
        <div class="col-sm-2 control-label">购物车按钮</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="hidecartbtn" value="0" class="diy-bind" data-bind-child="params" data-bind="hidecartbtn" data-bind-init="true" <%if params.hidecartbtn=='0' || !params.hidecartbtn%>checked="checked"<%/if%> > 显示</label>
            <label class="radio-inline"><input type="radio" name="hidecartbtn" value="1" class="diy-bind" data-bind-child="params" data-bind="hidecartbtn" data-bind-init="true" <%if params.hidecartbtn=='1'%>checked="checked"<%/if%>> 隐藏</label>
            <div class="help-block">提示：此设置仅针对于可加入购物车的商品</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">购买文字</div>
        <div class="col-sm-4">
            <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="textbuy" data-placeholder="立刻购买" placeholder="立刻购买" value="<%params.textbuy%>" maxlength="4" />
        </div>
    </div>

    <div class="alert alert-primary" style="margin-bottom: 0; margin-top: 10px;">提示：左侧图标最多输入3个字，购买按钮最多输入4个字</div>
</script>

<!--选项卡-->
<script type="text/html" id="tpl_edit_tabbar">
    <div class="form-group">
        <div class="col-sm-2 control-label">样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="ratio" value="1" class="diy-bind" data-bind-child="style" data-bind="showtype" data-bind-init="false" <%if style.showtype =='1'%>checked="checked"<%/if%>>样式一</label>
            <label class="radio-inline"><input type="radio" name="ratio" value="2" class="diy-bind" data-bind-child="style" data-bind="showtype" data-bind-init="false" <%if style.showtype =='2'%>checked="checked"<%/if%>>样式二</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="color" value="<%style.color%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">激活背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="activebackground" value="<%style.activebackground%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">激活文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="activecolor" value="<%style.activecolor%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ef4f4f').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="form-items indent" data-min="1" data-max="20">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image square drag-btn square" style="height: 70px; line-height: 70px;">拖动排序</div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <span class="input-group-addon">选项卡文字</span>
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="text" placeholder="请输入选项卡文字最大5字" value="<%child.text%>" maxlength="5" />
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" id="curl-<%itemid%>" placeholder="请选择数据" value="<%child.linkurl%>" readonly/>
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-input="#curl-<%itemid%>" data-type="topmenu_data" data-callback="callbackData">选择数据</span>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>

<!--顶部菜单-->
<script type="text/html" id="tpl_edit_topmenu">
    <div class="form-group">
        <div class="col-sm-2 control-label">样式</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="ratio" value="1" class="diy-bind" data-bind-child="style" data-bind="showtype" data-bind-init="false" <%if style.showtype =='1'%>checked="checked"<%/if%>>样式一</label>
            <label class="radio-inline"><input type="radio" name="ratio" value="2" class="diy-bind" data-bind-child="style" data-bind="showtype" data-bind-init="false" <%if style.showtype =='2'%>checked="checked"<%/if%>>样式二</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<%style.background%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="color" value="<%style.color%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">激活背景颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="activebackground" value="<%style.activebackground%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">重置</span>
            </div>
        </div>
        <div class="col-sm-2 control-label">激活文字颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="activecolor" value="<%style.activecolor%>" type="color">
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ef4f4f').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-items indent" data-min="1" data-max="20">
        <div class="inner" id="form-items">
            <%define index=0%>
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <%if index != 0 %>
                <span class="btn-del" title="删除"></span>
                <div class="item-image square drag-btn square" style="height: 70px; line-height: 70px;">拖动排序</div>
                <%/if%>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <span class="input-group-addon">文字</span>
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="text" placeholder="请输入选项卡文字最大5字" value="<%child.text%>" maxlength="5" />
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" id="curl-<%itemid%>" placeholder="<% if index != 0 %>请选择数据或选择链接地址<%else%>请选择数据<%/if%>" value="<%child.linkurl%>" readonly/>
                        <% if index != 0 %>
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-input="#curl-<%itemid%>"  data-platform="wxapp" data-type="topmenu">选择链接</span>
                        <%/if%>
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-input="#curl-<%itemid%>" data-type="topmenu_data" data-callback="callbackData">选择数据</span>
                    </div>
                </div>
            </div>
            <%define index++%>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>
<script type="text/html" id="tpl_edit_seckillgroup">
    <div class="form-group">
        <div class="col-sm-2 control-label">顶部边距</div>
        <div class="col-sm-10">
            <div class="form-group">
                <div class="slider col-sm-8" data-value="<%style.margintop%>" data-min="0" data-max="50"></div>
                <div class="col-sm-4 control-labe count"><span><%style.margintop%></span>px(像素)</div>
                <input class="diy-bind input" data-bind-child="style" data-bind="margintop" value="<%style.margintop%>" type="hidden" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">区域边框</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="hideborder" value="0" class="diy-bind" data-bind-child="params" data-bind="hideborder" <%if params.hideborder=='0' || !params.hideborder%>checked="checked"<%/if%> > 显示</label>
            <label class="radio-inline"><input type="radio" name="hideborder" value="1" class="diy-bind" data-bind-child="params" data-bind="hideborder" <%if params.hideborder=='1'%>checked="checked"<%/if%>> 隐藏</label>
            <div class="help-block">注意：边框颜色不可自定义，可根据样式需求选择是否显示</div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">标题颜色</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="seckillcolor" value="#ff3300" class="diy-bind" data-bind="titlecolor"  data-bind-child="style"  <%if style.titlecolor=='#ff3300'%>checked="checked"<%/if%> > 红</label>
            <label class="radio-inline"><input type="radio" name="seckillcolor" value="#4e87ee" class="diy-bind" data-bind="titlecolor"  data-bind-child="style" <%if style.titlecolor=='#4e87ee'%>checked="checked"<%/if%> > 蓝</label>
            <label class="radio-inline"><input type="radio" name="seckillcolor" value="#a839fa " class="diy-bind" data-bind="titlecolor"  data-bind-child="style" <%if style.titlecolor=='#a839fa '%>checked="checked"<%/if%> > 紫</label>
            <label class="radio-inline"><input type="radio" name="seckillcolor" value="#ff7e95" class="diy-bind" data-bind="titlecolor"  data-bind-child="style"  <%if style.titlecolorr=='#ff7e95'%>checked="checked"<%/if%> > 粉</label>
            <label class="radio-inline"><input type="radio" name="seckillcolor" value="#ff8c1e" class="diy-bind" data-bind="titlecolor"  data-bind-child="style"  <%if style.titlecolor=='#ff8c1e'%>checked="checked"<%/if%> > 橙</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">商品现价颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="marketpricecolor" value="<%style.marketpricecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ef4f4f').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">商品原价颜色</div>
        <div class="col-sm-4">
            <div class="input-group input-group-sm">
                <input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="productpricecolor" value="<%style.productpricecolor%>" type="color" />
                <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#999999').trigger('propertychange')">重置</span>
            </div>
        </div>
    </div>

    <div class="line"></div>

    <div class="form-group">
        <div class="col-sm-2 control-label">图标设置</div>
        <div class="col-sm-10">
            <div class="input-group">
                <input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="iconurl" value="<%params.iconurl%>" id="iconsrc" />
                <span data-input="#iconsrc" data-img="#iconimg" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
            </div>
            <div class="input-group " style="margin-top:.5em;">
                <img src="<%imgsrc params.iconurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" class="img-responsive img-thumbnail" id="iconimg" style="height: 30px; width: 90px;">
                <span class="close" style="position:absolute; top: -10px; right: -14px;" title="删除图片" onclick="$('#iconsrc').val('').trigger('change');$(this).prev().attr('src', '../addons/ewei_shopv2/static/images/hotdot.jpg')">×</span>
            </div>
            <div class="help-block">注意：推荐尺寸 20*100像素或同比例，不设置则不显示</div>
        </div>
    </div>

</script>
<script type="text/html" id="tpl_edit_seckill_times">

</script>

<script type="text/html" id="tpl_edit_seckill_rooms">

</script>

<script type="text/html" id="tpl_edit_seckill_advs">
    <div class="form-items" data-min="1">
        <div class="inner" id="form-items">
            <%each data as child itemid %>
            <div class="item" data-id="<%itemid%>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image">
                    <img src="<%imgsrc child.imgurl%>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.jpg';" id="pimg-<%itemid%>" />
                </div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="imgurl"  id="cimg-<%itemid%>" placeholder="请选择图片或输入图片地址" value="<%child.imgurl%>" />
                        <span class="input-group-addon btn btn-default" data-toggle="selectImg" data-input="#cimg-<%itemid%>" data-img="#pimg-<%itemid%>">选择图片</span>
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<%itemid%>" data-bind="linkurl" data-bind-init="true" id="curl-<%itemid%>" placeholder="请选择链地址" value="<%child.linkurl%>" readonly />
                        <span class="input-group-addon btn btn-default" data-toggle="selectUrl" data-platform="wxapp" data-input="#curl-<%itemid%>" data-type="seckill_advs">选择链接</span>
                        <%if child.linkurl%>
                        <span class="input-group-addon btn btn-default" data-toggle="setNull" data-element="#curl-<%itemid%>">清除链接</span>
                        <%/if%>
                    </div>
                </div>
            </div>
            <%/each%>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>

<script type="text/html" id="tpl_edit_seckill_list">

</script>
<script type="text/html" id="tpl_edit_detail_seckill">

    <div class="form-group">
        <div class="col-sm-2 control-label">颜色</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="detailseckillcolor" value="red" class="diy-bind" data-bind="theme"  data-bind-child="style"  <%if style.theme=='red'%>checked="checked"<%/if%> ><%style.bgleft%>红</label>
            <label class="radio-inline"><input type="radio" name="detailseckillcolor" value="blue" class="diy-bind" data-bind="theme"  data-bind-child="style" <%if style.theme=='blue'%>checked="checked"<%/if%> > 蓝</label>
            <label class="radio-inline"><input type="radio" name="detailseckillcolor" value="purple" class="diy-bind" data-bind="theme"  data-bind-child="style"  <%if style.theme=='purple'%>checked="checked"<%/if%> > 紫</label>
            <label class="radio-inline"><input type="radio" name="detailseckillcolor" value="pink" class="diy-bind" data-bind="theme"  data-bind-child="style"  <%if style.theme=='pink'%>checked="checked"<%/if%> > 粉</label>
            <label class="radio-inline"><input type="radio" name="detailseckillcolor" value="orange" class="diy-bind" data-bind="theme"  data-bind-child="style"  <%if style.theme=='orange'%>checked="checked"<%/if%> > 橙</label>
        </div>
    </div>

</script>