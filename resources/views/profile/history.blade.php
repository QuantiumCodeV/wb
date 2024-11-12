<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina">

<head>
	<style>
		:root {

			--image-path: url('<?php echo asset("/assets/foot_nav.png") ?>');
			--image-path2: url('<?php echo asset("/assets/dd_icon.png") ?>');

			--image-path3: url('<?php echo asset("/assets/zt_ico.jpg") ?>');

			--image-path4: url('<?php echo asset("/assets/ck_ico.png") ?>');

			--image-path3: url('<?php echo asset("/assets/zt_ico.jpg") ?>');

			--image-path10: url('<?php echo asset("/assets/ck_ico.png") ?>');
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title>Мой кошелек - Wildberries</title>
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
		<div class="fh"><a href="<?php echo route("profile") ?>"></a></div>
		<div>Мой кошелек</div>
		<!-- <div class="cd"><a href="javascript:top_menu();"></a></div> -->
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
	<div class="fenhong_box">
		<div class="zh_jb"><i></i></div>
		<div class="">баланс</div>
		<div class="fh_money"><span class="font20">₽</span>0.0</div>
	</div>
	<div class="tx_ul">
		<ul>
			<li class="side_i9"><a href="<?php echo route("deposit") ?>">Пополнить<span></span><i></i></a></li>
			<li class="side_i10"><a href="<?php echo route("cashout") ?>">снятие<span></span><i></i></a></li>
		</ul>
	</div>
	<div class="main">
		<div class="tx_tt"><i></i>История</div>
			<div class="jf_box" style="margin-top:0">
				<ul>
					@foreach($histories as $history)
					<li>
						<div class="jf_left">
							<p>{{ $history->description }}</p>
							<p class="font12">{{ $history->created_at }}</p>
						</div>
						<div class="jf_right">
							<p class="{{ $history->amount > 0 ? 'green' : 'red' }}">{{ $history->amount > 0 ? '+' : '-' }}₽ {{ abs($history->amount) }}</p>
							<p class="font12">{{ $history->status }}</p>
						</div>
					</li>
					@endforeach
				</ul>
				<style>
					.jf_box ul {
						list-style-type: none;
						padding: 0;
						margin: 0;
					}
					.jf_box li {
						display: flex;
						justify-content: space-between;
						padding: 10px 0;
						border-bottom: 1px solid #e0e0e0;
					}
					.jf_left, .jf_right {
						display: flex;
						flex-direction: column;
					}
					.jf_left p, .jf_right p {
						margin: 0;
					}
					.font12 {
						font-size: 12px;
						color: #888;
					}
					.green {
						color: #28a745;
					}
				</style>
			</div>
		<div class="fenye mab10"></div>
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