<?php defined('IN_IA') or exit('Access Denied');?>		 
         <div class="form-group">
            <label class="col-lg control-label">优惠券发放通知（业务处理通知）</label>
            <div class="col-sm-9 col-xs-12">
				   <?php if(cv('sale.coupon.set')) { ?>
                <input type="text" name="data[templateid]" class="form-control" value="<?php  echo $data['templateid'];?>" />
                <div class="help-block">公众平台模板消息编号: OPENTM413117078 (同分销业务处理通知 一个模板id) </div>
				<div class="help-block">优惠券的发放或领取通知会优先使用客服消息发送图文消息，如果接收消息会员在４８小时没有互动，则使用模板消息,其他消息默认优先客服消息</div>
				<?php  } else { ?>
				 <div class='form-control-static'><?php  echo $data['templateid'];?></div>
				<?php  } ?>
            </div>
        </div>