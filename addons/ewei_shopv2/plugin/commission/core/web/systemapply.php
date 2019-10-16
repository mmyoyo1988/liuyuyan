<?php  if( !defined("IN_IA") ) 
{
	exit( "Access Denied" );
}
class Systemapply_EweiShopV2Page extends PluginWebPage 
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$status = intval($_GPC['status']);
		empty($status) && ($status = 2);

		if ($status == -1) {
			if (!cv('commission.apply.view_1')) {
				$this->message('你没有相应的权限查看');
			}
		}
		else 
		{
			if( !cv("commission.apply.view" . $status) ) 
			{
				$this->message("你没有相应的权限查看");
			}
		}
		$apply_type = array( "余额", "微信钱包", "支付宝", "银行卡" );
		$agentlevels = $this->model->getLevels();
		$level = $this->set["level"];
		$pindex = max(1, intval($_GPC["page"]));
		$psize = 20;
		$condition = " and a.status=:status";
		$params = array( ":status" => $status );
		$searchfield = strtolower(trim($_GPC["searchfield"]));
		$keyword = trim($_GPC["keyword"]);
		if( !empty($searchfield) && !empty($keyword) ) 
		{

			if( $searchfield == "member" ) 
			{
				$condition .= " and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)";
			}

			$params[":keyword"] = "%" . $keyword . "%";
		}
		if( empty($starttime) || empty($endtime) ) 
		{
			$starttime = strtotime("-1 month");
			$endtime = time();
		}
		$timetype = $_GPC["timetype"];
		if( !empty($_GPC["timetype"]) ) 
		{
			$starttime = strtotime($_GPC["time"]["start"]);
			$endtime = strtotime($_GPC["time"]["end"]);
			if( !empty($timetype) ) 
			{
				$condition .= " AND a." . $timetype . " >= :starttime AND a." . $timetype . "  <= :endtime ";
				$params[":starttime"] = $starttime;
				$params[":endtime"] = $endtime;
			}
		}
		if( !empty($_GPC["agentlevel"]) ) 
		{
			$condition .= " and m.agentlevel=" . intval($_GPC["agentlevel"]);
		}
		if( 3 <= $status ) 
		{
			$orderby = "paytime";
		}
		else 
		{

			$orderby = " subtime";

		}
		$applytitle = "";
		if( $status == 2 ) 
		{
			$applytitle = "待审核";
		}else 
		{
			if( $status == 3 ) 
			{
				$applytitle = "待打款";
			}
			else 
			{
				if( $status == 4 ) 
				{
					$applytitle = "已打款";
				}
				else 
				{
					if( $status == -1 ) 
					{
						$applytitle = "已无效";
					}
				}
			}
		}
		$sql = "select a.*,m.nickname,m.avatar,m.mobile,m.agentlevel,l.levelname,l.levelname from " . tablename("ewei_shop_agentbouns_apply") . " a " . " left join " . tablename("ewei_shop_member") . " m on m.id = a.memberid" . " left join " . tablename("ewei_shop_commission_level") . " l on l.id = m.agentlevel" . " where 1 " . $condition . " ORDER BY " . $orderby . " desc ";
		if( empty($_GPC["export"]) ) 
		{
			$sql .= "  limit " . ($pindex - 1) * $psize . "," . $psize;
		}
		$list = pdo_fetchall($sql, $params);
		if( $status == 3 ) 
		{
			$bouns_total = (double) pdo_fetchcolumn("select sum(a.mcommission) from " . tablename("ewei_shop_agentbouns_apply") . " a " . " left join " . tablename("ewei_shop_member") . " m on m.id = a.memberid" . " left join " . tablename("ewei_shop_commission_level") . " l on l.id = m.agentlevel" . " where 1 " . $condition, $params);
		}
		foreach( $list as &$row ) 
		{
			$row["agentlevel"] = intval($row["agentlevel"]);
			$row["levelname"] = (empty($row["levelname"]) ? (empty($this->set["levelname"]) ? "普通等级" : $this->set["levelname"]) : $row["levelname"]);
			$row["typestr"] = $apply_type[$row["type"]];
		}
		unset($row);

		$total = pdo_fetchcolumn("select count(a.id) from" . tablename("ewei_shop_agentbouns_apply") . " a " . " left join " . tablename("ewei_shop_member") . " m on m.uid = a.memberid" . " left join " . tablename("ewei_shop_commission_level") . " l on l.id = m.agentlevel" . " where 1 " . $condition, $params);
		$pager = pagination2($total, $pindex, $psize);
		include($this->template());
	}

	public function check() 
	{
		global $_W;
		global $_GPC;
		
		$id = intval($_GPC["id"]);
		$apply = pdo_fetch("select * from " . tablename("ewei_shop_agentbouns_apply") . " where id=:id limit 1", array( ":id" => $id ));
		if( empty($apply) ) 
		{
			if( $_W["isajax"] ) 
			{
				show_json(0, "提现申请不存在!");
			}
			$this->message("提现申请不存在!", "", "error");
		}
		$status = intval($_GPC['status']);
		
		if( $apply["status"] != 2 ) 
		{
			show_json(0, "此申请无法审核!");
		}
		
		$time = time();
		pdo_update("ewei_shop_agentbouns_apply", array( "status" => 3), array( "id" => $id ));
		pdo_update("ewei_shop_agentbouns", array( "status" => 3), array( "status" => 2,"memberid" => $apply['memberid'] ));
		
		show_json(1, array( "url" => webUrl("commission/systemapply", array( "status" => 3 )) ));
	}
	
	public function refuse() 
	{
		global $_W;
		global $_GPC;
		
		$id = intval($_GPC["id"]);
		$apply = pdo_fetch("select * from " . tablename("ewei_shop_agentbouns_apply") . " where id=:id limit 1", array( ":id" => $id ));
		if( empty($apply) ) 
		{
			if( $_W["isajax"] ) 
			{
				show_json(0, "提现申请不存在!");
			}
			$this->message("提现申请不存在!", "", "error");
		}
		$status = intval($_GPC['status']);
		
		if( $apply["status"] != 2 ) 
		{
			show_json(0, "此申请无法驳回!");
		}
		
		$time = time();
		pdo_update("ewei_shop_agentbouns_apply", array( "status" => 1), array( "id" => $id ));
		pdo_update("ewei_shop_agentbouns", array( "status" => 1), array( "status" => 2,"memberid" => $apply['memberid'] ));
		
		show_json(1, array( "url" => webUrl("commission/systemapply", array( "status" => 2 )) ));
	}
	
	public function pay() 
	{
		global $_W;
		global $_GPC;
		
		$id = intval($_GPC["id"]);
		$apply = pdo_fetch("select * from " . tablename("ewei_shop_agentbouns_apply") . " where id=:id limit 1", array( ":id" => $id ));
		if( empty($apply) ) 
		{
			if( $_W["isajax"] ) 
			{
				show_json(0, "提现申请不存在!");
			}
			$this->message("提现申请不存在!", "", "error");
		}
		$status = intval($_GPC['status']);
		
		if( $apply["status"] != 3 ) 
		{
			show_json(0, "请先审核!");
		}
		$member = m("member")->getMember($apply['memberid']);
		
		if($apply['paytype']==1){
			$result = m("finance")->pay($member["openid"], 0, $apply["realmoney"], $apply["id"], "系统分红提现");
		}
		
		$time = time();
		pdo_update("ewei_shop_agentbouns_apply", array( "status" => 4,'paytime'=>time()), array( "id" => $id ));
		pdo_update("ewei_shop_agentbouns", array( "status" => 4), array( "status" => 3,"memberid" => $apply['memberid'] ));
		
		show_json(1, array( "url" => webUrl("commission/systemapply", array( "status" => 4 )) ));
	}
	
}
?>