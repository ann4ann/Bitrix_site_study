<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

?>

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<? foreach ($arResult["ITEMS"] as $arItem): ?>
	<?

	$itemDate = $arItem["DISPLAY_ACTIVE_FROM"] . ' ' . GetMessage('YEAR_SHORT_LETTER');

	$itemPosition = $arItem['DISPLAY_PROPERTIES']['POSITION']['DISPLAY_VALUE']; 
	$itemCompany = $arItem['DISPLAY_PROPERTIES']['COMPANY']['DISPLAY_VALUE'];

	#region Уменьшаем картинку на лету
	$defaultImageSrc = SITE_TEMPLATE_PATH . '/img/rew/no_photo.jpg';
	$altImg = $arItem["DETAIL_PICTURE"]["ALT"] ?? 'img';

	if( is_array($arItem["DETAIL_PICTURE"]) ) {
		$resizedImage = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], ["width" => 68, "height" => 50], BX_RESIZE_IMAGE_EXACT);		
	}
	$itemImageSrc = $resizedImage["src"] ?? $defaultImageSrc;
	#endregion
	
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
																				 array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$areaId = $this->GetEditAreaId($arItem['ID']);
	?>

	<div class="review-block" id="<?=$areaId?>">

		<div class="review-text">

			<!-- Имя, дата, должность и компания -->
			<div class="review-block-title">
				<!-- Имя - NAME -->
				<span class="review-block-name">
					<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
						<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
							<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
								<?echo $arItem["NAME"]?>
							</a>
						<?else:?>
							<?echo $arItem["NAME"]?>
						<?endif;?>
					<?endif;?>
				</span>
				<!-- Дата, должность и компания -->
				<span class="review-block-description">
					<?= "{$itemDate}, {$itemPosition}, {$itemCompany}" ?>
				</span>
			</div>

			<!-- Детальное описание -->
			<div class="review-text-cont">
				<? // Детальное описание - PREVIEW_TEXT
				if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<?echo $arItem["PREVIEW_TEXT"];?>
				<?endif;?>
			</div>

		</div>

		<? // Картинка - PREVIEW_PICTURE
		if( $arParams["DISPLAY_PICTURE"]!="N" ): ?>
			<div class="review-img-wrap">
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<img src="<?=$itemImageSrc?>"
								 alt="<?=$altImg?>" />
					</a>
				<?else:?>
					<img src="<?=$itemImageSrc?>"
							 alt="<?=$altImg?>" />
				<?endif;?>
			</div>
		<?endif?>

	</div>
<?endforeach;?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

