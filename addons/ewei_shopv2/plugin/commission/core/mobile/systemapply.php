<?php
if (!(defined('IN_IA'))) 
{
	exit('Access Denied');
}
require EWEI_SHOPV2_PLUGIN . 'commission/core/page_login_mobile.php';
class Systemapply_EweiShopV2Page extends CommissionMobileLoginPage 
{
	public function main() 
	{
		global $_W;
		global $_GPC;
		$openid = $_W['openid'];
		$member = $this->model->getInfo($openid, array('ok'));
		$become_reg = $this->set['become_reg'];
		if (empty($become_reg)) 
		{
			if (empty($member['realname'])) 
			{
				$returnurl = urlencode(mobileUrl('commission/apply'));
				$this->message('需要您完善资料才能继续操作!', mobileUrl('member/info', array('returnurl' => $returnurl)), 'info');
			}
		}

		$commission_ok = $member['system_ok'];

		$withdraw = floatval($this->set['withdraw']);
		if ($withdraw <= 0) 
		{
			$withdraw = 1;
		}
		$cansettle = $withdraw <= $commission_ok;
		$set_array = array();
		$set_array['charge'] = $this->set['withdrawcharge'];
		$set_array['begin'] = floatval($this->set['withdrawbegin']);
		$set_array['end'] = floatval($this->set['withdrawend']);
		$realmoney = $commission_ok;
		$deductionmoney = 0;
		if (!(empty($set_array['charge']))) 
		{
			$money_array = m('member')->getCalculateMoney($commission_ok, $set_array);
			if ($money_array['flag']) 
			{
				$realmoney = $money_array['realmoney'];
				$deductionmoney = $money_array['deductionmoney'];
			}
		}
		$last_data = $this->model->getLastApply($member['id']);
		$canusewechat = !(strexists($openid, 'wap_user_')) && !(strexists($openid, 'sns_qq_')) && !(strexists($openid, 'sns_wx_')) && !(strexists($openid, 'sns_wa_'));
		$type_array = array();
		if ($this->set['cashcredit'] == 1) 
		{
			$type_array[0]['title'] = $this->set['texts']['withdraw'] . '到' . $_W['shopset']['trade']['moneytext'];
		}
		if (($this->set['cashweixin'] == 1) && $canusewechat) 
		{
			$type_array[1]['title'] = $this->set['texts']['withdraw'] . '到微信钱包';
		}
		if ($this->set['cashother'] == 1) 
		{
			if ($this->set['cashalipay'] == 1) 
			{
				$type_array[2]['title'] = $this->set['texts']['withdraw'] . '到支付宝';
				if (!(empty($last_data))) 
				{
					if ($last_data['type'] != 2) 
					{
						$type_last = $this->model->getLastApply($member['id'], 2);
						if (!(empty($type_last))) 
						{
							$last_data['realname'] = $type_last['realname'];
							$last_data['alipay'] = $type_last['alipay'];
						}
					}
				}else{
					$last_data['realname'] = $member['realname'];
					$last_data['alipay'] = $member['zfb'];
				}
			}
			if ($this->set['cashcard'] == 1) 
			{
				$type_array[3]['title'] = $this->set['texts']['withdraw'] . '到银行卡';
				if (!(empty($last_data))) 
				{
					if ($last_data['type'] != 3) 
					{
						$type_last = $this->model->getLastApply($member['id'], 3);
						if (!(empty($type_last))) 
						{
							$last_data['realname'] = $type_last['realname'];
							$last_data['bankname'] = $type_last['bankname'];
							$last_data['bankcard'] = $type_last['bankcard'];
						}
					}
				}
				$condition = ' and uniacid=:uniacid and status=1';
				$params = array(':uniacid' => $_W['uniacid']);
				$banklist = pdo_fetchall('SELECT * FROM ' . tablename('ewei_shop_commission_bank') . ' WHERE 1 ' . $condition . '  ORDER BY displayorder DESC', $params);
			}
		}
		if (!(empty($last_data))) 
		{
			if (array_key_exists($last_data['type'], $type_array)) 
			{
				$type_array[$last_data['type']]['checked'] = 1;
			}
		}
		if ($_W['ispost']) 
		{
			if (empty($_SESSION['commission_apply_token'])) 
			{
				show_json(0, '不要短时间重复下提交!');
			}
			unset($_SESSION['commission_apply_token']);
			if ($commission_ok <= 0) 
			{
				show_json(0, '参数错误,请刷新页面后重新提交!');
			}
			$type = intval($_GPC['type']);
			if (!(array_key_exists($type, $type_array))) 
			{
				show_json(0, '未选择提现方式，请您选择提现方式后重试!');
			}
			// file_put_contents('C:/log.html','  realmoney:'.$realmoney.'<br>',FILE_APPEND); 
			$apply = array('status' => 2, 'subtime' => time(),'charge' => $set_array['charge']);
			if ($type == 2) 
			{
				$realname = trim($_GPC['realname']);
				$alipay = trim($_GPC['alipay']);
				$alipay1 = trim($_GPC['alipay1']);
				if (empty($realname)) 
				{
					show_json(0, '请填写姓名!');
				}
				if (empty($alipay)) 
				{
					show_json(0, '请填写支付宝帐号!');
				}
				if (empty($alipay1)) 
				{
					show_json(0, '请填写确认帐号!');
				}
				if ($alipay != $alipay1) 
				{
					show_json(0, '支付宝帐号与确认帐号不一致!');
				}
				$apply['paytype'] = 2;
				$apply['realname'] = $realname;
				$apply['zfb'] = $alipay;
			}
			else if ($type == 3) 
			{
				$realname = trim($_GPC['realname']);
				$bankname = trim($_GPC['bankname']);
				$bankcard = trim($_GPC['bankcard']);
				$bankcard1 = trim($_GPC['bankcard1']);
				if (empty($realname)) 
				{
					show_json(0, '请填写姓名!');
				}
				if (empty($bankname)) 
				{
					show_json(0, '请选择银行!');
				}
				if (empty($bankcard)) 
				{
					show_json(0, '请填写银行卡号!');
				}
				if (empty($bankcard1)) 
				{
					show_json(0, '请填写确认卡号!');
				}
				if ($bankcard != $bankcard1) 
				{
					show_json(0, '银行卡号与确认卡号不一致!');
				}
				$apply['paytype'] = 3;
				$apply['realname'] = $realname;
				$apply['bankname'] = $bankname;
				$apply['bankcard'] = $bankcard;
			}else{
				$apply['paytype'] = 1;
			}

			pdo_update('ewei_shop_agentbouns', array( "status" => 2 ), array('memberid' => $member['id'], 'status' => 1));
			
			$apply['memberid'] = $member['id'];
			$apply['mcommission'] = $member['system_ok'];
			$apply['realmoney'] = $realmoney;
			pdo_insert('ewei_shop_agentbouns_apply',$apply);
			
			show_json(1, '已提交,请等待审核!');
		}
		$token = md5(microtime());
		$_SESSION['commission_apply_token'] = $token;
		include $this->template();
	}
}
?>