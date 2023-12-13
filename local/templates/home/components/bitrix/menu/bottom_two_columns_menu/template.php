<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
  use \Bitrix\Main\Localization\Loc as Lc; 
  Lc::loadMessages(__FILE__);
?>

<?if (!empty($arResult)):?>
	<?
		$columnMaxLengthIndex = intdiv(sizeof($arResult) + 1, 2) - 1;
	?>
	<div class="row mb-5">
		<div class="col-md-12">
			<h3 class="footer-heading mb-4">
				<?=Lc::getMessage("NAVIGATION")?>
			</h3>
		</div>

		<div class="col-md-6 col-lg-6">
			<ul class="list-unstyled">

			<?$previousLevel = 0;
				foreach($arResult as $key => $arItem):?>

					<?if ($arItem["PERMISSION"] > "D"):?>
						<li>
							<a href="<?=$arItem["LINK"]?>">
								<?=$arItem["TEXT"]?>
							</a>
						</li>
					<?endif?>

					<?if ($key == $columnMaxLengthIndex):?>
						</ul></div>

						<div class="col-md-6 col-lg-6"><ul class="list-unstyled">
					<?endif?>

				<?endforeach?>
			
			</ul>
		</div>
	</div>

<?endif?>