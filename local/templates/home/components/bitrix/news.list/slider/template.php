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
<?
  use \Bitrix\Main\Localization\Loc as Lc; 
  Lc::loadMessages(__FILE__);
?>

<div class="slide-one-item home-slider owl-carousel">

	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>

	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>

		<div 
			id="<?=$this->GetEditAreaId($arItem['ID']);?>"
			class="site-blocks-cover" 
			style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);" 
			data-aos="fade"
			data-stellar-background-ratio="0.5"
		>

			<div class="text">

				<!-- <pre><?//var_export($arItem)?></pre> -->

				<h2><?echo $arItem["NAME"]?></h2>
				<p class="location">
					<span class="property-icon icon-room"></span> 
					<?$arItem["PREVIEW_TEXT"]?>
				</p>
				<p class="mb-2"><strong>$ <?echo $arItem["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"]?></strong></p>
				<p class="mb-0">
					<a 
						href="<?=$arItem["DETAIL_PAGE_URL"]?>" 
						class="text-uppercase small letter-spacing-1 font-weight-bold"
					>
						<?=Lc::getMessage("DETAILS")?>
					</a>
				</p>

			</div>
		</div>
	<?endforeach;?>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<br /><?=$arResult["NAV_STRING"]?>
	<?endif;?>

</div>