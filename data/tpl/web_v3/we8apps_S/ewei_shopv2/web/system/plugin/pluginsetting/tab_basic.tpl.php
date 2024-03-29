<?php defined('IN_IA') or exit('Access Denied');?><div class="alert alert-warning">
    注意：统一全选设置会在【<a href="<?php  echo webUrl('system/plugin/perm')?>" target="_blank">公众号权限</a>】开启之后，设置所有公众号的统一应用权限。如需单独设置，请到【<a href="<?php  echo webUrl('system/plugin/perm')?>" target="_blank">公众号权限</a>】单独设置。
</div>
<div class="form-group">
    <label class="col-lg control-label">应用统一权限设置</label>
    <div class="col-sm-9 col-xs-12">
        <div id="areas" class="form-control-static manage-plugin"><?php  echo $data['manage'];?></div>
        <a href="javascript:;" class="btn btn-default" onclick="selectPlugin()">选择应用</a>
        <input type="hidden" id='selectedcom' name="data[com]" value="<?php  echo $data['com'];?>" />
        <input type="hidden" id='selectedplugin' name="data[plugin]" value="<?php  echo $data['plugin'];?>" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg control-label">授权中心广告位</label>
    <div class="col-sm-9 col-xs-12">
        <?php  echo tpl_form_field_image2('data[adv]', $data['adv'])?>
        <span class='help-block'>建议尺寸:840*240</span>
    </div>
</div>
<div id="modal-plugin"  class="modal fade" tabindex="-1">
    <div class="modal-dialog" style='width: 920px;'>
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择组件/插件</h3></div>
            <div class="modal-body" style='height:280px;;' >

                <div class="form-group form-coms">
                    <label class="col-lg control-label">开放组件</label>
                    <div class="col-sm-9 col-xs-12">
                        <label class='checkbox-inline'>
                            <input type='checkbox' name='coms[]' class='com-all' value=''/> 全选
                        </label>
                        <br/>

                        <?php  if(is_array($coms)) { foreach($coms as $com) { ?>
                        <label class='checkbox-inline' style='margin:0;margin-right:5px;'>
                            <input type='checkbox' name='coms[]' class='com-item' value="<?php  echo $com['identity'];?>" com="<?php  echo $com['name'];?>" /> <?php  echo $com['name'];?>
                        </label>
                        <?php  } } ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>

                <div class="form-group form-plugins">
                    <label class="col-lg control-label">开放插件</label>
                    <div class="col-sm-9 col-xs-12">
                        <label class='checkbox-inline'>
                            <input type='checkbox' name='plugins[]' class='plugin-all' value=''/> 全选
                        </label>
                        <br/>

                        <?php  if(is_array($plugins)) { foreach($plugins as $plugin) { ?>
                        <label class='checkbox-inline' style='margin:0;margin-right:5px;'>
                            <input type='checkbox' name='plugins[]' class='plugin-item' value="<?php  echo $plugin['identity'];?>" plugin="<?php  echo $plugin['name'];?>" /> <?php  echo $plugin['name'];?>
                        </label>
                        <?php  } } ?>
                    </div>
                    <div style="clear:both;"></div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="javascript:;" id='btnSubmitPlugin' class="btn btn-success" data-dismiss="modal" aria-hidden="true">确定</a>
                <a href="javascript:;" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a>
            </div>
        </div>
    </div>
</div>
<script language='javascript'>
    require(['bootstrap'],function(){
        $('#myTab a').click(function (e) {
            e.preventDefault();
            $('#tab').val( $(this).attr('href').replace('#tab_',''));
            $(this).tab('show');
        })
    });
    $(function () {
        $('.plugin-item').click(function(){
            checkAll();
        });
        $('.com-item').click(function(){
            checkAllCom();
        });
        $('.plugin-all').click(function(){
            var check = $(this).get(0).checked;
            $('.plugin-item').each(function(){
                $(this).get(0).checked = check;
            });
        })

        $('.com-all').click(function(){
            var check = $(this).get(0).checked;
            $('.com-item').each(function(){
                $(this).get(0).checked = check;
            });
        })
        $('#btnSubmitPlugin').unbind('click').click(function(){
            var coms = '';
            var plugins = '';
            var com_identity = '';
            var plugin_identity = '';
            $('.com-item:checked').each(function(){
                coms+= $(this).attr('com') +";";
                com_identity+= $(this).val() +",";
            });
            $('.plugin-item:checked').each(function(){
                plugins+= $(this).attr('plugin') +";";
                plugin_identity+= $(this).val() +",";
            });
            $('.manage-plugin').html(coms+plugins);
            $("#selectedcom").val(com_identity);
            $("#selectedplugin").val(plugin_identity);
        })
    });

    function checkAll(obj){
        var allcheck = true;
        $('.plugin-item').each(function(){
            if(!$(this).get(0).checked){
                allcheck =false;
                return false;
            }
        });
        $(".plugin-all").get(0).checked = allcheck;
    }
    function checkAllCom(obj){
        var allcheck = true;
        $('.com-item').each(function(){
            if(!$(this).get(0).checked){
                allcheck =false;
                return false;
            }
        });
        $(".com-all").get(0).checked = allcheck;
    }
    function selectPlugin(){
        $("#modal-plugin").modal();
        var plugin_identity = $("#selectedplugin").val();
        var com_identity = $("#selectedcom").val();
        $('.plugin-item').each(function(){
            if(plugin_identity.indexOf($(this).val())!=-1){
                $(this).prop('checked',true)
            }else{
                $(this).prop('checked',false);
            }
        });
        $('.com-item').each(function(){
            if(com_identity.indexOf($(this).val())!=-1){
                $(this).prop('checked',true)
            }else{
                $(this).prop('checked',false);
            }
        });
    }
</script>
