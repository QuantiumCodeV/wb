<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="pixel-ratio-2 retina">

<head><style>:root {

--image-path: url('<?php echo asset("/assets/foot_nav.png")?>');
--image-path2: url('<?php echo asset("/assets/dd_icon.png")?>');
}</style>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<title>насчет нас - Wildberries</title>
	<meta name="keywords" content="Платформа обратного выкупа для российских торговцев">
	<meta name="description"
		content="Коллекции женской, мужской и детской одежды, обуви, а также товары для дома и спорта. Информация о доставке и оплате. Таблицы размеров, советы по уходу за вещами.">
	<meta name="format-detection" content="telephone=no">
	<link rel="shortcut icon" type="image/ico" href="<?php echo asset("assets/favicon.ico")?>">
	<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style_002.css")?>">
	<link type="text/css" rel="stylesheet" href="<?php echo asset("assets/style.css")?>">

	<script type="text/javascript" src="<?php echo asset("assets/jquery.js")?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/global.js")?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/arttpl.js")?>"></script>
	<link href="<?php echo asset("assets/layer.css")?>" type="text/css" rel="styleSheet" id="layermcss">
</head>

<body>

	<script type="text/javascript">
		page_loading();
	</script>
	<div class="pagetop">
		<!-- <div class="fh"><a href="https://wbbff.cc/index.php/article/list-15"></a></div> -->
		<div class="fh"><a href="javascript:history.back(-1)"></a></div>
		<div>насчет нас</div>
		<!-- <div class="cd"><a href="javascript:top_menu();"></a></div> -->

		<div class="top_menu" id="top_menu">
			<ul>
				<li><a href="<?php  echo route("index") ?>"><i class="top_tb1"></i><span>Главная</span></a></li>
				<li><a href="https://wbbff.cc/index.php/category"><i class="top_tb2"></i><span>Каталог</span></a></li>
				<li><a href="<?php  echo route("cart") ?>"><i class="top_tb3"></i><span>Корзина</span></a></li>
				<li><a href="<?php  echo route("profile") ?>"><i class="top_tb4"></i><span>Профиль</span></a></li>
			</ul>
			<div class="clear"></div>
		</div>
	</div>
	<div class="content">
		<div class="dingdan_info1">
			<!-- 		<div class="mat10 font18 c333 aleft">насчет нас</div>
		<div class="mat10 font12 c999 fl">时间：2020-10-17 17:22</div> -->

			<!-- <div class="clear"></div> -->
			<!-- <div class="mat10 font12 c999 fr">Просмотрено 371979 человек</div> -->
			<!-- <div class="xian"></div> -->
			<div class="danye_main mat20">
				<p>Наша цель изменить жизнь людей,
					сделав простым доступ к огромному количеству качественных и недорогих
					товаров, предоставляя лучший сервис.</p>
				<p>Наши клиенты – в центре всего, что мы делаем,</p>
				<p>Доверие - главное. Мы строим долгосрочные отношения,</p>
				<p>Во всём, чем занимаемся, стремимся быть экспертами,</p>
				<p>Открыты для предложений и улучшений.</p>
				<p>Прозрачность - основа совместного бизнеса,</p>
				<p>Работаем, соблюдая этику бизнеса,</p>
				<p>Уважаем другие мнения и интересы,</p>
				<p>Выполняем обязательства и берем ответственность за свои решения,</p>
				<p>Нетерпимы к коррупции.</p>
				<p>wildberries - территория личной и коллективной самореализации,</p>
				<p>Мы - одна команда,</p>
				<p>Уважаем мнение и интересы людей,</p>
				<p>Ценим свободу, смелость и ответственность.</p>
				<p><span style="white-space-collapse: preserve;"> </span></p>
				<p><br></p>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(function () {
			$(".danye_main img").removeAttr("height").removeAttr("width");
		})
	</script>

	<link rel="stylesheet" href="<?php echo asset("assets/weui.min.css")?>">
	<link rel="stylesheet" href="<?php echo asset("assets/jquery-weui.min.css")?>">
	<script src="<?php echo asset("assets/jquery-weui.js")?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/layer.js")?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/app.js")?>"></script>
	<script type="text/javascript" src="<?php echo asset("assets/jquery.scrollLoading.js")?>"></script>
	<script type="text/javascript">
		$(function () {
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
			$("#top_menu a").live("click", function () {
				$("#top_menu").hide();
			})
		}
		pe_loadscript("https://wbbff.cc/api.php?mod=cron");
	</script>

</body>

</html>