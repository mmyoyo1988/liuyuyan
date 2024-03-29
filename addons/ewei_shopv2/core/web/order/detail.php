<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Detail_EweiShopV2Page extends WebPage {

    function main() {

        global $_W, $_GPC;
        $id = intval($_GPC['id']);

        $p = p('commission');

        $item = pdo_fetch("SELECT * FROM " . tablename('ewei_shop_order') . " WHERE id = :id and uniacid=:uniacid", array(':id' => $id, ':uniacid' => $_W['uniacid']));
        $item['statusvalue'] = $item['status'];
        $item['paytypevalue'] = $item['paytype'];

        //判断是否为纯核销订单
        $isonlyverifygoods = m('order')->checkisonlyverifygoods($item['id']);

        //部分发货时间
        $order_goods = array();
        if($item['sendtype']>0){
            $order_goods = pdo_fetchall("SELECT orderid,goodsid,sendtype,expresssn,expresscom,express,sendtime FROM " . tablename('ewei_shop_order_goods') . "
            WHERE orderid = ".$id." and sendtime > 0 and uniacid=".$_W['uniacid']." and sendtype > 0 group by sendtype order by sendtime desc ");
            foreach($order_goods as $key => $value){
                $order_goods[$key]['goods'] = pdo_fetchall('select g.id,g.title,g.thumb,og.sendtype,g.ispresell,og.realprice from ' . tablename('ewei_shop_order_goods') . ' og '
                    . ' left join ' . tablename('ewei_shop_goods') . ' g on g.id=og.goodsid '
                    . ' where og.uniacid=:uniacid and og.orderid=:orderid and og.sendtype='.$value['sendtype'].' ', array(':uniacid' => $_W['uniacid'], ':orderid' => $id));
            }
            $item['sendtime'] = $order_goods[0]['sendtime'];
        }

        $shopset = m('common')->getSysset('shop');
        if (empty($item)) {

            $this->message("抱歉，订单不存在!", referer(), "error");
        }

        if ($_W['ispost']) {
            pdo_update(
                'ewei_shop_order', array(
                'remark' => trim($_GPC['remark']),
            ), array('id' => $item['id'], 'uniacid' => $_W['uniacid'])
            );
            plog('order.op.remarksaler', "订单保存备注  ID: {$item['id']} 订单号: {$item['ordersn']}");
            $this->message('订单备注保存成功！', webUrl('order', array('op' => 'detail', 'id' => $item['id'])), 'success');
        }

        $member = m('member')->getMember($item['openid']);
        $dispatch = pdo_fetch("SELECT * FROM " . tablename('ewei_shop_dispatch') . " WHERE id = :id and uniacid=:uniacid and merchid=0", array(':id' => $item['dispatchid'], ':uniacid' => $_W['uniacid']));
        if (empty($item['addressid'])) {
            $user = unserialize($item['carrier']);

            if($item['storeid']<>0 && $item['ismerch'] == 0){
                $user['storename'] = pdo_fetch("SELECT storename FROM " . tablename('ewei_shop_store') . " WHERE id = :id and uniacid=:uniacid and status=1", array(':id' => $item['storeid'], ':uniacid' => $_W['uniacid']));
            }
        } else {

            $user = iunserializer($item['address']);

            if (!is_array($user)) {
                $user = pdo_fetch("SELECT * FROM " . tablename('ewei_shop_member_address') . " WHERE id = :id and uniacid=:uniacid", array(':id' => $item['addressid'], ':uniacid' => $_W['uniacid']));
            }
            $address_info = $user['address'];
            $user['address'] = $user['province'] . ' ' . $user['city'] . ' ' . $user['area'] . ' ' . $user['street'] . ' ' . $user['address'];
            $item['addressdata'] = array(
                'realname' => $user['realname'],
                'mobile' => $user['mobile'],
                'address' => $user['address'],
            );
        }

        $refund = pdo_fetch("SELECT * FROM " . tablename('ewei_shop_order_refund') . " WHERE orderid = :orderid and uniacid=:uniacid order by id desc", array(':orderid' => $item['id'], ':uniacid' => $_W['uniacid']));

        $diyformfields = "";

        $showdiyform = false;

        if (p('diyform')) {
            $diyformfields = ",o.diyformfields,o.diyformdata";
        }
        $goods = pdo_fetchall("SELECT op.specs,g.*,o.title as gtitle, o.goodssn as option_goodssn, o.productsn as option_productsn,o.total,g.type,o.optionname,o.optionid,o.price as orderprice,o.realprice,o.changeprice,o.oldprice,o.commission1,o.commission2,o.commission3,o.commissions,o.seckill,o.seckill_taskid,o.seckill_roomid,o.nocommission,o.single_refundstate{$diyformfields} FROM " . tablename('ewei_shop_order_goods') .
            " o left join " . tablename('ewei_shop_goods') . " g on o.goodsid=g.id "
            ." left join " . tablename('ewei_shop_goods_option') . " op on o.optionid=op.id "
            . " WHERE o.orderid=:orderid and o.uniacid=:uniacid", array(':orderid' => $id, ':uniacid' => $_W['uniacid']));
        $is_merch = false;

        $is_singlerefund=false;//是否正在维权
        foreach ($goods as &$r) {
            if(!$is_singlerefund && ($r['single_refundstate']==1 ||$r['single_refundstate']==2)){
                $is_singlerefund=true;//存在维权申请，需要处理后再发货
            }
            $r['seckill_task'] = false;
            if($r['seckill']){

                $r['seckill_task']  = plugin_run('seckill::getTaskInfo',$r['seckill_taskid']);
                $r['seckill_room']  = plugin_run('seckill::getRoomInfo',$r['seckill_taskid'],$r['seckill_roomid']);
            }

            if (!empty($r['option_goodssn'])) {
                $r['goodssn'] = $r['option_goodssn'];
            }
            if (!empty($r['option_productsn'])) {
                $r['productsn'] = $r['option_productsn'];
            }
            $r['marketprice'] = $r['orderprice']/$r['total'];
            if (p('diyform')) {
                $r['diyformfields'] = iunserializer($r['diyformfields']);
                $r['diyformdata'] = iunserializer($r['diyformdata']);
            }
            if (!empty($r['merchid'])){
                $is_merch = true;
            }
            if(!empty($r['diyformdata']) && $r['diyformdata'] != 'false' && !$showdiyform){
                $showdiyform = true;
            }
            if (empty($r['optionname']) && !empty($r['specs'])) {

                $r['optionname'] = $this->option_title($r['specs']);

//                $option_title = pdo_fetch('SELECT title FROM'.tablename('ewei_shop_goods_spec_item').' WHERE uniacid = '.intval($_W['uniacid']).' AND id = '.intval($r['specs']));
//                $r['optionname'] = $option_title['title'];
            }
            if(empty($r['gtitle'])!=true){
                $r['title']=$r['gtitle'];
            }
        }
        unset($r);

        $item['goods'] = $goods;
        $agents = array();
        if ($p) {
            $agents = $p->getAgents($id);

            $m1 = isset($agents[0]) ? $agents[0] : false;
            $m2 = isset($agents[1]) ? $agents[1] : false;
            $m3 = isset($agents[2]) ? $agents[2] : false;
            $commission1 = 0;
            $commission2 = 0;
            $commission3 = 0;
            foreach ($goods as &$og) {

                if (empty($og['nocommission'])) {
                    $oc1 = 0;
                    $oc2 = 0;
                    $oc3 = 0;
                    $commissions = iunserializer($og['commissions']);
                    if (!empty($m1)) {
                        if (is_array($commissions)) {
                            $oc1 = isset($commissions['level1']) ? floatval($commissions['level1']) : 0;
                        } else {
                            $c1 = iunserializer($og['commission1']);
                            $l1 = $p->getLevel($m1['openid']);
                            $oc1 = isset($c1['level' . $l1['id']]) ? $c1['level' . $l1['id']] : $c1['default'];
                        }
                        $og['oc1'] = $oc1;
                        $commission1 += $oc1;
                    }
                    if (!empty($m2)) {
                        if (is_array($commissions)) {
                            $oc2 = isset($commissions['level2']) ? floatval($commissions['level2']) : 0;
                        } else {
                            $c2 = iunserializer($og['commission2']);
                            $l2 = $p->getLevel($m2['openid']);
                            $oc2 = isset($c2['level' . $l2['id']]) ? $c2['level' . $l2['id']] : $c2['default'];
                        }
                        $og['oc2'] = $oc2;
                        $commission2 += $oc2;
                    }
                    if (!empty($m3)) {
                        if (is_array($commissions)) {
                            $oc3 = isset($commissions['level3']) ? floatval($commissions['level3']) : 0;
                        } else {
                            $c3 = iunserializer($og['commission3']);
                            $l3 = $p->getLevel($m3['openid']);
                            $oc3 = isset($c3['level' . $l3['id']]) ? $c3['level' . $l3['id']] : $c3['default'];
                        }
                        $og['oc3'] = $oc3;
                        $commission3 += $oc3;
                    }
                }
                unset($og);

                $commission_array = array(0 => $commission1, 1 => $commission2, 2 => $commission3);
                foreach ($agents as $key => $value) {
                    $agents[$key]['commission'] = $commission_array[$key];
                    if ($key > 2) {
                        unset($agents[$key]);
                    }
                }
            }
        }
        $condition = " o.uniacid=:uniacid and o.deleted=0";
        $paras = array(':uniacid' => $_W['uniacid']);
        $totals = array();

        $coupon = false;
        if (com('coupon') && !empty($item['couponid'])) {
            $coupon = com('coupon')->getCouponByDataID($item['couponid']);
        }

        $order_fields = false;
        $order_data = false;
        if (p('diyform')) {
            $diyform_set = p('diyform')->getSet();
            foreach ($goods as $g) {
                if (!empty($g['diyformdata'])) {
                    break;
                }
            }
            //订单统一模板
            if (!empty($item['diyformid'])) {
                $orderdiyformid = $item['diyformid'];
                if (!empty($orderdiyformid)) {
                    $order_fields = iunserializer($item['diyformfields']);
                    $order_data = iunserializer($item['diyformdata']);
                }
            }
        }
        if (com('verify')) {
            $verifyinfo = iunserializer($item['verifyinfo']);

            if (!empty($item['verifyopenid'])) {
                $saler = m('member')->getMember($item['verifyopenid']);

                if (empty($item['merchid'])) {
                    $saler['salername'] = pdo_fetchcolumn('select salername from ' . tablename('ewei_shop_saler') . ' where openid=:openid and uniacid=:uniacid limit 1 ', array(':uniacid' => $_W['uniacid'], ':openid' => $item['verifyopenid']));
                } else {
                    $saler['salername'] = pdo_fetchcolumn('select salername from ' . tablename('ewei_shop_merch_saler') . ' where openid=:openid and merchid=:merchid and uniacid=:uniacid limit 1 ', array(':uniacid' => $_W['uniacid'], ':openid' => $item['verifyopenid'], ':merchid' => $item['merchid']));
                }
            }
            if (!empty($item['verifystoreid'])) {
                if (empty($item['merchid'])) {
                    $store = pdo_fetch('select * from ' . tablename('ewei_shop_store') . ' where id=:storeid limit 1 ', array(':storeid' => $item['verifystoreid']));
                } else {
                    $store = pdo_fetch('select * from ' . tablename('ewei_shop_merch_store') . ' where id=:storeid limit 1 ', array(':storeid' => $item['verifystoreid']));
                }
            }
            if(!empty($item['storeid'])){
                if (empty($item['merchid'])) {
                    $goodsstore = pdo_fetch('select * from ' . tablename('ewei_shop_store') . ' where id=:storeid limit 1 ', array(':storeid' => $item['storeid']));
                } else {
                    $goodsstore = pdo_fetch('select * from ' . tablename('ewei_shop_merch_store') . ' where id=:storeid limit 1 ', array(':storeid' => $item['storeid']));
                }
            }

            //核销
            if ($item['isverify']) {
                if (is_array($verifyinfo)) {
                    if (empty($item['dispatchtype']))
                    {
                        foreach ($verifyinfo as &$v) {
                            if ($v['verified'] || $item['verifytype']==1) {
                                if (empty($item['merchid'])) {
                                    $v['storename'] = pdo_fetchcolumn('select storename from ' . tablename('ewei_shop_store') . " where id=:id limit 1", array(':id' => $v['verifystoreid']));
                                } else {
                                    $v['storename'] = pdo_fetchcolumn('select storename from ' . tablename('ewei_shop_merch_store') . " where id=:id limit 1", array(':id' => $v['verifystoreid']));
                                }

                                if (empty($v['storename'])) {
                                    $v['storename'] = "总店";
                                }
                                $v['nickname'] = pdo_fetchcolumn('select nickname from ' . tablename('ewei_shop_member') . " where openid=:openid and uniacid=:uniacid limit 1", array(':openid' => $v['verifyopenid'], ':uniacid' => $_W['uniacid']));
                                if (empty($item['merchid'])) {
                                    $v['salername'] = pdo_fetchcolumn('select salername from ' . tablename('ewei_shop_saler') . " where openid=:openid and uniacid=:uniacid limit 1", array(':openid' => $v['verifyopenid'], ':uniacid' => $_W['uniacid']));
                                } else {
                                    $v['salername'] = pdo_fetchcolumn('select salername from ' . tablename('ewei_shop_merch_saler') . " where openid=:openid and merchid=:merchid and uniacid=:uniacid limit 1", array(':openid' => $v['verifyopenid'], ':uniacid' => $_W['uniacid'], ':merchid' => $item['merchid']));
                                }

                            }
                        }
                        unset($v);
                    }

                }
            }
        }

        //核销记录
        $verifygoods_list = array();

        $isonlyverifygoods = m('order')->checkisonlyverifygoods($item['id']);

        if($isonlyverifygoods){
            $sql = 'select vg.*,vgl.verifydate,vgl.verifynum,s.storename,sa.salername,vgl.remarks  from ' . tablename('ewei_shop_verifygoods_log') . '   vgl
                 left join ' . tablename('ewei_shop_verifygoods') . ' vg on vg.id = vgl.verifygoodsid
                 left join ' . tablename('ewei_shop_store') . ' s  on s.id = vgl.storeid
                 left join ' . tablename('ewei_shop_saler') . ' sa  on sa.id = vgl.salerid
                 where  vg.orderid=:orderid ORDER BY vgl.verifydate DESC ';
            $verifygoods_list = pdo_fetchall($sql, array(':orderid'=>$item['id']));


            $verifygood =   pdo_fetch('select *  from ' . tablename('ewei_shop_verifygoods') . '    where orderid =:orderid limit 1  ', array(':orderid' => $item['id']));

            //核销次数统计
            $verifynum = 0;
            foreach($verifygoods_list as $verifygoodlog)
            {
                $verifynum +=intval($verifygoodlog['verifynum']);
            }

            $verifygoods_times =  $verifynum;
            $verifygoods_times_total =  intval($verifygood['limitnum']) ;
            if(empty($verifygood['limittype']))
            {
                $limitdate =date('Y-m-d H:i:s',  intval($verifygood['starttime']) +  intval($verifygood['limitdays'])*86400);

            }else
            {
                $limitdate =date('Y-m-d H:i:s',  $verifygood['limitdate']);
            }
            $verifygoods_times_endtime = $limitdate;

        }

        //团队分红
        if(!empty($item['headsid']) && !empty($item['dividend'])){
            $dividend = iunserializer($item['dividend']);
            if (!empty($dividend)) {
                $dividend_price = isset($dividend['dividend_price']) ? floatval($dividend['dividend_price']) : 0;
            }
            $heads=pdo_fetch('select * from ' . tablename('ewei_shop_member') . " where id=:id and uniacid=:uniacid limit 1", array(':id' => $item['headsid'], ':uniacid' => $_W['uniacid']));
        }
        //判断是否使用会员卡
        $use_membercard = false;
        $membercard_info = array();
        if(p('membercard')){
            $ifuse = p('membercard')->if_order_use_membercard($id);
            if($ifuse){
                $use_membercard = true;
                $card_text = $ifuse['name'].'优惠';
                $card_dec_price = $ifuse['dec_price'];
            }
        }
        //是否是代付订单
        $is_peerpay = 0;
        if(m('order')->checkpeerpay($id)){
            $is_peerpay = 1;
        }
        $item['is_peerpay'] = $is_peerpay;

        load()->func('tpl');
        include $this->template();
        exit;
    }

    /**
     * @params $orderid 订单id
     * @description
     * 未知原因导致了部分客户的【相当一部分商品的规格标题】
     * 未能正确存储到goods_option表的optionname字段中,
     * 导致下单后订单详情中不能显示客户购买了什么规格,导致无法发货,
     * 由于部分商户涉及到的数据量达十几万条,数据难以弥补
     * 此方法在optionname标题不存在时,重组规格标题用作显示作用
     *  微擎取消了UNION ALL写法 之后优化了方法的sql
     * 2018.9.19 重写了获取规格的方法,传入$spec
     * @author cunxin,sunchao
     * @return string 规格标题optionname
     */
    public function option_title($spec){
        global $_W;
        $specs =  ($spec);
//        //查出spec_item的标题
//        $sql = "select o.specs from " . tablename('ewei_shop_order_goods')
//            . " g join " . tablename('ewei_shop_goods_option')
//            . " o on o.id = g.optionid where g.orderid = :orderid";
//        //规格项id
//        $specs =  pdo_fetchcolumn($sql, array(':orderid'=>$orderid));

        $specs_arr = explode('_',$specs);
        $specs = implode(',',$specs_arr);
        $table = tablename('ewei_shop_goods_spec_item');
        $sql =  "select title from ". $table . " where id  in (".$specs.")";
//        $sql = array();
//        foreach ($specs_arr as $s){
//            $sql[] = 'select title from ' . $table . ' where id = ' . (int)$s;
//        }
//        $sql = implode(' UNION ALL ',$sql);

        $title_arr = pdo_fetchall($sql);

        foreach ($title_arr as &$arr) {
            $arr = $arr['title'];
        }
        $title = implode('+',$title_arr);
        return $title;
    }


}
