<?php defined('IN_IA') or exit('Access Denied');?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header"> 当前位置：<span class="text-primary">淘宝CSV上传助手</span>  </div>

<div class="page-content">
    <div class='alert alert-danger'>尽量在服务器空闲时间来操作，会占用大量内存与带宽，在获取过程中，请不要进行任何操作!</div>

    <div class="summary_box">
        <div class="summary_title">
            <span class="title_inner">淘宝CSV上传助手</span>
        </div>
        <div class="summary_lg">
            功能介绍：可将淘宝助理以及其他途径获取的淘宝商品CSV文件快速上传至商城,节约您的大量时间!
            <br>
            <span>使用方法： 1. 将您获取到的CSV文件转存为Excel格式,否则将无法识别</span>
            <br><span style="padding-left: 64px;">2. 将配套的图片文件包压缩为Zip格式压缩包并且导入(图片需在压缩包根目录下)</span>
            <br><span style="padding-left: 64px;">3. 确认上传即可</span>
            <dl style="margin:5px 0;">
                <dt style="float:left;font-weight:normal;">示例文件：</dt>
                <dd style="float:left;"><a href="<?php  echo $excelurl?>" >Excel示例文件下载</a><br /><a href="<?php  echo $zipurl?>" >Zip示例文件下载</a></dd>
            </dl>
            <div style="clear:both;"></div>
        </div>
    </div>


    <form id="importform" class="form-horizontal form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-lg control-label must">EXCEL</label>
            <div class="col-sm-5 goodsname"  style="padding-right:0;" >
                <input type="file" name="excelfile" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label must">ZIP</label>
            <div class="col-sm-5 goodsname"  style="padding-right:0;" >
                <input type="file" name="zipfile" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label"> </label>
            <div class="col-sm-9">
                <input id="btn_submit" type="submit"  value="确认导入" class="btn btn-primary" />
            </div>
        </div>
    </form>
</div>

<script language='javascript'>
    var total = <?php  echo $uploadnum?>;
    var uploadStart = <?php  echo $uploadStart?>;
    var len =0;

    if(uploadStart ==1)
    {
        $("#dataform").attr("disabled", "true");
        $("#btn_submit").val("正在获取中...").removeClass("btn-primary").attr("disabled", "true");
        $("#btn_submit").val("已经获取  " + len + " / " + total + " 个宝贝, 请等待....");
        fetch_next();
    }

    $('#importform').submit(function(e){

        if(!$(":input[name=excelfile]").val()){
            tip.msgbox.err("您还未选择Excel文件哦~");
            return false;
        }
        var AllImgExt=".xls|.xlsx|";
        var excelfile =$(":input[name=excelfile]").val()
        var extName = excelfile.substring(excelfile.lastIndexOf(".")).toLowerCase();
        if(AllImgExt.indexOf(extName+"|")==-1)
        {
            tip.msgbox.err("Excel文件类型不正确哦~");
            return false;
        }

        if(!$(":input[name=zipfile]").val()){
            tip.msgbox.err("您还未选择Zip文件哦~");
            return false;
        }
        var AllImgExt=".zip|";
        var excelfile =$(":input[name=zipfile]").val()
        var extName = excelfile.substring(excelfile.lastIndexOf(".")).toLowerCase();
        if(AllImgExt.indexOf(extName+"|")==-1)
        {
            tip.msgbox.err("Zip文件类型不正确哦~");
            return false;
        }
    })


    function fetch_next() {
        var postdata =  {
            num: len,
            totalnum: total
        };
        $.post("<?php  echo webUrl('taobao/taobaocsv/fetch')?>",
                postdata,
                function (data) {

                    $("#btn_submit").val("已经获取  " + len + " / " + total + " 个宝贝, 请等待....");
                    len++;
                    if (len >= total) {
                        $("#btn_submit").val("立即获取").addClass("btn-primary").removeAttr("disabled");
                        if (confirm('商品已经获取成功, 是否跳转到商品管理?')) {
                            location.href = "<?php  echo webUrl('goods' ,array('goodsfrom'=>stock))?>";
                        }
                        else {
                            location.reload();
                        }
                    }
                    else {
                        fetch_next();
                    }

                }, "json");
    }

</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

