<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!-- Верстка меню
	<div class="menu-block popup-wrap">
		<a href="" class="btn-menu btn-toggle"></a>
		<div class="menu popup-block">
				<ul class="">
						<li class="main-page"><a href="">Главная</a>
						</li>
							<li>
									<a href="">Компания</a>
									<ul>
											<li>
													<a href="">Пункт 1</a>
													<ul>
															<li><a href="">Пункт 1</a>
															</li>
															<li><a href="">Пункт 2</a>
															</li>
													</ul>
											</li>
											<li><a href="">Пункт 2</a>
											</li>
											<li><a href="">Пункт 3</a>
											</li>
											<li><a href="">Пункт 4</a>
											</li>
									</ul>
							</li>
						<li><a href="">Новости</a>
						</li>
						<li>
								<a href="">Каталог</a>
								<ul>
										<li>
												<a href="">Пункт 1</a>
												<ul>
														<li><a href="">Пункт 1</a>
														</li>
														<li><a href="">Пункт 2</a>
														</li>
												</ul>
										</li>
										<li><a href="">Пункт 2</a>
										</li>
										<li><a href="">Пункт 3</a>
										</li>
										<li><a href="">Пункт 4</a>
										</li>
								</ul>
						</li>
							<li><a href="">Фотогалерея</a>
							</li>
							<li><a href="">Партнерам</a>
							</li>
							<li><a href="">Контакты</a>
							</li>
											</ul>
											<a href="" class="btn-close"></a>
									</div>
									<div class="menu-overlay"></div>
							</div>
/ Верстка меню -->

<pre><?//var_export($arResult)?></pre>

<?if (!empty($arResult)):?>
<div class="menu-block popup-wrap">
<a href="" class="btn-menu btn-toggle"></a>
<div class="menu popup-block">
	<ul id="horizontal-multilevel-menu">
		<li class="main-page"><a href="/s2/"><?=GetMessage("MAIN")?></a></li>

		<?
		$previousLevel = 0;
		foreach($arResult as $arItem):?>

			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): // Закрываем предыдущий пункт меню ?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>

			<?if ($arItem["IS_PARENT"]): // если пункт меню имеет дочерние ?>

				<?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень меню 1-й ?>
					<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
						<ul>
				<?else: // если уровень меню больше 1-го?>
					<li <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
						<ul>
				<?endif?>

				<!-- ОПИСАНИЕ ДЛЯ п. меню -->
				<?if (isset($arItem["PARAMS"]["DESCRIPTION"])):?>
					<div class="menu-text">
						<?=$arItem["PARAMS"]["DESCRIPTION"]?>
					</div>
				<?endif?>

			<?else: // если пункт меню НЕ имеет дочерние?>

				<?if ($arItem["PERMISSION"] > "D"): // если к пункту меню НЕТ доступа?>

					<?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень меню 1-й?>
						<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
					<?else: // если уровень меню больше 1-го?>
						<li <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>

				<?else: // если к пункту меню есть доступ?>

					<?if ($arItem["DEPTH_LEVEL"] == 1): // если уровень меню 1-й?>
						<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?else: // если уровень меню больше 1-го?>
						<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>

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