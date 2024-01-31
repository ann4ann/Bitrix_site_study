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

<div class="item-wrap">
	<div class="rew-footer-carousel">
		<? foreach ($arResult["ITEMS"] as $arItem): 
			
			$itemPosition = $arItem['DISPLAY_PROPERTIES']['POSITION']['DISPLAY_VALUE'];
			$itemCompany = $arItem['DISPLAY_PROPERTIES']['COMPANY']['DISPLAY_VALUE'];

			#region Уменьшаем картинку на лету
			$defaultImageSrc = SITE_TEMPLATE_PATH . '/img/rew/no_photo_left_block.jpg';
			$altImg = $arItem["PREVIEW_PICTURE"]["ALT"] ?? 'img';

			if( is_array($arItem["PREVIEW_PICTURE"]) ) {
				$resizedImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], ["width" => 39, "height" => 39], BX_RESIZE_IMAGE_EXACT);		
			}
			$itemImageSrc = $resizedImage["src"] ?? $defaultImageSrc;
			#endregion

			$substrText = TruncateText($arItem["PREVIEW_TEXT"], 150);

		
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
																						array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			$areaId = $this->GetEditAreaId($arItem['ID']);

			?>

			<div class="item" id="<?= $areaId ?>" >
				<div class="side-block side-opin">
					<div class="inner-block">
							<div class="title">
								<div class="photo-block">
									<img src="<?=$itemImageSrc?>" alt="<?=$altImg?>" />
								</div>

								<!-- Имя - NAME -->
								<div class="name-block">
									<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
										<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
											<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
												<?=$arItem["NAME"]?>
											</a>
										<?else:?>
											<?=$arItem["NAME"]?>
										<?endif;?>
									<?endif;?>
								</div>
								
								<!-- Должность и компания -->
								<div class="pos-block">
									<?= "{$itemPosition}, {$itemCompany}" ?>
								</div>
							</div>

							<!-- 150 символов текста анонса - Preview Text -->
							<div class="text-block">
								<?=$substrText?>
							</div>
					</div>
				</div>
			</div>

		<?endforeach;?>

	</div>
</div>
