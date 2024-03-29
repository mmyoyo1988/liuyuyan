<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header">
	当前位置：<span class="text-primary"><?php  echo m('plugin')->getName('exhelper')?></span>
</div>
<div class="page-content">
	<div class="summary_box">
		<div class="summary_title">
			<span class="title_inner">快递助手使用说明</span>
		</div>
		<div class="summary_lg">
			<p>快递助手是集合于快递单打印、发货单打印、一键发货于一体的插件，可根据需求自定义打印元素、样式、字体。 </p>
			<p>使用步骤 1. 在电脑上安装打印控件 -> 开启控件 -> 设置端口(这里的端口是IP端口并不是主机端口);</p>
			<p style="text-indent: 4.3em;"> 2. 在 快递助手 -> <a href="<?php  echo webUrl('exhelper/printset')?>" class="text-primary">打印机设置</a> 中将"IP端口"设置为与控件一致的端口;</p>
			<p style="text-indent: 4.3em;"> 3. 进入 <a href="<?php  echo webUrl('exhelper/temp/express')?>" class="text-primary">快递单模板</a>或者<a href="<?php  echo webUrl('exhelper/temp/invoice')?>" class="text-primary">发货单模板</a>并根据所需创建相应模板;</p>
			<p style="text-indent: 4.3em;"> 4. 进入 <a href="<?php  echo webUrl('exhelper/sender')?>" class="text-primary">发货人信息</a>并根据所需创建相应发货人信息模板;</p>
			<p style="text-indent: 4.3em;"> 5. 进入 <a href="<?php  echo webUrl('exhelper/short')?>" class="text-primary">商品简称设置</a>可将商品简称根据打印需要进行编辑(非必选);</p>
			<p style="text-indent: 4.3em;"> 6. 进入 单个打印或者批量打印，根据需求查询出想要打印的订单并且进行打印快递单、发货单、一键发货;</p>
			<p>提示: 单个打印系统自动合单，同一收货地址仅出一张单; 批量打印可打印自提订单的发货单; 在打印页面也可以进行快速修改商品简称、收件人信息;</p>
		</div>
	</div>

</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
