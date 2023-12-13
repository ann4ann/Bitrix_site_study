<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!-- <pre>
	<?//var_export($arResult)?>
</pre> -->

<?if (!empty($arResult)):?>

<nav class="site-navigation text-right text-md-right" role="navigation">

	<div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
		<a href="#" class="site-menu-toggle js-menu-toggle text-black">
			<span class="icon-menu h3"></span>
		</a>
	</div>

	<ul class="site-menu js-clone-nav d-none d-lg-block">

	<?
	$previousLevel = 0;
	foreach($arResult as $arItem):
	?>

		<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
		<?endif?>

		<?if ($arItem["IS_PARENT"]):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1 || $arItem["DEPTH_LEVEL"] == 2):?>
				<li class="has-children">
					<a href="<?=$arItem["LINK"]?>" >
						<?=$arItem["TEXT"]?>
					</a>
					<ul class="dropdown">
			<?else:?>
				<li <?if ($arItem["SELECTED"]):?> class="active"<?endif?>>
					<a href="<?=$arItem["LINK"]?>">
						<?=$arItem["TEXT"]?>
					</a>
					<ul class="dropdown">
			<?endif?>

		<?else:?>

			<?if ($arItem["PERMISSION"] > "D"):?>
				
				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li>
						<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					</li>
				<?else:?>
						<li <?if ($arItem["SELECTED"]):?> class="active"<?endif?>>
							<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
						</li>
				<?endif?>

			<?endif?>

		<?endif?>

		<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

	<?endforeach?>

	<?if ($previousLevel > 1)://close last item tags?>
		<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
	<?endif?>

	</ul>

</nav>

<?endif?>