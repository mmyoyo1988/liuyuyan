<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
 
<div class="page-header">
    当前位置：<span class="text-primary"><?php  if(!empty($item['id'])) { ?>编辑<?php  } else { ?>添加<?php  } ?>海报 <small><?php  if(!empty($item['id'])) { ?>修改【<?php  echo $item['title'];?>】<?php  } ?></small></span>
</div>

<script language='javascript' src="../addons/ewei_shopv2/plugin/postera/static/js/designer.js"></script>

<style type='text/css'>
    #postera {
        width:320px;height:504px;border:1px solid #ccc;position:relative
    }
   #postera .bg { position:absolute;width:100%;z-index:0}
   #postera .drag[type=img] img,#postera .drag[type=thumb] img { width:100%;height:100%; }
   <?php if( ce('postera' ,$item) ) { ?> 
   #postera .drag { position: absolute; width:80px;height:80px; border:1px solid #000; }
   <?php  } else { ?>
   #postera .drag { position: absolute; width:80px;height:80px; }
   <?php  } ?> 
    
    #postera .drag[type=nickname],#postera .drag[type=time] { width:80px;height:40px; font-size:16px; font-family: 黑体;}
    #postera .drag img {position:absolute;z-index:0;width:100%; }
    
    #postera .rRightDown,.rLeftDown,.rLeftUp,.rRightUp,.rRight,.rLeft,.rUp,.rDown{
            position:absolute;
            width:7px;
            height:7px;
            z-index:1;
            font-size:0;
    }    
 
    <?php if( ce('postera' ,$item) ) { ?> 
       #postera .rRightDown,.rLeftDown,.rLeftUp,.rRightUp,.rRight,.rLeft,.rUp,.rDown{
              background:#C00;
       }
    <?php  } ?>
    .rLeftDown,.rRightUp{cursor:ne-resize;}
    .rRightDown,.rLeftUp{cursor:nw-resize;}
    .rRight,.rLeft{cursor:e-resize;}
    .rUp,.rDown{cursor:n-resize;}
    .rLeftDown{left:-4px;bottom:-4px;}
    .rRightUp{right:-4px;top:-4px;}
    .rRightDown{right:-4px;bottom:-4px;}
       <?php if( ce('postera' ,$item) ) { ?> 
            .rRightDown{background-color:#00F;}   
       <?php  } ?>
    
    .rLeftUp{left:-4px;top:-4px;}
    .rRight{right:-4px;top:50%;margin-top:-4px;}
    .rLeft{left:-4px;top:50%;margin-top:-4px;}
    .rUp{top:-4px;left:50%;margin-left:-4px;}
    .rDown{bottom:-4px;left:50%;margin-left:-4px;}
    .context-menu-layer { z-index:9999;}
    .context-menu-list { z-index:9999;}

</style>
 <div class="page-content">
     <div class="page-sub-toolbar">
         <span class=''>
                <?php if(cv('postera.add')) { ?>
                    <a class="btn btn-primary btn-sm" href="<?php  echo webUrl('postera/add')?>">添加新海报</a>
                <?php  } ?>
            </span>
             </div>
    <form action="" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
   <ul class="nav nav-arrow-next nav-tabs" id="myTab">
                    <li <?php  if($_GPC['tab']=='basic' || empty($_GPC['tab'])) { ?>class="active"<?php  } ?> ><a href="#tab_basic">基本</a></li>
                    <li <?php  if($_GPC['tab']=='design') { ?>class="active"<?php  } ?> ><a href="#tab_design">设计</a></li>
                    
                    
                    <li class="<?php  if($_GPC['tab']=='reward') { ?>active<?php  } ?>"><a href="#tab_reward">奖励</a></li>
                    <li class="<?php  if($_GPC['tab']=='resp') { ?>active<?php  } ?>"><a href="#tab_resp">推送</a></li>
                    <li class="<?php  if($_GPC['tab']=='notice') { ?>active<?php  } ?>"><a href="#tab_notice">通知</a></li>
                    <li class="<?php  if($_GPC['tab']=='commission') { ?>active<?php  } ?>"><a href="#tab_commission">分销</a></li>
                </ul> 
     
                <div class="tab-content">
                    <div class="tab-pane  <?php  if($_GPC['tab']=='basic' || empty($_GPC['tab'])) { ?>active<?php  } ?>" id="tab_basic"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('postera/post/basic', TEMPLATE_INCLUDEPATH)) : (include template('postera/post/basic', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane  <?php  if($_GPC['tab']=='design') { ?>active<?php  } ?>" id="tab_design"><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('postera/post/design', TEMPLATE_INCLUDEPATH)) : (include template('postera/post/design', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane  <?php  if($_GPC['tab']=='resp') { ?>active<?php  } ?>" id="tab_resp" ><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('postera/post/resp', TEMPLATE_INCLUDEPATH)) : (include template('postera/post/resp', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane <?php  if($_GPC['tab']=='reward') { ?>active<?php  } ?>" id="tab_reward"  ><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('postera/post/reward', TEMPLATE_INCLUDEPATH)) : (include template('postera/post/reward', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane <?php  if($_GPC['tab']=='notice') { ?>active<?php  } ?>" id="tab_notice" ><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('postera/post/notice', TEMPLATE_INCLUDEPATH)) : (include template('postera/post/notice', TEMPLATE_INCLUDEPATH));?></div>
                    <div class="tab-pane <?php  if($_GPC['tab']=='commission') { ?>active<?php  } ?>" id="tab_commission"  ><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('postera/post/commission', TEMPLATE_INCLUDEPATH)) : (include template('postera/post/commission', TEMPLATE_INCLUDEPATH));?></div>
            </div> 
        
        <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-lg control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if( ce('postera' ,$item) ) { ?>
                            <input type="submit" value="提交" class="btn btn-primary"  />
                            
                            <input type="hidden" name="data" value="" />
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('postera.add|postera.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                    </div>
            </div>
  
 
    </form>
 </div>
<script language='javascript'>
  require(['bootstrap'],function(){
             $('#myTab a').click(function (e) {
                 e.preventDefault();
                $('#tab').val( $(this).attr('href'));
                 $(this).tab('show');
             })
     });
     
	function showGoodsSelect(show){
		if(show){
			$('#goodsdiv').show();
		}
		else{
			$('#goodsdiv').hide();
		}
	}
	 
    $('form').submit(function(){
       
        if($(':radio[name=type]:checked').val()=='4'){
            
             if($(':radio[name=paytype]:checked').val()=='1'){
              
                var recmoney = parseFloat($(':input[name=recmoney]').val());
                if( recmoney>0 ){
                        if(recmoney<1){
                            $(':input[name=recmoney]').focus();
                            tip.msgbox.err('微信企业付款需支付1元以上!');
                            $('form').attr('stop',1);
                            return false;
                        }
                }
                var submoney = parseFloat($(':input[name=submoney]').val());
                if(submoney>0){
                    if(submoney<1){
                        $(':input[name=submoney]').focus();
                        tip.msgbox.err('微信企业付款需支付1元以上!');
                        $('form').attr('stop',1);
                        return false;
                    }
                }
             }
        }
        var data = [];
        $('.drag').each(function(){
            var obj = $(this);
            var type = obj.attr('type');
            var left = obj.css('left'),top = obj.css('top');
            var d= {left:left,top:top,type:obj.attr('type'),width:obj.css('width'),height:obj.css('height')};
            if(type=='nickname' ||type=='title' || type=='marketprice' || type=='productprice' || type=='time'){
                d.size = obj.attr('size');
                d.color = obj.attr('color');
            } else if(type=='qr'){
                d.size = obj.attr('size');
            } else if(type=='img'){
                d.src = obj.attr('src');
            }
            data.push(d);
        });
        $(':input[name=data]').val( JSON.stringify(data));
        $('form').removeAttr('stop');
        return true;
       
    });
        
        function bindEvents(obj){
            
              var index = obj.attr('index');
              
                 var rs = new Resize(obj, { Max: true, mxContainer: "#postera" });
            rs.Set($(".rRightDown",obj), "right-down");
            rs.Set($(".rLeftDown",obj), "left-down");
            rs.Set($(".rRightUp",obj), "right-up");
            rs.Set($(".rLeftUp",obj), "left-up");
            rs.Set($(".rRight",obj), "right");
            rs.Set($(".rLeft",obj), "left");
            rs.Set($(".rUp",obj), "up");
            rs.Set($(".rDown",obj), "down"); 
            rs.Scale = true;
            var type = obj.attr('type');
            if(type=='nickname' || type=='img' || type=='title' || type=='marketprice' || type=='productprice' || type=='time'){
                rs.Scale = false;
            }
            new Drag(obj, { Limit: true, mxContainer: "#postera" });
            $('.drag .remove').unbind('click').click(function(){
                $(this).parent().remove();
            })
          myrequire(['jquery.contextMenu'],function(){
         $.contextMenu({
                selector: '.drag[index=' + index + ']',
                callback: function(key, options) {
                    var index = parseInt($(this).attr('zindex'));
                    
                    if(key=='next'){
                        var nextdiv = $(this).next('.drag');
                        if(nextdiv.length>0 ){
                           nextdiv.insertBefore($(this));  
                        }
                    } else if(key=='prev'){
                        var prevdiv = $(this).prev('.drag');
                        if(prevdiv.length>0 ){
                           $(this).insertBefore(prevdiv);  
                        } 
                    } else if(key=='last'){
                        var len = $('.drag').length;
                         if(index >=len-1){
                            return;
                        } 
                        var last = $('#postera .drag:last');
                        if(last.length>0){
                           $(this).insertAfter(last);  
                        }
                    }else if(key=='first'){
                        var index = $(this).index();
                        if(index<=1){
                            return;
                        }
                        var first = $('#postera .drag:first');
                        if(first.length>0){
                           $(this).insertBefore(first);  
                        }
                    }else if(key=='delete'){
                       $(this).remove();
                    }
                    var n =1 ;
                    $('.drag').each(function(){
                        $(this).css("z-index",n);
                        n++; 
                    })
                },
                items: {
                    "next": {name: "调整到上层"},
                    "prev": {name: "调整到下层"},
                    "last": {name: "调整到最顶层"},
                    "first": {name: "调整到最低层"},
                    "delete": {name: "删除元素"}
                }
            });
            obj.unbind('click').click(function(){
                bind($(this));
            })
            
              });
              
        }
   var imgsettimer = 0 ;
   var nametimer = 0;
   var bgtimer = 0 ;
         function bindType(type){
             $("#goodsparams").hide();
             $(".type4").hide();
             if(type=='4'){
                 $(".type4").show();    
             } else if(type=='3'){
                    $("#goodsparams").show();
             }
         }
         function clearTimers(){
           clearInterval(imgsettimer);
           clearInterval(nametimer);
           clearInterval(bgtimer);
           
         }
         function getImgUrl(val){
       
              if(val.indexOf('http://')==-1){
                  val = "<?php  echo $imgroot;?>" + val;
              }
              return val;
         }
         function bind(obj){
            var imgset = $('#imgset'), nameset = $("#nameset"),qrset = $('#qrset');
             imgset.hide(),nameset.hide(),qrset.hide();
             clearTimers();
               var type = obj.attr('type');
               if(type=='img'){
                   imgset.show();
                   var src = obj.attr('src');
                   var input = imgset.find('input');
                   var img = imgset.find('img');
                   if(typeof(src)!='undefined' && src!=''){
                       input.val(src); 
                       img.attr('src',getImgUrl(src));
                  }
                   
                   imgsettimer = setInterval(function(){
                       if(input.val()!=src && input.val()!=''){
                           var url = getImgUrl(input.val());
                         
                           obj.attr('src',input.val()).find('img').attr('src',url);
                       }
                   },10);
                   
             } else if(type=='nickname' || type=='title' || type=='marketprice' || type=='productprice' || type=='time'){
       
                  nameset.show();
                  var color = obj.attr('color') || "#000";
                  var size = obj.attr('size') || "16";
                  var input = nameset.find('input:first');
                  var namesize = nameset.find('#namesize');
                  var picker = nameset.find('.sp-preview-inner');
                  input.val(color); namesize.val(size.replace("px",""));  
                  picker.css( {'background-color':color,'font-size':size});
                      
                  nametimer = setInterval(function(){
                       obj.attr('color',input.val()).find('.text').css('color',input.val());
                       obj.attr('size',namesize.val() +"px").find('.text').css('font-size',namesize.val() +"px");
                   },10);
                   
             } else if(type=='qr'){
                 qrset.show();
                 var size = obj.attr('size') || "3";
                 var sel = qrset.find('#qrsize');
                 sel.val(size);
                 sel.unbind('change').change(function(){
                      obj.attr('size',sel.val()) 
                 });
             }  
         }
         
    $(function(){
        <?php  if(!empty($item['id'])) { ?>
               <?php if( ce('postera' ,$item) ) { ?> 
          $('.drag').each(function(){
              bindEvents($(this));
          })
          <?php  } ?>
        <?php  } ?>
            
            $(':radio[name=type]').click(function(){
                var type = $(this).val();
                bindType(type);
            })

        $(':radio[name=resptype]').click(function(){
            var type = $(this).val();
            if(type == 1)
            {
                $(".resptype1").show();
                $(".resptype0").hide();
            }
            else
            {
                $(".resptype0").show();
                $(".resptype1").hide();
            }
        })
        //改变背景
        $('#bgset').find('button:first').click(function(){
            var oldbg = $(':input[name=bg]').val();
            bgtimer = setInterval(function(){
                 var bg = $(':input[name=bg]').val();
                 if(oldbg!=bg){
                 	  bg = getImgUrl(bg);
                       
                      $('#postera .bg').remove();
                      var bgh = $("<img src='" + bg + "' class='bg' />");
                       var first = $('#postera .drag:first');
                        if(first.length>0){
                           bgh.insertBefore(first);  
                        } else{
                           $('#postera').append(bgh);      
                        }
                       
                      oldbg = bg;
                 }
            },10);
        })
           
        $('.btn-com').click(function(){
            
           var imgset = $('#imgset'), nameset = $("#nameset"),qrset = $('#qrset');
           imgset.hide(),nameset.hide(),qrset.hide();
           clearTimers();
      
            if($('#postera img').length<=0){
                //alert('请选择背景图片!');
                //return;
            }
            var type = $(this).data('type');
            var img = "";
            if(type=='qr'){
                img = '<img src="../addons/ewei_shopv2/plugin/postera/static/images/qr.jpg" />';
            }
            else if(type=='head'){
                img = '<img src="../addons/ewei_shopv2/plugin/postera/static/images/head.jpg" />';
            }else  if(type=='img' || type=='thumb'){
                img = '<img src="../addons/ewei_shopv2/plugin/postera/static/images/img.jpg" />';
            } 
            else if(type=='nickname'){
                img = '<div class=text>昵称</div>';
            }
	  else if(type=='time'){
                img = '<div class=text>失效时间</div>';
            }  else if(type=='title'){
                img = '<div class=text>商品名称</div>';
            } else if(type=='marketprice'){
                img = '<div class=text>商品现价</div>';
            }else if(type=='productprice'){
                img = '<div class=text>商品原价</div>';
            }
            var index = $('#postera .drag').length+1;
            var obj = $('<div class="drag" type="' + type +'" index="' + index +'" style="z-index:' + index+'">' + img+'<div class="rRightDown"> </div><div class="rLeftDown"> </div><div class="rRightUp"> </div><div class="rLeftUp"> </div><div class="rRight"> </div><div class="rLeft"> </div><div class="rUp"> </div><div class="rDown"></div></div>');
            
            $('#postera').append(obj);
            
            bindEvents(obj);
            
        });
    
         $('.drag').click(function(){
               bind($(this))     ;
         })
        
    })
	 
	
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>

