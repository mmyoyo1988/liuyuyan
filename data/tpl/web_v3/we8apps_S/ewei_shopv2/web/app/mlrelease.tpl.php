<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<link href="../addons/ewei_shopv2/plugin/app/static/css/page.css?v=20170922" rel="stylesheet" type="text/css"/>

<style type="text/css">
    .jconfirm.jconfirm-white .jconfirm-box .buttons button {font-size: 12px; font-weight: normal;}
    .summary_lg {padding: 35px 30px;}
    .summary_lg p {font-size: 15px; line-height: 28px;}
</style>

<div class="page-header">
    当前位置：
    <span class="text-primary">发布与审核</span>
</div>

<div class="page-content">
    <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('app/_tab', TEMPLATE_INCLUDEPATH)) : (include template('app/_tab', TEMPLATE_INCLUDEPATH));?>

    <?php  if($error) { ?>
        <div class="page-tips">
            <p><?php  echo $error;?></p>
        </div>
    <?php  } else { ?>
        <?php  if(!$is_auth) { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="summary_box">
                        <div class="summary_title">
                            <span class="text-default title_inner">授权说明</span>
                        </div>
                        <div class="summary_lg">
                            <p>将微信小程序授权给系统，系统会自动帮你生成商城管理小程序，并提交到微信；你不需要做复杂操作，即可获得店铺的微信小程序。</p>
                            <p>如果你还没有注册微信小程序，<a href="https://mp.weixin.qq.com" target="_blank">点击此处注册</a>；注册成功后，再授权给系统即可</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="btn btn-primary" id="btn-auth" style="margin-bottom: 50px">授权微信小程序</div>
                </div>
            </div>
        <?php  } else { ?>
            <div class="alert alert-primary">
                <p><b>发布审核流程说明：</b></p>
                <!--p>*上传代码：任何状态都可上传代码，上传代码后可获取体验二维码</p-->
                <p>*提交审核：未提交或发布成功可提交审核，提交后系统将直接上传最新版代码并提交至微信审核，并获得体验二维码</p>
                <p>*重新审核：微信审核失败后，修改内容后可重新提交审核</p>
                <p>*域名设置：与授权系统不一致的域名需提交后到微信公众平台小程序后台重新设置下服务器域名</p>
                <p>*重新授权：由于授权有时效性，如需更新发布状态或提示重新授权，请再次授权后再操作！</p>
                <?php  if(!empty($release['tips'])) { ?><p style="color:#f00;font-size:22px;font-weight:bold">重要提示：<?php  echo $release['tips'];?></p><?php  } ?>
            </div>

            <div class="wxapp-detail">
                <div class="logo">
                    <img src="<?php  echo $release['thumb'];?>" onerror="this.src='../addons/ewei_shopv2/static/images/app.jpg'"  />
                </div>
                <div class="name"><?php echo empty($release['title'])? '未设置': $release['title']?></div>
                <div class="qrcode">
                    <?php  if($release['audit_status']==1) { ?>
                        <div class="layer">未提交</div>
                    <?php  } ?>
                    <img src="<?php echo ($release['audit_status']==1)? '../addons/ewei_shopv2/plugin/app/static/images/qrcode.png': $release['qrcode']?>" onerror="this.src='../addons/ewei_shopv2/static/images/nopic.png'" />
                    
                </div>
                <?php  if($release['audit_status']>1) { ?>
                    <div class="text-center">体验二维码(发布成功后将失效，<br>如提示无法获取小程序信息，请重新授权再扫码体验！)</div>
                <?php  } ?>
                <div class="line"></div>
                <div class="text">
                    <p>线上版本：<?php echo ($release['audit_status']==1 || empty($release['cur_ver']))? '未提交': $release['cur_ver']?><?php  if(!empty($release['version_id']) && $release['version_id']!=$release['cur_ver']) { ?> (提交版本: <?php  echo $release['version_id'];?>)<?php  } ?></p>
                    <p>审核状态：
                        <?php  if($release['audit_status']==1) { ?><span>未提交</span>
                        <?php  } else if($release['audit_status']==2) { ?><span class="text-warning">待提交审核</span>
                        <?php  } else if($release['audit_status']==3) { ?><span class="text-warning">审核中</span>
                        <?php  } else if($release['audit_status']==4) { ?><span class="text-success">审核成功</span>
                        <?php  } else if($release['audit_status']==5) { ?><span class="text-success">发布成功</span>
                        <?php  } else if($release['audit_status']==6) { ?><span class="text-danger">审核失败</span>
                        <?php  } ?>
                        <?php  if(!empty($release['last_ver']) && $release['version_id']!=$release['last_ver'] && $release['last_ver']!=$release['cur_ver']) { ?><span class="text-danger">（最新版本: <?php  echo $release['last_ver'];?>）</span><?php  } ?>
                    </p>
                    <p>提交时间：
                        <span <?php  if($release['audit_status']>1 && !empty($release['version_time'])) { ?>data-toggle="tooltip"
                        data-placement="top"
                        data-original-title="<?php  echo date('Y-m-d H:i', $release['version_time'])?>"<?php  } ?>><?php echo $release['audit_status']>1? date('Y-m-d', $release['version_time']): '未提交'?></span></p>
                    <p>授权状态：<?php echo $auth['ifreauth']==1?'<font color="red"></font>':'已授权'?> <span class="text-primary" id="btn-reauth">重新授权</span></p>
                </div>
                <?php  if($release['audit_status']==4) { ?>
                <div class="btn btn-primary btn-audit" data-action="audit" data-text="发布小程序">发布小程序</div>
                <div class="btn btn-default btn-audit" data-action="upload" data-text="重新提交审核">重新提交审核</div>
                <?php  } else if($release['audit_status']==1 || $release['audit_status']==0) { ?>
                <div class="btn btn-primary btn-audit" data-action="upload" data-text="上传代码">上传代码</div>
                <?php  } else if($release['audit_status']==2) { ?>
                    <div class="btn btn-primary btn-audit" data-action="upload" data-text="提交审核">提交审核</div>
                <?php  } else if($release['audit_status']==4 || $release['audit_status']==5 || $release['audit_status']==6) { ?>
                    <div class="btn btn-default btn-audit" data-action="upload" data-text="重新提交审核">重新提交审核</div>
                <?php  } ?>
                <?php  if($release['audit_status']==3) { ?>
                <div class="btn btn-default">腾讯审核中，请等待...</div>
                <?php  } ?>
                <?php  if($release['audit_status']==6) { ?>
                    <div class="line"></div>
                    <div class="reason"><span class="text-danger">失败原因：</span> <?php  echo $release['reason'];?></div>
                <?php  } ?>
            </div>
        <?php  } ?>
    <?php  } ?>

	 <!--<div  style="color:red;margin-top:-100px;font-size:18px;" class="btn btn-default"> 提示：3.8.5版本小程序无变动，无需重新提交发布</div>-->
	
	
</div>

<?php  if(!$error) { ?>
    <script type="text/javascript">
        $("#btn-auth").click(function () {
            authFun();
        });
        $("#btn-reauth").click(function () {
            tip.confirm('当前已授权，确认重新授权吗？', function () {
                authFun();
            })
        });
        $(".btn-audit").click(function () {
            var _this = $(this);
            if(_this.attr('stop')){
                return;
            }
            var text = _this.text();
            var action = _this.data('action');
            tip.confirm('确定要'+text+'吗？', function () {
                _this.text('操作中...').addClass('disabled').attr('stop', 1).siblings().addClass('disabled').attr('stop', 1);
                $.post(biz.url('app/mlrelease/audit'), {
                    action: action
                }, function (ret) {
                    if(ret.status!=1){
                        _this.removeAttr('stop').text(_this.data('text')).removeClass('disabled').siblings().removeClass('disabled').removeAttr('stop');
                        tip.msgbox.err(ret.result.message);
                        return;
                    }
                    tip.msgbox.suc('提交成功');
                    setTimeout(function () {
                        location.reload();
                    }, 500);
                }, 'json');
            });
        });
        function authFun() {
            var url = biz.url('app/mlrelease/auth');
            window.open(url);
            myrequire(['jquery.confirm'], function () {
                $.confirm({
                    title: '提示',
                    content: '请在新窗口中完成微信小程序授权',
                    confirmButtonClass: 'btn-primary',
                    cancelButtonClass: 'btn-default',
                    confirmButton: '已完成授权',
                    cancelButton: '授权失败请重试',
                    animation: 'top',
                    confirm: function () {
                        location.reload();
                    },
                    cancel: function () {
                        window.open(url);
                    }
                });
            });
        }
    </script>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
