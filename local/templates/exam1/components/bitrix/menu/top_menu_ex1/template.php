<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<pre><?//var_export($arResult)?></pre>

<?if (!empty($arResult)):?>
	
<div class="menu-block popup-wrap">
	<a href="" class="btn-menu btn-toggle"></a>
	<div class="menu popup-block">
		<ul id="horizontal-multilevel-menu">
			<li class="main-page"><a href="/s2/"><?=GetMessage("MAIN")?></a></li>

			<?
			$previousLevel = 0;
			foreach($arResult as $arItem):
				if($arItem["PERMISSION"] == "D") 
					continue;
			?>

				<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): // Закрываем предыдущий пункт меню ?>
					<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
				<?endif?>

				<!-- get CLASS_STYLE Value -->
				<?
					$classStyle = $arItem["PARAMS"]["CLASS_STYLE"] ?? "";
				?>

				<?if ($arItem["IS_PARENT"]): // если пункт меню имеет дочерние ?>

					<?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень меню 1-й ?>
						<li>
							<a href="<?=$arItem["LINK"]?>" class="<?=$classStyle?>">
								<?=$arItem["TEXT"]?>
							</a>
								<ul>
					<?else: // если уровень меню больше 1-го?>
						<li>
							<a href="<?=$arItem["LINK"]?>" >
								<?=$arItem["TEXT"]?>
							</a>
								<ul>
					<?endif?>

					<!-- ОПИСАНИЕ ДЛЯ п. меню -->
					<?if (isset($arItem["PARAMS"]["DESCRIPTION"])):?>
						<div class="menu-text">
							<?=$arItem["PARAMS"]["DESCRIPTION"]?>
						</div>
					<?endif?>

				<?else: // если пункт меню НЕ имеет дочерние?>

					<?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень меню 1-й?>
						<li>
							<a href="<?=$arItem["LINK"]?>" class="<?=$classStyle?>">
								<?=$arItem["TEXT"]?>
							</a>
						</li>
					<?else: // если уровень меню больше 1-го?>
						<li>
							<a href="<?=$arItem["LINK"]?>">
								<?=$arItem["TEXT"]?>
							</a>
						</li>
					<?endif?>

				<?endif?>

				<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

			<?endforeach?>

			<?if ($previousLevel > 1)://close last item tags?>
				<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
			<?endif?>

		</ul>
		<div class="menu-clear-left"></div>

		<a href="" class="btn-close"></a>
	</div>
	<div class="menu-overlay"></div>
</div>

<?endif?>