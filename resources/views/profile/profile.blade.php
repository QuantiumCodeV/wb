<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina">

<head>
	<style>
		:root {

			--image-path: url('<?php echo asset("/assets/foot_nav.png") ?>');
			--image-path2: url('<?php echo asset("/assets/dd_icon.png") ?>');

			--image-path3: url('<?php echo asset("/assets/zt_ico.jpg") ?>');

			--image-path4: url('<?php echo asset("/assets/ck_ico.png") ?>');
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title>персональный центр - Wildberries</title>
	<meta name="keywords" content="Платформа обратного выкупа для российских торговцев">
	<meta name="description"
		content="Коллекции женской, мужской и детской одежды, обуви, а также товары для дома и спорта. Информация о доставке и оплате. Таблицы размеров, советы по уходу за вещами.">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" type="image/ico" href="https://wbbff.cc/favicon.ico">
	<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style.css") ?>">
	<script type="text/javascript" src="<?php echo asset("assets/jquery.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/global.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/arttpl.js") ?>"></script>

	<link href="<?php echo asset("assets/layer.css") ?>" type="text/css" rel="styleSheet" id="layermcss">
</head>

<body>
	<div class="content" style="margin-bottom:62px;">
		<div class="user_info">
			<div class="user_tt">Профиль</div>
			<div class="user_tx_box">
				<div class="user_tx">
					<!-- <a href="user.php?mod=setting&act=logo"> --><img
						src="<?php echo asset("assets/thumb__120x_120_noavatar.jpg") ?>">
				</div>
				<div class="user_text">
					<div class="">{{ $user->login }}
						<p class="mat10"><span class="dj_btn">VIP0</span></p>
					</div>
				</div>
			</div>

		</div>
		<div class="side_all">

			<div class="nav">
				<a class="tgdd_tt" href="<?php echo route("order") ?>"><span class="fl">Мой заказ</span><span
						class="fr c888 font13">Узнать более</span><i class="more_jt"></i></a>
				<ul style="display:flex; justify-content: space-between;">
					<li><a href="<?php echo route("order") ?>"><i class="user_tb4"></i>ещё не
							оплаченные <span> 1</span>
						</a></li>
					<li><a href="<?php echo route("order") ?>"><i class="user_tb2"></i>ещё не
							искуплен</a></li>

					<li><a href="<?php echo route("order") ?>"><i class="user_tb3"></i>уже
							искуплен</a></li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="nav">
				<a class="tgdd_tt" href="<?php echo route("history") ?>"><span class="fl">Мой кошелек</span></a>
				<div class="side_fh1">
					<a><span>{{ $user->balance }} ₾.</span>баланс</a>
					<a><span>0 </span>Точки</a>
					<a><span>0</span>купон</a>
					<div class="clear"></div>
				</div>

				<div class="clear"></div>
			</div>

			<div class="ck_nav mat10">
				<ul>

					<li><a href="<?php echo route("deposit") ?>"><i class="user_tb11"></i>Пополнить<p></p></a></li>
					<li><a href="<?php echo route("cashout") ?>"><i class="user_tb12"></i>снятие<p>
							</p></a></li>
					<li><a href="<?php echo route("history") ?>"><i class="user_tb5"></i>История<p></p></a></li>
					<li><a href="<?php echo route("settings") ?>"><i class="ck_i4"></i><span>настройки</span>
							<p></p>
						</a></li>
					<!-- <li><a href="http://wildberriesrefund.com/"><i class="ck_i7"></i><span>退税</span><p></p></a></li> -->

					<li><a href="<?php echo route("payment.methods") ?>"><i class="user_tb1"></i><span>платежного
								счета</span>
							<p></p>
						</a></li>

					<!-- <li><a href="user.php?mod=comment"><i class="ck_i1"></i><span>我的评价</span><p></p></a></li> -->
					<!-- <li><a href=""><i class="ck_i3"></i><span>Поддержка</span><p></p></a></li> -->
					<li><a href="{{ $settings->linkManager }}"><i class="ck_i3"></i><span>Поддержка</span>
							<p></p>
						</a></li>
					<li><a href="<?php echo route("favorites") ?>"><i class="ck_i7"></i><span>Избранное</span>
							<p></p>
						</a></li>
					<li><a href="<?php echo route("delivery") ?>"><i class="ck_i5"></i><span>Адреса
								доставки</span>
							<p></p>
						</a></li>
					<li><a href="<?php echo route("about_us") ?>"><i class="ck_i6"></i><span>насчет нас</span>
							<p></p>
						</a></li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="ck_nav_xian"></div>
			<div class="side_ul mat10 mab10" style="display:none">
				<ul>
					<li class="side_i2"><a href="https://wbbff.cc/user.php?mod=comment">我的评价<span></span><i></i></a>
					</li>
					<li class="side_i1"><a href="<?php echo route("favorites") ?>">Избранное<span></span><i></i></a>
					</li>
					<li class="side_i3"><a href="<?php echo route("payment.methods") ?>">платежного
							счета<span></span><i></i></a></li>
					<li class="side_i4"><a href="<?php echo route("delivery") ?>">список
							адресов<span></span><i></i></a></li>
					<li class="side_i5"><a href="<?php echo route("settings") ?>">настройки<span></span><i></i></a>
					</li>
					<!-- <li><a href="user.php?mod=useraddr"><i class="ck_i3"></i><span>Адреса доставки</span><p></p></a></li> -->

					<li class="side_i7"><a href="<?php echo route("auth.logout") ?>">выйти<span></span><i></i></a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="foot_nav">
		<ul>


			<li><a href="<?php echo route("index") ?>"><i class="foot_i1"></i></a></li>


			<li><a href="<?php echo route("order") ?>"><i class="foot_i2"></i></a></li>
			<li><a href="<?php echo route("cart") ?>"><i class="foot_i5"></i></a></li>
			<!-- <li><a href="https://wbbff.cc/index.php/huodong/huodongindex"><i class="foot_i5"></i><span>повышение</span></a></li> -->

			<!-- <li><a href=""><i class="foot_i3"></i><span>Поддержка</span></a></li> -->
			<li><a href="<?php echo route("favorites") ?>"><i class="foot_i3"></i></a></li>
			<li><a href="<?php echo route("profile") ?>" class="sel"><i class="foot_i4"></i></a></li>



		</ul>
		<div class="clear"></div>
	</div>

	<link rel="stylesheet" href="<?php echo asset("assets/weui.min.css") ?>">
	<link rel="stylesheet" href="<?php echo asset("assets/jquery-weui.min.css") ?>">
	<script src="<?php echo asset("assets/jquery-weui.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/layer.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/app.js") ?>"></script>
	<script type="text/javascript">
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
	<script>
		function confirm_huigou(order_id) {
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