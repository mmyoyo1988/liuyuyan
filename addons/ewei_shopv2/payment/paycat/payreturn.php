<?php

    $orderid = $_GET["orderid"];
    echo "恭喜，支付成功!，订单号：".$orderid;
    $start = substr($orderid,0,2);
    if($start == 'RC'){
        $paytype = 1;
    }else{
        $paytype = 0;
    }
    if ($paytype == 0) {
        $url = $_W['siteroot'] . '../../app/index.php?i=' . $uniacid . '&c=entry&m=ewei_shopv2&do=mobile&r=order.pay_alipay.complete&alidata=' . $get;
    }
    else if ($paytype == 1) {
        $url = $_W['siteroot'] . '../../app/index.php?i=' . $uniacid . '&c=entry&m=ewei_shopv2&do=mobile&r=order.pay_alipay.recharge_complete&alidata=' . $get;
    }
    //此处在您数据库中查询：此笔订单号是否已经异步通知给您付款成功了。如成功了，就给他返回一个支付成功的展示。

    header('location: ' . $url);
    exit();
?>