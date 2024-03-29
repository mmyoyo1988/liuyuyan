<?php defined('IN_IA') or exit('Access Denied');?><style>
    .rec_reward_data{
        margin-right: 5px; width: 100%;text-align:left;
    }
    .sub_reward_data{
        margin-right: 5px; width: 50%;text-align:left;
    }
    #rec-rank .panel{
        width: 52%;
    }
</style>
<div class="alert alert-warning">任务推荐人数以累加计算，例如：达到1级（2人），再完成3人则达到2级（5人）</div>
<div class="form-group">
    <label class="col-lg control-label">推荐人奖励等级</label>
    <?php if(cv('task.edit')) { ?>
    <div class="col-sm-3 col-xs-12">
        <select class="input-sm form-control input-s-sm inline" id="select_rank"  onchange="select_rank_change(this);">
            <option value="0">奖励等级</option>
            <option value="1">一级奖励</option>
            <option value="2">二级奖励</option>
            <option value="3">三级奖励</option>
            <option value="4">四级奖励</option>
            <option value="5">五级奖励</option>
        </select>
    </div>
    <div class="col-sm-6 col-xs-12" id="rec_reward_people">
        <div class="row">
            <div class="col-sm-4 col-xs-4">
                <input type="number" class="form-control valid" name="peoplenum" placeholder="推广人数" aria-invalid="false">
            </div>
            <div class="col-sm-4 col-xs-4">
                <a class="btn btn-primary" onclick="addrecRewardrank();">添加/修改奖励等级</a>
            </div>
        </div>
    </div>
    <?php  } ?>
</div>
<div class="form-group">
    <label class="col-lg control-label">推荐人获得</label>
    <?php if(cv('task.edit')) { ?>
    <div class="col-sm-3 col-xs-12">
        <select class="input-sm form-control input-s-sm inline" data-type="1" id="rec_select" onchange="select_change(this);">
            <option value="0">奖励类型</option>
            <option value="1">积分</option>
            <option value="2">奖金</option>
            <option value="3">红包</option>
            <option value="4">指定价格的商品</option>
            <option value="5">优惠券</option>
        </select>
    </div>
    <div class="col-sm-6 col-xs-12" id="rec_reward_show">

    </div>
    <?php  } ?>
</div>
<?php if(cv('task.edit')) { ?>
<div class="form-group">
    <label class="col-lg control-label"></label>
    <div  class="col-sm-9 col-xs-12" id="rec-rank">
        <?php  if(!empty($rec_reward)) { ?>
        <?php  $count=1;?>
        <?php  if(is_array($rec_reward)) { foreach($rec_reward as $rank => $reward) { ?>
        <?php  if(!empty($reward)) { ?>
        <div class="panel <?php  if($count==1) { ?> panel-primary <?php  } else { ?> panel-default <?php  } ?> rec_rank" data-rank="<?php  echo $rank;?>" data-needcount="<?php  echo $reward['needcount'];?>" data-state="1" onclick="rankclick(this);">
            <div class="panel-heading">
                <?php  if($rank==1) { ?>一级奖励(<?php  echo $reward['needcount'];?>人)<?php  } ?><?php  if($rank==2) { ?>二级奖励(<?php  echo $reward['needcount'];?>人)<?php  } ?><?php  if($rank==3) { ?>三级奖励(<?php  echo $reward['needcount'];?>人)<?php  } ?><?php  if($rank==4) { ?>四级奖励(<?php  echo $reward['needcount'];?>人)<?php  } ?><?php  if($rank==5) { ?>五级奖励(<?php  echo $reward['needcount'];?>人)<?php  } ?>
                <span class="glyphicon glyphicon-remove pull-right" onclick="delrank(this);"></span>
            </div>
            <div class="panel-body" id="selected_rec_reward<?php  echo $rank;?>">
                <?php  if(is_array($reward)) { foreach($reward as $key => $rec) { ?>
                <?php  if($key=='credit') { ?>
                <?php  if($rec>0) { ?>
                <p><button  class="btn btn-success btn-xs rec_reward_data " id="rec_credit<?php  echo $rank;?>" type="button" data-rank="<?php  echo $rank;?>" data-type="1" data-value="<?php  echo $rec;?>">积分：<?php  echo $rec;?> <span class="badge pull-right" data-new="0" data-type="1" data-datatype="1" data-value="0" onclick="del_data_select(this);">x</span></button>
                </p>
                <?php  } ?>
                <?php  } else if($key=='money') { ?>
                <?php  if($rec['num']>0) { ?>
                <p><button  class="btn btn-success btn-xs rec_reward_data" id="rec_money<?php  echo $rank;?>" type="button" data-rank="<?php  echo $rank;?>" data-type="2" data-value="<?php  echo $rec['num'];?>" data-moneytype="<?php  echo $rec['type'];?>">奖金[<?php echo $rec['type']==0?'余额':'微信';?>]：<?php  echo $rec['num'];?>元 <span class="badge pull-right" data-new="0" data-type="1" data-datatype="2" data-value="0" onclick="del_data_select(this);">x</span></button>
                </p>
                <?php  } ?>
                <?php  } else if($key=='bribery') { ?>
                <?php  if($rec>0) { ?>
                <p><button  class="btn btn-success btn-xs rec_reward_data" id="rec_bribery<?php  echo $rank;?>" type="button" data-rank="<?php  echo $rank;?>" data-type="3" data-value="<?php  echo $rec;?>">红包：<?php  echo $rec;?>元 <span class="badge pull-right" data-new="0" data-type="1" data-datatype="3" data-value="0" onclick="del_data_select(this);">x</span></button>
                </p>
                <?php  } ?>
                <?php  } else if($key=='goods') { ?>
                <?php  if(!empty($rec)) { ?>
                <?php  if(is_array($rec)) { foreach($rec as $ke => $goods) { ?>
                <?php  if(empty($goods['spec'])) { ?>
                <p><button class="btn btn-success btn-xs rec_reward_data" id="rec_goods<?php  echo $rank;?>_<?php  echo $ke;?>_<?php  echo $specgoods['goods_spec'];?>" type="button" data-rank="<?php  echo $rank;?>" data-type="4" data-goodsid="<?php  echo $ke;?>" data-goodsname="<?php  echo $goods['title'];?>" data-goodsnum="<?php  echo $goods['total'];?>" data-goodsprice="<?php  echo $goods['marketprice'];?>" data-goodsec="0" data-specname=''>商品：<?php  echo $goods['title'];?>(无规格)[<?php  echo $goods['marketprice'];?>元] <span class="badge pull-right" data-new="0" data-type="1" data-datatype="4" data-value="<?php  echo $ke;?>" onclick="del_data_select(this);">x</span></button>
                </p>
                <?php  } else { ?>
                <?php  if(is_array($goods['spec'])) { foreach($goods['spec'] as $k => $specgoods) { ?>
                <p><button class="btn btn-success btn-xs rec_reward_data" id="rec_goods<?php  echo $rank;?>_<?php  echo $ke;?>_<?php  echo $specgoods['goods_spec'];?>" type="button" data-rank="<?php  echo $rank;?>" data-type="4" data-goodsid="<?php  echo $ke;?>" data-goodsname="<?php  echo $goods['title'];?>" data-goodsnum="<?php  echo $specgoods['total'];?>" data-goodsprice="<?php  echo $specgoods['marketprice'];?>" data-goodsec="<?php  echo $specgoods['goods_spec'];?>" data-specname="<?php  echo $specgoods['goods_specname'];?>">商品：<?php  echo $goods['title'];?>(<?php  echo $specgoods['goods_specname'];?>)[<?php  echo $specgoods['marketprice'];?>元] <span class="badge pull-right" data-new="0" data-type="1" data-datatype="4" data-value="<?php  echo $specgoods['goods_spec'].'-'.$ke;?>" onclick="del_data_select(this);">x</span></button>
                </p>
                <?php  } } ?>
                <?php  } ?>
                <?php  } } ?>
                <?php  } ?>
                <?php  } else if($key=='coupon') { ?>
                <?php  unset($rec['total']);?>
                <?php  if(is_array($rec)) { foreach($rec as $ke => $coupon) { ?>
                <p><button class="btn btn-success btn-xs rec_reward_data" id="rec_coupon<?php  echo $rank;?>_<?php  echo $coupon['id'];?>" type="button" data-rank="<?php  echo $rank;?>" data-type="5" data-couponid="<?php  echo $coupon['id'];?>" data-couponname="<?php  echo $coupon['couponname'];?>" data-couponnum="<?php  echo $coupon['couponnum'];?>">优惠券：<?php  echo $coupon['couponname'];?>[<?php  echo $coupon['couponnum'];?>张] <span class="badge pull-right" data-new="0" data-type="1" data-datatype="5" data-value="<?php  echo $coupon['id'];?>" onclick="del_data_select(this);">x</span></button>
                </p>
                <?php  } } ?>
                <?php  } ?>
                <?php  } } ?>
            </div>
        </div>
        <?php  $count++;?>
        <?php  } ?>
        <?php  } } ?>
        <?php  } ?>
    </div>
</div>
<?php  } else { ?>
<div class="form-group">
    <label class="col-lg control-label"></label>
    <div id="selected_rec_reward" class="col-sm-9 col-xs-12">
        <?php  if(!empty($rec_reward)) { ?>
        <?php  if(is_array($rec_reward)) { foreach($rec_reward as $key => $rec) { ?>
        <?php  if($key=='credit') { ?>
        <?php  if($rec>0) { ?>
        <p><button  class="btn btn-success btn-xs rec_reward_data " id="rec_credit" type="button"  data-type="1" data-value="<?php  echo $rec;?>">积分：<?php  echo $rec;?> </button>
        </p>
        <?php  } ?>
        <?php  } else if($key=='money') { ?>
        <?php  if($rec['num']>0) { ?>
        <p><button  class="btn btn-success btn-xs rec_reward_data" id="rec_money" type="button" data-type="2" data-value="<?php  echo $rec['num'];?>" data-moneytype="<?php  echo $rec['type'];?>">奖金[<?php echo $rec['type']==0?'余额':'微信';?>]：<?php  echo $rec['num'];?>元 </button>
        </p>
        <?php  } ?>
        <?php  } else if($key=='bribery') { ?>
        <?php  if($rec>0) { ?>
        <p><button  class="btn btn-success btn-xs rec_reward_data" id="rec_bribery" type="button" data-type="3" data-value="<?php  echo $rec;?>">红包：<?php  echo $rec;?>元 </button>
        </p>
        <?php  } ?>
        <?php  } else if($key=='goods') { ?>
        <?php  if(!empty($rec)) { ?>
        <?php  if(is_array($rec)) { foreach($rec as $ke => $goods) { ?>
        <?php  if(empty($goods['spec'])) { ?>
        <p><button class="btn btn-success btn-xs rec_reward_data" id="rec_goods<?php  echo $ke;?>_<?php  echo $specgoods['goods_spec'];?>" type="button" data-type="4" data-goodsid="<?php  echo $ke;?>" data-goodsname="<?php  echo $goods['title'];?>" data-goodsnum="<?php  echo $goods['total'];?>" data-goodsprice="<?php  echo $goods['marketprice'];?>" data-goodsec="0" data-specname=''>商品：<?php  echo $goods['title'];?>(无规格)[<?php  echo $goods['marketprice'];?>元] </button>
        </p>
        <?php  } else { ?>
        <?php  if(is_array($goods['spec'])) { foreach($goods['spec'] as $k => $specgoods) { ?>
        <p><button class="btn btn-success btn-xs rec_reward_data" id="rec_goods<?php  echo $ke;?>_<?php  echo $specgoods['goods_spec'];?>" type="button" data-type="4" data-goodsid="<?php  echo $ke;?>" data-goodsname="<?php  echo $goods['title'];?>" data-goodsnum="<?php  echo $specgoods['total'];?>" data-goodsprice="<?php  echo $specgoods['marketprice'];?>" data-goodsec="<?php  echo $specgoods['goods_spec'];?>" data-specname="<?php  echo $specgoods['goods_specname'];?>">商品：<?php  echo $goods['title'];?>(<?php  echo $specgoods['goods_specname'];?>)[<?php  echo $specgoods['marketprice'];?>元] </button>
        </p>
        <?php  } } ?>
        <?php  } ?>
        <?php  } } ?>
        <?php  } ?>
        <?php  } else if($key=='coupon') { ?>
        <?php  unset($rec['total']);?>
        <?php  if(is_array($rec)) { foreach($rec as $ke => $coupon) { ?>
        <p><button class="btn btn-success btn-xs rec_reward_data" id="rec_coupon<?php  echo $coupon['id'];?>" type="button" data-type="5" data-couponid="<?php  echo $coupon['id'];?>" data-couponname="<?php  echo $coupon['couponname'];?>" data-couponnum="<?php  echo $coupon['couponnum'];?>">优惠卷：<?php  echo $coupon['couponname'];?>[<?php  echo $coupon['couponnum'];?>张] </button>
        </p>
        <?php  } } ?>
        <?php  } ?>
        <?php  } } ?>
        <?php  } ?>
    </div>
</div>
<?php  } ?>

<div class="form-group">
    <label class="col-lg control-label">关注人获得</label>
    <?php if(cv('task.edit')) { ?>
    <div class="col-sm-3 col-xs-12">
        <select class="input-sm form-control input-s-sm inline" data-type="2" id="sub_select" onchange="select_change(this);">
            <option value="0">奖励类型</option>
            <option value="1">积分</option>
            <option value="2">奖金</option>
            <option value="3">红包</option>
            <option value="5">优惠券</option>
        </select>
    </div>
    <div class="col-sm-6 col-xs-12" id="sub_reward_show">

    </div>
    <?php  } ?>
</div>
<?php if(cv('task.edit')) { ?>
<div class="form-group">
    <label class="col-lg control-label"></label>
    <div id="selected_sub_reward" class="col-sm-9 col-xs-12">
        <?php  if(!empty($sub_reward)) { ?>
        <?php  if(is_array($sub_reward)) { foreach($sub_reward as $key => $sub) { ?>
        <?php  if($key=='credit') { ?>
        <?php  if($sub>0) { ?>
        <p><button class="btn btn-success btn-xs sub_reward_data" id="sub_credit" type="button" data-type="1" data-value="<?php  echo $sub;?>">积分：<?php  echo $sub;?> <span class="badge pull-right" data-type="2" data-datatype="1" data-value="0" data-new="0" onclick="del_data(this);">x</span></button>
        </p>
        <?php  } ?>
        <?php  } else if($key=='money') { ?>
        <?php  if($sub['num']>0) { ?>
        <p><button class="btn btn-success btn-xs sub_reward_data" id="sub_money" type="button" data-type="2" data-value="<?php  echo $sub['num'];?>" data-moneytype="<?php  echo $sub['type'];?>">奖金[<?php echo $sub['type']==0?'余额':'微信';?>]：<?php  echo $sub['num'];?>元 <span class="badge pull-right" data-new="0" data-type="2" data-datatype="2" data-value="0" onclick="del_data(this);">x</span></button>
        </p>
        <?php  } ?>
        <?php  } else if($key=='bribery') { ?>
        <?php  if($sub>0) { ?>
        <p><button class="btn btn-success btn-xs sub_reward_data" id="sub_bribery" type="button" data-type="3" data-value="<?php  echo $sub;?>">红包：<?php  echo $sub;?>元 <span class="badge pull-right" data-type="2" data-datatype="3" data-value="0" data-new="0" onclick="del_data(this);">x</span></button>
        </p>
        <?php  } ?>
        <?php  } else if($key=='coupon') { ?>
        <?php  unset($sub['total']);?>
        <?php  if(is_array($sub)) { foreach($sub as $ke => $coupon) { ?>
        <p><button class="btn btn-success btn-xs sub_reward_data" id="sub_coupon<?php  echo $coupon['id'];?>" type="button" data-type="5" data-couponid="<?php  echo $coupon['id'];?>" data-couponname="<?php  echo $coupon['couponname'];?>" data-couponnum="<?php  echo $coupon['couponnum'];?>">优惠券：<?php  echo $coupon['couponname'];?>[<?php  echo $coupon['couponnum'];?>张] <span class="badge pull-right" data-new="0" data-type="2" data-datatype="5" data-value="<?php  echo $coupon['id'];?>" onclick="del_data(this);">x</span></button>
        </p>
        <?php  } } ?>
        <?php  } ?>
        <?php  } } ?>
        <?php  } ?>
    </div>
</div>
<?php  } else { ?>
<div class="form-group">
    <label class="col-lg control-label"></label>
    <div id="selected_sub_reward" class="col-sm-9 col-xs-12">
        <?php  if(!empty($sub_reward)) { ?>
        <?php  if(is_array($sub_reward)) { foreach($sub_reward as $key => $sub) { ?>
        <?php  if($key=='credit') { ?>
        <?php  if($sub>0) { ?>
        <p><button class="btn btn-success btn-xs sub_reward_data" id="sub_credit" type="button" data-type="1" data-value="<?php  echo $sub;?>">积分：<?php  echo $sub;?> </button>
        </p>
        <?php  } ?>
        <?php  } else if($key=='money') { ?>
        <?php  if($sub['num']>0) { ?>
        <p><button class="btn btn-success btn-xs sub_reward_data" id="sub_money" type="button" data-type="2" data-value="<?php  echo $sub['num'];?>" data-moneytype="<?php  echo $sub['type'];?>">奖金[<?php echo $sub['type']==0?'余额':'微信';?>]：<?php  echo $sub['num'];?>元 </button>
        </p>
        <?php  } ?>
        <?php  } else if($key=='bribery') { ?>
        <?php  if($sub>0) { ?>
        <p><button class="btn btn-success btn-xs sub_reward_data" id="sub_bribery" type="button" data-type="3" data-value="<?php  echo $sub;?>">红包：<?php  echo $sub;?>元 </button>
        </p>
        <?php  } ?>
        <?php  } else if($key=='coupon') { ?>
        <?php  unset($sub['total']);?>
        <?php  if(is_array($sub)) { foreach($sub as $ke => $coupon) { ?>
        <p><button class="btn btn-success btn-xs sub_reward_data" id="sub_coupon<?php  echo $coupon['id'];?>" type="button" data-type="5" data-couponid="<?php  echo $coupon['id'];?>" data-couponname="<?php  echo $coupon['couponname'];?>" data-couponnum="<?php  echo $coupon['couponnum'];?>">优惠卷：<?php  echo $coupon['couponname'];?>[<?php  echo $coupon['couponnum'];?>张] </button>
        </p>
        <?php  } } ?>
        <?php  } ?>
        <?php  } } ?>
        <?php  } ?>
    </div>
</div>
<?php  } ?>
<!-- 奖励Modal -->
<div class="modal fade" id="rewardcouponModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" >选择优惠券</h4>
            </div>
            <div class="modal-body">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('task/post/select_coupon', TEMPLATE_INCLUDEPATH)) : (include template('task/post/select_coupon', TEMPLATE_INCLUDEPATH));?>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="reward_type" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="save_reward('coupon')">保存优惠券</button>
            </div>
        </div>
    </div>
</div>
<!-- 奖励Modal -->
<div class="modal fade" id="rewardgoodsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" >选择商品</h4>
            </div>
            <div class="modal-body">
                <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('task/post/select_goods', TEMPLATE_INCLUDEPATH)) : (include template('task/post/select_goods', TEMPLATE_INCLUDEPATH));?>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="reward_type" value="">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="save_reward('goods')">保存商品</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?php  if(!empty($rec_reward)) { ?>
    <?php  $rankone=array_shift($rec_reward);?>
    var rank_num = <?php  echo intval($rankone['rank']);?>;
    <?php  } else { ?>
    var rank_num = 0;
    <?php  } ?>
    function select_rank_change(obj) {
        var select_rank = $(obj).val();
        var rank_content = $('div[data-rank="'+select_rank+'"]');

        if(rank_content.length>0){
            var rank_state = rank_content.data('state');
            if(rank_state==1){
                $('.panel').attr('class','panel panel-default');
                rank_num= select_rank;
                rank_content.attr('class','panel panel-primary');
            }
        }
    }
    function addrecRewardrank() {
        var needcount = $('input[name="peoplenum"]').val();
        var select_rank = $('#select_rank').val();
        var rank_name = '一级奖励';
        if(select_rank>0){
            if(select_rank==2){
                rank_name= '二级奖励';
            }
            if(select_rank==3){
                rank_name = '三级奖励';
            }
            if(select_rank==4){
                rank_name = '四级奖励';
            }
            if(select_rank==5){
                rank_name='五级奖励';
            }
        }else{
            tip.msgbox.err('请先选择奖励等级');
            return;
        }
        if(needcount>0){
            var rank_div = $('div[data-rank="'+select_rank+'"]');
            if(rank_div.length>0){
                rank_div.find('div[class="panel-heading"]').html(rank_name+'('+needcount+'人)<span class="glyphicon glyphicon-remove pull-right" onclick="delrank(this);"></span>');
                rank_div.attr('data-needcount',needcount);
                rank_div.attr('data-state',1);
                $('.panel').attr('class','panel panel-default');
                rank_div.attr('class','panel panel-primary');
                rank_div.show();
                rank_num = select_rank;
            }else{
                var div_content = '<div class="panel panel-primary rec_rank" onclick="rankclick(this);" data-state="1" data-needcount="'+needcount+'" data-rank="'+select_rank+'"><div class="panel-heading">'+rank_name+'('+needcount+'人)<span class="glyphicon glyphicon-remove pull-right" onclick="delrank(this);"></span></div><div class="panel-body" id="selected_rec_reward'+select_rank+'"> </div> </div>';
                $('.panel').attr('class','panel panel-default');
                rank_num = select_rank;
                $('#rec-rank').append(div_content);
            }
            return;
        }else{
            tip.msgbox.err('推广人数不能小于或等于0');
            return;
        }
        return;
    }
    function rankclick(obj) {
        rank_num = $(obj).data('rank');
        $('.panel').attr('class','panel panel-default');
        $(obj).attr('class','panel panel-primary');
        return;
    }
    function delrank(obj) {
        $(obj).parent().parent().attr('data-state',0);
        $(obj).parent().parent().hide();
        return;
    }
    function select_change(obj) {
        var type = $(obj).data('type');
        if(type==1){
            var select_item = $('#rec_select').val();
            $('#rec_reward_show').empty();
            var div_item = '';
            if(select_item==1){
                div_item = '<div class="row"><div class="col-sm-4 col-xs-4"><input type="number" class="form-control" name="reccredit" placeholder="请输入积分">'
                        +'</div><div class="col-sm-4 col-xs-4"><a class="btn btn-primary" onclick="addrecReward(1);">添加奖励</a>'
                        +'</div></div>';
            }
            if(select_item==2){
                div_item = '<div class="row"><div class="col-sm-4 col-xs-4"><input type="number" class="form-control" name="recmoney" placeholder="请输入奖金">'
                        +'</div><div class="col-sm-4 col-xs-4"><select class="input-sm form-control input-s-sm inline" id="recmoneytype">'
                        +'<option value="0">余额</option><option value="1">微信</option></select></div>'
                        +'<div class="col-sm-4 col-xs-4"><a class="btn btn-primary" onclick="addrecReward(2);">添加奖励</a>'
                        +'</div></div>';
            }
            if(select_item==3){
                div_item = '<div class="row"><div class="col-sm-4 col-xs-4"><input type="number" class="form-control" name="recbribery" placeholder="请输入红包">'
                        +'</div><div class="col-sm-4 col-xs-4"><a class="btn btn-primary" onclick="addrecReward(3);">添加奖励</a>'
                        +'</div></div>';
            }
            if(select_item==4){
                div_item = '<div class="row"><div class="col-sm-4 col-xs-4"><a class="btn btn-primary" onclick="addrecReward(4);">添加指定价格商品</a></div></div>';
            }
            if(select_item==5){
                div_item = '<div class="row"><div class="col-sm-4 col-xs-4"><a class="btn btn-primary" onclick="addrecReward(5);">添加优惠券</a></div></div>';
            }

            $('#rec_reward_show').append(div_item);
        }
        if(type==2){
            var select_item = $('#sub_select').val();
            $('#sub_reward_show').empty();
            var div_item = '';
            if(select_item==1){
                div_item = '<div class="row"><div class="col-sm-4 col-xs-4"><input type="number" class="form-control" name="subcredit" placeholder="请输入积分">'
                        +'</div><div class="col-sm-4 col-xs-4"><a class="btn btn-primary" onclick="addsubReward(1);">添加积分奖励</a>'
                        +'</div></div>';
            }
            if(select_item==2){
                div_item = '<div class="row"><div class="col-sm-4 col-xs-4"><input type="number" class="form-control" name="submoney" placeholder="请输入奖金">'
                        +'</div><div class="col-sm-4 col-xs-4"><select class="input-sm form-control input-s-sm inline" id="submoneytype">'
                        +'<option value="0">余额</option><option value="1">微信</option></select></div>'
                        +'<div class="col-sm-4 col-xs-4"><a class="btn btn-primary" onclick="addsubReward(2);">添加奖金奖励</a>'
                        +'</div></div>';
            }
            if(select_item==3){
                div_item = '<div class="row"><div class="col-sm-4 col-xs-4"><input type="number" class="form-control" name="subbribery" placeholder="请输入红包">'
                        +'</div><div class="col-sm-4 col-xs-4"><a class="btn btn-primary" onclick="addsubReward(3);">添加红包奖励</a>'
                        +'</div></div>';
            }
            if(select_item==5){
                div_item = '<div class="row"><div class="col-sm-4 col-xs-4"><a class="btn btn-primary" onclick="addsubReward(5);">添加优惠券</a></div></div>';
            }

            $('#sub_reward_show').append(div_item);
        }
    }

    function addsubReward(datatype) {
        if(datatype==1){
            var subcredit = $('input[name="subcredit"]').val();
            subcredit = parseInt(subcredit);
            if(subcredit>0){
                var btn_data = '<p><button class="btn btn-success btn-xs sub_reward_data" id="sub_credit" type="button"  data-type="1" data-value="'+subcredit+'">积分：'+subcredit+' <span class="badge pull-right" data-type="2" data-datatype="1" data-value="0" data-new="0" onclick="del_data(this);">x</span></button></p>';
                var sub_credit = $('#sub_credit');
                if(sub_credit.length>0){
                    sub_credit.attr('data-value',subcredit);
                    sub_credit.html('积分：'+subcredit+' <span class="badge pull-right" data-type="2" data-datatype="1" data-value="0" data-new="0" onclick="del_data(this);">x</span>');
                }else{
                    $('#selected_sub_reward').append(btn_data);
                }
            }
        }
        if(datatype==2){
            var submoney = $('input[name="submoney"]').val();
            submoney = parseInt(submoney);
            var submoneytype = parseInt($('#submoneytype').val());
            if(submoney>0){
                var sub_money = $('#sub_money');
                var moneytype='余额';
                if(submoneytype==1){
                    moneytype='微信';
                }
                var btn_data = '<p><button class="btn btn-success btn-xs sub_reward_data" id="sub_money" type="button"  data-type="2" data-value="'+submoney+'" data-moneytype="'+submoneytype+'">奖金['+moneytype+']:'+submoney+'元 <span class="badge pull-right" data-type="2" data-datatype="2" data-value="0" data-new="0" onclick="del_data(this);">x</span></button></p>';
                if(sub_money.length>0){
                    sub_money.attr('data-value',submoney);
                    sub_money.attr('data-moneytype',submoneytype);
                    sub_money.html('奖金['+moneytype+']：'+submoney+'元 <span class="badge pull-right" data-type="2" data-datatype="2" data-value="0" data-new="0" onclick="del_data(this);">x</span>');
                }else{
                    $('#selected_sub_reward').append(btn_data);
                }
            }
        }
        if(datatype==3){
            var subbribery = $('input[name="subbribery"]').val();
            subbribery = parseInt(subbribery);
            if(subbribery>0){
                var btn_data = '<p><button class="btn btn-success btn-xs sub_reward_data" id="sub_bribery" type="button"  data-type="3" data-value="'+subbribery+'">红包：'+subbribery+'元 <span class="badge pull-right" data-type="2" data-datatype="3" data-value="0" data-new="0" onclick="del_data(this);">x</span></button></p>';
                var sub_bribery = $('#sub_bribery');
                if(sub_bribery.length>0){
                    sub_bribery.attr('data-value',subbribery);
                    sub_bribery.html('红包：'+subbribery+'元 <span class="badge pull-right" data-type="2" data-datatype="3" data-value="0" data-new="0" onclick="del_data(this);">x</span>');
                }else{
                    $('#selected_sub_reward').append(btn_data);
                }
            }
        }
        if(datatype==5){
            $('#selected_coupon').empty();
            $('input[name="reward_type"]').val('sub');
            $('#rewardcouponModal').modal('show');
        }
    }

    function addrecReward(datatype) {
        if(datatype==1){
            if(rank_num<=0){
                tip.msgbox.err("请选择等级！");
                return;
            }
            var reccredit = $('input[name="reccredit"]').val();
            reccredit = parseInt(reccredit);
            if(reccredit>0){
                var btn_data = '<p><button class="btn btn-success btn-xs rec_reward_data" id="rec_credit'+rank_num+'" type="button" data-rank="'+rank_num+'" data-type="1" data-value="'+reccredit+'">积分：'+reccredit+' <span class="badge pull-right" data-type="1" data-datatype="1" data-value="0" data-new="0" onclick="del_data(this);">x</span></button></p>';
                var rec_credit = $('#rec_credit'+rank_num);
                if(rec_credit.length>0){
                    rec_credit.attr('data-value',reccredit);
                    rec_credit.html('积分：'+reccredit+' <span class="badge pull-right" data-type="1" data-datatype="1" data-value="0" data-new="0" onclick="del_data(this);">x</span>');
                }else{
                    $('#selected_rec_reward'+rank_num).append(btn_data);
                }
            }
        }
        if(datatype==2){
            if(rank_num<=0){
                tip.msgbox.err("请选择等级！");
                return;
            }
            var recmoney = $('input[name="recmoney"]').val();
            recmoney = parseInt(recmoney);
            var recmoneytype = parseInt($('#recmoneytype').val());
            if(recmoney>0){
                var rec_money = $('#rec_money'+rank_num);
                var moneytype='余额';
                if(recmoneytype==1){
                    moneytype='微信';
                }
                var btn_data = '<p><button class="btn btn-success btn-xs rec_reward_data" id="rec_money'+rank_num+'" type="button" data-rank="'+rank_num+'" data-type="2" data-value="'+recmoney+'" data-moneytype="'+recmoneytype+'">奖金['+moneytype+']：'+recmoney+'元 <span class="badge pull-right" data-type="1" data-datatype="2" data-value="0" data-new="0" onclick="del_data(this);">x</span></button></p>';
                if(rec_money.length>0){
                    rec_money.attr('data-value',recmoney);
                    rec_money.attr('data-moneytype',recmoneytype);
                    rec_money.html('奖金['+moneytype+']：'+recmoney+'元 <span class="badge pull-right" data-type="2" data-datatype="2" data-value="0" data-new="0" onclick="del_data(this);">x</span>');
                }else{
                    $('#selected_rec_reward'+rank_num).append(btn_data);
                }
            }
        }
        if(datatype==3){
            if(rank_num<=0){
                tip.msgbox.err("请选择等级！");
                return;
            }
            var recbribery = $('input[name="recbribery"]').val();
            recbribery = parseInt(recbribery);
            if(recbribery>0){
                var btn_data = '<p><button class="btn btn-success btn-xs rec_reward_data" id="rec_bribery'+rank_num+'" type="button" data-rank="'+rank_num+'" data-type="3" data-value="'+recbribery+'">红包：'+recbribery+'元 <span class="badge pull-right" data-type="1" data-datatype="3" data-value="0" data-new="0" onclick="del_data(this);">x</span></button></p>';
                var rec_bribery = $('#rec_bribery'+rank_num);
                if(rec_bribery.length>0){
                    rec_bribery.attr('data-value',recbribery);
                    rec_bribery.html('红包：'+recbribery+'元 <span class="badge pull-right" data-type="1" data-datatype="3" data-value="0" data-new="0" onclick="del_data(this);">x</span>');
                }else{
                    $('#selected_rec_reward'+rank_num).append(btn_data);
                }
            }
        }
        if(datatype==4){
            if(rank_num<=0){
                tip.msgbox.err("请选择等级！");
                return;
            }
            $('#selected_goods').empty();
            $('input[name="reward_type"]').val('rec');
            $('#rewardgoodsModal').modal('show');
        }
        if(datatype==5){
            if(rank_num<=0){
                tip.msgbox.err("请选择等级！");
                return;
            }
            $('#selected_coupon').empty();
            $('input[name="reward_type"]').val('rec');
            $('#rewardcouponModal').modal('show');
        }
    }

    $(function(){
        $(".select-btn").click(function(){
            type = $(this).data("type");
            var kw = $.trim($("#select-"+type+"-kw").val());
            if(!kw){
                tip.msgbox.err("请输入搜索关键字！");
                return;
            }
            $("#select-"+type+"-list").html('<div class="tip">正在进行搜索...</div>');
            $.ajax("<?php  echo webUrl('task/select/query')?>", {
                type: "get",
                dataType: "html",
                cache: false,
                data: {title:kw, type:type,page:1,psize:5}
            }).done(function (html) {
                $("#select-"+type+"-list").html(html);
            });
        });
    });
    //分页函数
    function select_page(url,pindex,obj) {
        if(pindex==''||pindex==0){
            return;
        }
        var kw = $.trim($("#select-"+type+"-kw").val());
        if(!kw){
            tip.msgbox.err("请输入搜索关键字！");
            return;
        }
        $("#select-"+type+"-list").html('<div class="tip">正在进行搜索...</div>');
        $.ajax("<?php  echo webUrl('task/select/query')?>", {
            type: "get",
            dataType: "html",
            cache: false,
            data: {title:kw, type:type,page:pindex,psize:10}
        }).done(function (html) {
            $("#select-"+type+"-list").html(html);
        });
    }
    //选择优惠券
    function coupon_select(obj,data){
        $('#error').html('');
        var need_count = $('input[name="need_count_'+data.id+'"]').val();
        if(need_count==''||need_count<=0){
            $('#couponerror').html('优惠券数量不能<=0或空');
            return;
        }
        var is_exist = $('button[name="'+data.id+'"]');
        if(is_exist.length>0){
            $('#couponerror').html('此优惠券已经选择，请勿重复添加,若修改数量请删除后再添加...');
            return;
        }
        var coupon = '<button style="margin-right: 5px;margin-bottom: 5px; " name="'+data.id+'" class="btn btn-primary coupon-data" type="button"  data-id="'+data.id+'" data-name="'+data.name+'"  data-count="'+need_count+'">'+data.name+'['+need_count+'张] <span class="badge" onclick="del_data_select(this);">x</span></button>';
        $('#selected_coupon').append(coupon);
    }
    //选择指定商品
    function goods_select(obj,data){
        $('#error').html('');
        var money = $('input[name="need_money_'+data.id+'"]').val();
        var total = $('input[name="need_goods_'+data.id+'"]').val();

        if(money==''){
            $('#error').html('商品指定价格不能为空');
            return;
        }
        if(total<=0 || total==''){
            $('#error').html('商品数量不能为空或者小于0');
            return;
        }
        if(total>data.total){
            $('#error').html('商品数量不能大于库存');
            return;
        }
        var spec= $('#spc_'+data.id).find("option:selected");
        var spec_id = 0;
        var spec_name = '无规格';
        if(spec.length>0){
            spec_id = spec.data('specs');
            spec_name = spec.data('title');
        }
        var is_exist = $('button[goods_name="'+data.id+spec_id+'"]');
        if(is_exist.length>0){
            $('#error').html('此商品已经选择，请勿重复添加,若修改指定价格请删除后再添加...');
            return;
        }
        var goods = '<button style="margin-right: 5px;margin-bottom: 5px; " goods_name="'+data.id+spec_id+'" class="btn btn-primary  goods-data"  type="button" data-id="'+data.id+'" data-name="'+data.name+'" data-spec="'+spec_id+'" data-specname="'+spec_name+'" data-money="'+money+'"  data-count="'+total+'">'+data.name+'('+spec_name+')'+'['+money+'元] <span class="badge pull-right" onclick="del_data_select(this);">x</span></button>';
        $('#selected_goods').append(goods);
    }
    function del_data_select(obj) {
        $(obj).parent().remove();
    }
    //删除数据
    function del_data(obj) {
        var id = $('input[name="id"]').val();
        var del_type = $(obj).data('type');
        var data_type = $(obj).data('datatype');
        var data_value = $(obj).data('value');
        var is_new = $(obj).data('new');
        if(id){
            if(del_type){
                $.post("<?php  echo webUrl('task/index/delreward',array(),true);?>",{id:id,del_type:del_type,data_type:data_type,data_value:data_value},function (data) {
                    if(data.status==1){
                        if(del_type==1){
                            rec_reward=data.info;
                        }else if(del_type==2){
                            sub_reward=data.info;
                        }
                        $(obj).parent().parent().remove();
                    }else{
                        tip.msgbox.err(data.info);
                    }
                },'json');
            }else{
                $(obj).parent().parent().remove();
            }
        }else{
            $(obj).parent().parent().remove();
        }
    }

    //保存奖励
    function save_reward(modaltype) {
        var type = $('input[name="reward_type"]').val();
        if(type==''){
            return ;
        }
        var reward_select='';
        if(type=='rec'){
            if(modaltype=='goods'){
                //指定价格的商品
                if($('.goods-data').length>0){
                    $('.goods-data').each(function () {
                        var obj = $(this);
                        var goods_id = obj.data('id');
                        var goods_name = obj.data('name');
                        var goods_spec = obj.data('spec');
                        var goods_money = obj.data('money');
                        var goods_count = obj.data('count');
                        var specname = obj.data('specname');
                        if(goods_spec==0){
                            goods_spec=0;
                            specname='无规格';
                        }
                        if(goods_id>0){
                            reward_select='<p><button class="btn btn-success btn-xs rec_reward_data" id="rec_goods'+rank_num+'_'+goods_id+'_'+goods_spec+'" type="button" data-rank="'+rank_num+'" data-type="4" data-goodsid="'+goods_id+'" data-goodsname="'+goods_name+'" data-goodsnum="'+goods_count+'" data-goodsprice="'+goods_money+'" data-goodsec="'+goods_spec+'" data-specname="'+specname+'">商品：'+goods_name+'('+specname+')'+'['+goods_money+'元] <span class="badge pull-right" data-type="1" data-datatype="4" data-value="'+goods_id+'-'+goods_spec+'" onclick="del_data(this);">x</span></button></p>';
                            var goods_select = $('#rec_goods'+rank_num+'_'+goods_id+'_'+goods_spec);
                            if(goods_select.length>0){
                                goods_select.attr('data-goodsnum',goods_count);
                                goods_select.attr('data-goodsprice',goods_money);
                                goods_select.html('商品：'+goods_name+'('+specname+')'+'['+goods_money+'元] <span class="badge pull-right" data-type="1" data-datatype="4" data-value="'+goods_id+'-'+goods_spec+'" onclick="del_data(this);">x</span>');
                            }else{
                                $('#selected_rec_reward'+rank_num).append(reward_select);
                            }

                        }
                    });
                }
            }
            if(modaltype=='coupon'){
                //优惠券
                if($('.coupon-data').length>0) {
                    $('.coupon-data').each(function () {
                        var obj = $(this);
                        var couponid = obj.data('id');
                        var couponname = obj.data('name');
                        var couponnum = obj.data('count');
                        if(couponid>0){
                            reward_select='<p><button class="btn btn-success btn-xs rec_reward_data" id="rec_coupon'+rank_num+'_'+couponid+'" type="button" data-rank="'+rank_num+'" data-type="5" data-couponid="'+couponid+'" data-couponname="'+couponname+'" data-couponnum="'+couponnum+'">优惠券：'+couponname+'['+couponnum+'张] <span class="badge pull-right" data-type="1" data-datatype="5" data-value="'+couponid+'" onclick="del_data(this);">x</span></button></p>';
                            var coupon_select = $('#rec_coupon'+rank_num+'_'+couponid);
                            if(coupon_select.length>0){
                                coupon_select.attr('data-couponnum',couponnum);
                                coupon_select.html('优惠券：'+couponname+'['+couponnum+'张] <span class="badge pull-right" data-type="1" data-datatype="5" data-value="'+couponid+'" onclick="del_data(this);">x</span>');
                            }else{
                                $('#selected_rec_reward'+rank_num).append(reward_select);
                            }
                        }
                    });
                }
            }
        }else if(type=='sub'){
            //扫描关注奖励
            //优惠券
            if(modaltype=='coupon'){
                if($('.coupon-data').length>0) {
                    $('.coupon-data').each(function () {
                        var obj = $(this);
                        var couponid = obj.data('id');
                        var couponname = obj.data('name');
                        var couponnum = obj.data('count');
                        if(couponid>0){
                            reward_select='<button class="btn btn-success btn-xs sub_reward_data" id="sub_coupon'+couponid+'" type="button" data-type="5" data-couponid="'+couponid+'" data-couponname="'+couponname+'" data-couponnum="'+couponnum+'">优惠券：'+couponname+'['+couponnum+'张] <span class="badge pull-right" data-type="2" data-datatype="5" data-value="'+couponid+'" onclick="del_data(this);">x</span></button><br/>';
                            var coupon_select = $('#sub_coupon'+couponid);
                            if(coupon_select.length>0){
                                coupon_select.attr('data-couponnum',couponnum);
                                coupon_select.html('优惠券：'+couponname+'['+couponnum+'张] <span class="badge pull-right" data-type="1" data-datatype="5" data-value="'+couponid+'" onclick="del_data(this);">x</span>');
                            }else{
                                $('#selected_sub_reward').append(reward_select);
                            }
                        }
                    });
                }
            }
        }
        if(modaltype=='coupon'){
            $('#rewardcouponModal').modal('hide');
        }
        if(modaltype=='goods'){
            $('#rewardgoodsModal').modal('hide');
        }
        return;
    }
</script>
