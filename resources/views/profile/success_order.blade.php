<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina">

<head>
	<style>
		:root {

			--image-path: url('<?php echo asset("/assets/foot_nav.png") ?>');
			--image-path2: url('<?php echo asset("/assets/dd_icon.png") ?>');

			--image-path5: url('<?php echo asset("/assets/ico_jia.png") ?>');

			--image-path6: url('<?php echo asset("/assets/ico_jian.png") ?>');

			--image-path7: url('<?php echo asset("/assets/icon_index.png") ?>');

			--image-path8: url('<?php echo asset("/assets/dui_2.png") ?>');

			--image-path9: url('<?php echo asset("/assets/dui_1.png") ?>');
		}
	</style>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title>Успешно отправлен заказ - Wildberries</title>
	<meta name="keywords" content="Платформа обратного выкупа для российских торговцев">
	<meta name="description" content="Коллекции женской, мужской и детской одежды, обуви, а также товары для дома и спорта. Информация о доставке и оплате. Таблицы размеров, советы по уходу за вещами.">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" type="image/ico" href="https://wbbff.cc/favicon.ico">
	<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style_002.css") ?>">
	<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style.css") ?>">

	<script type="text/javascript" src="<?php echo asset("assets/jquery.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/global.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/arttpl.js") ?>"></script>
	<link href="<?php echo asset("assets/layer.css") ?>" type="text/css" rel="styleSheet" id="layermcss">
</head>

<body style="overflow-y: auto;">


	<script type="text/javascript">
		page_loading();
	</script>
	<div class="pagetop">
		<div class="fh"><a href="<?php echo route("index") ?>"></a></div>
		<div>Успешно отправлен заказ</div>
		<!-- <div class="cd"><a href="javascript:top_menu();"></a></div> -->

		<div class="top_menu" id="top_menu">
			<ul>
				<li><a href="<?php echo route("index") ?>"><i class="top_tb1"></i><span>Главная</span></a></li>
				<li><a href="https://wbbff.cc/index.php/category"><i class="top_tb2"></i><span>Каталог</span></a></li>
				<li><a href="<?php echo route("cart") ?>"><i class="top_tb3"></i><span>Корзина</span></a></li>
				<li><a href="<?php echo route("profile") ?>"><i class="top_tb4"></i><span>Профиль</span></a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<form method="post" id="form">
		@csrf
		<input type="hidden" name="order_id" value="{{ $order->id }}">
		<div class="content" style="margin-top:10px">
			<div class="order_cg">
				<i class="tjcg_dui"></i>
				<div class="tjcg_tt">Заказ успешно отправлен!</div>
			</div>
			<div class="yhq_box">
				<div class="yhq_sel">
					<span class="fl c666">номер заказа:</span>
					<span class="fr">{{ $order->id }}</span>
					<div class="clear"></div>
				</div>
				<div class="yhq_sel">
					<span class="fl c666">Общая сумма:</span>
					<span class="fr">₾ {{ number_format(collect($order->order_description)->sum(fn($item) => $item['quantity'] * $item['price']), 2) }}</span>
					<div class="clear"></div>
				</div>
				<div class="yhq_sel">
					<span class="fl c666">способ оплаты:</span>
					<span class="fr r_jt" style="position:relative;">
						<span style="padding-right:15px;" onclick="app_page('page_payment');" id="payment_btn">{{ $order->method_pay }}</span>
						<i></i>
					</span>
					<div class="clear"></div>
				</div>
			</div>
			<!--<div class="yhq_box1" id="paypw_html">
		<div class="yhq_sel1">
			<span class="yhq_sel1_l c666">Код оплаты：</span>
			<span class="tjr_input">
				<input type="text" name="user_paypw"  placeholder="Введите фонды пароль" />
			</span>
			<div class="clear"></div>
		</div>
	</div>-->
			<!-- 	<div class="zc_box2 mat10" id="user_paypw">
		<div class="zc_list">
			<div class="zc_name">Код оплаты：</div>
			<div class="zc_text"><input type="password" name="user_paypw" value="" placeholder="Введите фонды пароль" /></div>
			<a class="zc_smsyzm" href="https://wbbff.cc/user.php?mod=setting&act=paypw&fromto=https%3A%2F%2Fwbbff.cc%2Findex.php%3Fmod%3Dorder%26act%3Dpay%26id%3D240820143911191">Сброс пароля</a>
		</div>
	</div> -->
			
			<!-- 	<div class="loginbtn" style="margin:15px 12px;">
		<input type="hidden" name="pe_token" value="75236c7c5fdf7ebfe3441c02863d0cb8" />
		<input type="hidden" name="pesubmit" />	
		<a href=""><input type="button" value="联系客服" /></a>
	</div> -->


			<!-- 	<div style="padding:20px"><div class="zc_name">温馨提示：</div>
	<div class="zc_name">如果您选择的支付方式为转账汇款，请前往Поддержка提交转账信息！</div></div> -->
			
			<div id="bank_text" style="display:none"></div>

			<script type="text/javascript" src="<?php echo asset("assets/wechat.js") ?>"></script>
			<script type="text/javascript">
				$(function() {
					//支付方式
					pe_select_radio('order_payment', "balance", function(json) {
						$("#payment_btn").html($(":input[name='order_payment']:checked").attr("payment_name"));
						app_page_close();
						if ($(":input[name='order_payment']:checked").val() == 'balance') {
							$("#user_paypw").show();
						} else {
							$("#user_paypw").hide();
						}
					});
				})
				//支付提交按钮
				function pay_btn() {
					order_payment = $(":input[name='order_payment']:checked").val();
					/*if (order_payment == 'balance' && $(":input[name='user_paypw']").val() == '') {
						layer.open({
						    content: 'Введите фонды пароль<p><input type="password" name="paypw" id="paypw" /></p>',
						    btn: ['подтвердить оплату', '重置Код оплаты'],
						    shadeClose: false,
						    yes: function(){
								var user_paypw = $('#paypw').val();
								if (user_paypw == '') {
									app_tip('Введите фонды пароль');
									return false;
								}
								$(":input[name='user_paypw']").val(user_paypw)
								//layer.closeAll();
								pay_btn();
						    }, no: function(index){
						    	app_open("https://wbbff.cc/user.php?mod=setting&act=paypw")
						    }
						});
						return false;
					}*/
					if (order_payment == 'bank') {
						layer.open({
							content: $("#bank_text").html(),
							btn: '确认'
						});
						return false;
					}
					app_submit("{{ route('api.order.pay') }}", function(json) {
						if (json.result) {
							app_open("{{ route('submit_order', ['order_id' => $order->id]) }}", 1000);
						}
					})
				}
			</script>

			<link rel="stylesheet" href="<?php echo asset("assets/weui.min.css") ?>">
			<link rel="stylesheet" href="<?php echo asset("assets/jquery-weui.min.css") ?>">
			<script src="<?php echo asset("assets/jquery-weui.js") ?>"></script>
			<script type="text/javascript" src="<?php echo asset("assets/layer.js") ?>"></script>
			<script type="text/javascript" src="<?php echo asset("assets/app.js") ?>"></script>
			<script type="text/javascript" src="<?php echo asset("assets/jquery.scrollLoading.js") ?>"></script>
			<script type="text/javascript">
				$(function() {
					$("img.js_imgload").scrollLoading();
				});
				//顶部菜单点击
				function top_menu() {
					if ($("#top_menu").is(":hidden")) {
						$("#top_menu").show();
					} else {
						$("#top_menu").hide();
					}
					$("#top_menu a").live("click", function() {
						$("#top_menu").hide();
					})
				}
				pe_loadscript("https://wbbff.cc/api.php?mod=cron");
			</script>

		</div>
	</form>
</body>

</html>