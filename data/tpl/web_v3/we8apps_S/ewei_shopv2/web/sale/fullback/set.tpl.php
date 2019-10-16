<?php defined('IN_IA') or exit('Access Denied');?><div class="modal-dialog">
    <form action="<?php  echo webUrl('sale.fullback.set')?>" method="post"
          class="form-horizontal form-validate" enctype="multipart/form-data" novalidate="novalidate">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">全返设置</h4>
            </div>
            <div class="modal-body">

                    <div class="form-group">
                        <label class="col-sm-3 control-label mustl">文本显示</label>
                        <div class="col-sm-7 col-xs-12">
                            <input type="text" name="text" class="form-control" value="<?php  echo $text;?>" placeholder="全返">
                            <span class="help-block">在此输入文字用来替代“全返”两个字的文字<br>
                                替换位置：商品详情页活动内容、会员中心系统默认“我的全返”入口文字、“全返记录”3处文字</span>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-submit" type="submit">保存</button>
                <button data-dismiss="modal" class="btn btn-default" type="button">取消</button>
            </div>
        </div>
    </form>
</div>