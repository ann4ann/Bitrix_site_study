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

if (!function_exists('mb_ucfirst') && function_exists('mb_substr')) {
	function mb_ucfirst($string) {
			$string = mb_strtoupper(mb_substr($string, 0, 1)) . mb_substr($string, 1);
			return $string;
	}
}

?>

<div class="item-wrap">
	<div class="rew-footer-carousel">
		<? foreach ($arResult["ITEMS"] as $arItem): 
			
			$itemPosition = mb_ucfirst( $arItem['DISPLAY_PROPERTIES']['POSITION']['DISPLAY_VALUE'] ); // Первую буква должности делаем заглавной
			$itemCompany = $arItem['DISPLAY_PROPERTIES']['COMPANY']['DISPLAY_VALUE'];

			$itemImageSrc = SITE_TEMPLATE_PATH . '/img/rew/no_photo_left_block.jpg'; // Ставим default картинку, потом заменяем на нужную, если она есть
			$altImg = $arItem["PREVIEW_PICTURE"]["ALT"] ?? 'img';

			if( $arItem["PREVIEW_PICTURE"] )
			{
				$resizedImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], ["width" => 39, "height" => 39], BX_RESIZE_IMAGE_PROPORTIONAL);
				$resizedImageSrc = $resizedImage["src"];

				if( $resizedImageSrc ) {
					$itemImageSrc = $resizedImageSrc;
				}
			}

			$substrText = TruncateText($arItem["PREVIEW_TEXT"], 150);

			// echo '<pre>';
			// var_export($itemImageSrc );
			// echo '</pre>';
			
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
