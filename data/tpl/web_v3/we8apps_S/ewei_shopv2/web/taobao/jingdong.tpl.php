<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>

<div class="page-header"> 当前位置：<span class="text-primary">京东助手</span>  </div>

<div class="page-content">
    <div class='alert alert-danger'>1.尽量在服务器空闲时间来操作，会占用大量内存与带宽，在获取过程中，请不要进行任何操作!
        </br>2.由于京东商品规格为不同链接的商品，所以京东助手无法获取京东商品内的其他规格!
        </br>3.暂不支持全球购等海外商品链接
        </br>4.每次添加的商品链接请保持在3个以内.
    </div>

    <form id="dataform" action="" method="post" class="form-horizontal form">

        <div class="form-group">
            <label class="col-lg control-label must">链接 或 itemId</label>
            <div class="col-sm-9">
                <textarea id="url" name="url" class="form-control" rows="5"></textarea>
                <span class="help-block">例如商品链接为: http://item.jd.com/1856582.html,直接输入商品链接或输入商品ID:1856582</span>
                <span class="help-block">每行仅限输入一个链接或一个商品ID可多行输入</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg control-label">设置分类</label>

            <div class="col-sm-9">
                <select id="cates"  name='cates[]' class="form-control select2" style='width:605px;' multiple='' >
                    <?php  if(is_array($category)) { foreach($category as $c) { ?>
                    <option value="<?php  echo $c['id'];?>" ><?php  echo $c['name'];?></option>
                    <?php  } } ?>
                </select>
            </div>

        </div>
        <div class="form-group">
            <label class="col-lg control-label"> </label>
            <div class="col-sm-9">
                <span class="help-block">此分类读取的是商城的商品分类, 设置默认抓取商品的分类</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg control-label"> </label>
            <div class="col-sm-9">
                <input id="btn_submit" type="button"  value="立即获取" class="btn btn-primary"  onclick="formcheck()"/>
            </div>
        </div>

    </form>
</div>
<script type="text/javascript">

    $(function () {
        if (confirm('由于京东防盗链规则改变，请使用淘宝助手客户端进行抓取!\n现在去配置客户端?')) {
            location.href = "<?php  echo webUrl('taobao/set')?>";
        }
    });

    var category = <?php  echo json_encode($children)?>;

    var len = 0;
    var urls = [];
    var total = 0;
    function formcheck() {

        if ($(":input[name='url']").val() == '') {
            tip.msgbox.err("请输入商品链接或itemId!");
            $(":input[name='url']").focus();
            return;
        }
        $("#dataform").attr("disabled", "true");
        $("#btn_submit").val("正在获取中...").removeClass("btn-primary").attr("disabled", "true");

        urls = $("#url").val().split('\n');
        total = urls.length;

        if(total>3)
        {
            tip.msgbox.err("单次获取的商品数量请不要超过3个,以免会影响抓取效率!");

            $("#btn_submit").val("立即获取").addClass("btn-primary").removeAttr("disabled");
            return;
        }

        $("#btn_submit").val("检测到需要获取 " + total + " 个宝贝, 请等待开始....");
        fetch_next();
        return;
    }
    function fetch_next() {
        var cates =$("#cates").val();
        var postdata =  {
            url: urls[len],
            cate: cates
        };

        $.post("<?php  echo webUrl('taobao/jingdong/fetch')?>", postdata, function (data) {
            len++;
            $("#btn_submit").val("已经获取  " + len + " / " + total + " 个宝贝, 请等待....");
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

