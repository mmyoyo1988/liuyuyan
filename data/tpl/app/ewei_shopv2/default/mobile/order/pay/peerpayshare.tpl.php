<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style>
    .fui-content{background-color: #ededed}
</style>
<link rel="stylesheet" href="../addons/ewei_shopv2/static/js/app/biz/sale/peerpay.css?v=<?php  echo time();?>">
<div class="fui-page  fui-page-current">
    <?php  if(is_h5app()) { ?>
    <div class="fui-header">
        <div class="fui-header-left">
            <a class="back" data-nocache="true"></a>
        </div>
        <div class="title">找人代付</div>
        <div class="fui-header-right"></div>
    </div>
    <?php  } ?>
    <div class="fui-content">
        <div class="fui-payfor-header">
                <span class="fui-payfor-header-user">
                    <i class="fui-payfor-user"><img src="<?php  echo $member['avatar']?>" alt=""></i>
                </span>
            <div class="fui-payfor-header-title"><?php  echo $member['nickname'];?></div>
        </div>
        <div class="fui-payfor-speed">

            <div class="fui-list fui-payfor-speed-bot" style="padding:0.2rem 0;">
                <div class="fui-list-inner">已完成：<span class="price"><?php  echo $rate;?>%</span></div>
                <div class="fui-list-inner" style="text-align: right;">还差：<span class="price"><?php  echo $rate_price;?>元</span></div>
            </div>
            <div class="fui-payfor-speed-top">
                <i class="fui-payfor-speed-top-inner" style="width:<?php  echo $rate;?>%"></i>
            </div>
        </div>
        <a href="javascript:;" class="btn btn-danger" style="display: block;margin-top: 1.5rem" id="share" onclick="$('.alert-mask').show()">找小伙伴帮忙付款</a>
    </div>
</div>

<div class="alert-mask" style="position: absolute;background: rgba(0, 0, 0, 0.8) none repeat scroll 0 0;width: 100%;height: 100%;left: 0;top: 0;z-index: 1000;-moz-transition-duration: 400ms;-webkit-transition-duration: 400ms;transition-duration: 400ms;display: none" onclick="$('.alert-mask').hide()">
    <img src="../addons/ewei_shopv2/static/images/peerpayshare.png" alt="" width="100%" >
    <div style='font-family: "Microsoft YaHei UI", "微软雅黑", "宋体";color: #fff;text-align: center;'>快去找人帮你付款吧</div>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
