<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<link rel="stylesheet" href="../addons/ewei_shopv2/static/js/app/biz/sale/peerpay.css?v=<?php  echo time();?>">
<div class="fui-page  fui-page-current">
    <div class="fui-content">
        <div class="fui-list-group-title fui-payfor-group-title">来自<?php  echo $orderMember['nickname'];?>的代付订单</div>
        <?php  if(is_array($goods)) { foreach($goods as $goods) { ?>
        <div class="fui-list fui-payfor-list fui-payfor-peerpay" style="border-bottom: none">

            <div class="fui-list-media">
                <img src="<?php  echo tomedia($goods['thumb'])?>" alt="<?php  echo $goods['title'];?>">
            </div>
            <div class="fui-list-inner fui-payfor-info">
                <span class="fui-payfor-info-title"><?php  echo $goods['title'];?></span>
                <div class="fui-list" style="padding:0;">
                    <div class="fui-list-inner">
                        <?php  if(!empty($address)) { ?>
                        <span><?php  echo $address['realname'];?> &nbsp;<?php  echo substr_replace($address['mobile'],'****',-4)?></span>
                        <span><?php  echo $address['province'];?>  <?php  echo $address['city'];?>  <?php  echo $address['area'];?> ****</span>
                        <?php  } else { ?>
                        <span></span>
                        <span></span>
                        <?php  } ?>
                        <span class="fui-payfor-info-price">&yen;<?php  echo $goods['price'];?></span>
                    </div>
                    <div class="fui-list-media">
                        <a href="<?php  echo mobileUrl('goods/detail',array('id'=>$goods['id']))?>" class="btn btn-sm btn-default fui-payfor-btn">&nbsp;查看商品&nbsp;</a>
                    </div>
                </div>

            </div>

        </div>
        <?php  } } ?>
        <div class="fui-tab fui-tab-danger" id="tab-plus">
            <a href="javascript:void(0);" data-type="onepay" class="active">单人代付</a>
            <a href="javascript:void(0);" data-type="morepay">多人代付</a>
        </div>
        <div class="fui-tab-content">
            <div class="fui-tab-content-a active" id="onepay">
                <div class="fui-payfor-step">
                        <span>
                            <em><i>1</i></em>
                            <div>留言并分享</div>
                        </span>
                    <span>
                            <em><i>2</i></em>
                            <div>参与并付款</div>
                        </span>
                    <span>
                            <em><i>3</i></em>
                            <div>代付成功</div>
                        </span>
                </div>
            </div>
            <div class="fui-tab-content-a" id="morepay">
                <div class="fui-payfor-step">
                        <span>
                            <em><i>1</i></em>
                            <div>留言并分享</div>
                        </span>
                    <span>
                            <em><i>2</i></em>
                            <div>多人参与并付款</div>
                        </span>
                    <span>
                            <em><i>3</i></em>
                            <div>筹集完金额</div>
                        </span>
                    <span>
                            <em><i>4</i></em>
                            <div>代付成功</div>
                        </span>
                </div>
            </div>
            <div class="fui-text fui-cell-group">
                <div class="fui-cell">
                    <div class="fui-cell-info">
                        <textarea id="message" rows="4" placeholder="请输入简介" maxlength="140"><?php  echo $PeerPay['0'];?></textarea>
                    </div>
                </div>
            </div>
        </div>

            <a href="javascript:;" class="btn btn-danger" id="next" style="display: block;">下一步</a>
            <div style="width: 100%;text-align: center">
                <a href="<?php  echo mobileUrl('order/detail',array('id'=>$orderid))?>" class="order-detail">查看订单详情</a>
            </div>

            <div class="fui-text-footer">
                如15天内代付没凑齐，订单将被取消<br />
                所付款项将退还到付款人账户
            </div>

    </div>
</div>

<script>
    var subtype = 0;
    $(function(){
        var orderid = <?php  echo $orderid;?>;
        $("#tab-plus a").off("click").on("click",function(){
            var type = $(this).data("type");
            subtype = type == 'onepay' ? 0 : 1;
            if(!$(this).hasClass("active")){
                $("#tab-plus a").removeClass("active");
                $(this).addClass("active");
                $(".fui-tab-content-a").hide();
                $("#"+type+"").show();
            }
        });
        $("#next").click(function (e) {
            e.preventDefault();
            var textarea = $("#message").val();
            core.json('order/pay/peerpay', {type:subtype,message:textarea,id:orderid,}, function (data) {
                if (data.status=='1'){
                    location.href = data.result.url;
                    return;
                }else{
                    tip.msgbox.err('操作失败!');
                    location.reload();
                }
            }, true, true);
        });
    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>