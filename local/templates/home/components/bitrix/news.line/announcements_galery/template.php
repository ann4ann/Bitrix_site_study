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

<div class="container">
	<div class="row mb-5">
		<div class="col-12">
			<div class="site-section-title">
				<h2>
					<?=Lc::getMessage("NEW_PROPERTIES")?>
				</h2>
			</div>
		</div>
	</div>

	<div class="row mb-5">

		<!-- card -->
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>

			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="col-md-6 col-lg-4 mb-4">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="prop-entry d-block"> 
					<figure> 
						<?if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
							<img 
								alt="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>" 
								src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" 
								class="img-fluid"
							> 
						<?endif?>
					</figure>
					<div class="prop-text">
						<div class="inner">
							<span class="price rounded">
								$ <?echo $arItem["PROPERTY_PRICE_VALUE"]?>
							</span>
							<h3 class="title"><?echo $arItem["NAME"]?></h3>
							<p class="location">
								<?["PREVIEW_TEXT"]?>
							</p>
						</div>
						<div class="prop-more-info">
							<div class="inner d-flex">
								<div class="col">
									<?=Lc::getMessage("AREA")?>: 
									<strong>
										<?if ($arItem["PROPERTY_TOTAL_AREA_VALUE"]) :?>
											<?echo $arItem["PROPERTY_TOTAL_AREA_VALUE"]?><sup> 2</sup>
										<?else:?>
											?											
										<?endif?>
									</strong>
								</div>
								<div class="col">
									<?=Lc::getMessage("FLOORS")?>: <strong><?echo $arItem["PROPERTY_NUMBER_OF_FLOORS_VALUE"]?></strong>
								</div>
								<div class="col">
									<?=Lc::getMessage("BATHS")?>: <strong><?echo $arItem["PROPERTY_NUMBER_OF_BATHS_VALUE"]?></strong>
								</div>
								<div class="col">
									<?=Lc::getMessage("GARAGES")?>: <strong><?echo $arItem["PROPERTY_HAS_GARAGE_VALUE"] ? 1 : 0 ?></strong>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		<?endforeach;?>

	</div>
</div>
