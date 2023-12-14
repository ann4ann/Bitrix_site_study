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
	global $USER;
	$userId = $USER->GetID(); 
	$currentPage = $APPLICATION->GetCurPage();
?>
<div class="container">
	<!-- title -->
	<div class="row mb-5">
		<div class="col-12">
			<div class="site-section-title">
				<h2>
					<?echo $currentPage == "/seller-account/my-ads/"
						? "MY properties" 
						: "New properties for you"?>
				</h2>
			</div>
		</div>
	</div>

	<!-- cards -->
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
								$ <?echo $arItem["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"]?>
							</span>
							<h3 class="title"><?echo $arItem["NAME"]?></h3>
							<p class="location">
								<?["PREVIEW_TEXT"]?>
							</p>
						</div>
						<div class="prop-more-info">
							<div class="inner d-flex">
								<div class="col">
									Area: 
									<strong>
										<?if ($arItem["DISPLAY_PROPERTIES"]["TOTAL_AREA"]["VALUE"]) :?>
											<?echo $arItem["DISPLAY_PROPERTIES"]["TOTAL_AREA"]["VALUE"]?><sup> 2</sup>
										<?else:?>
											?											
										<?endif?>
									</strong>
								</div>
								<div class="col">
									Floors: <strong><?echo $arItem["DISPLAY_PROPERTIES"]["NUMBER_OF_FLOORS"]["VALUE"]?></strong>
								</div>
								<div class="col">
									Baths: <strong><?echo $arItem["DISPLAY_PROPERTIES"]["NUMBER_OF_BATHS"]["VALUE"]?></strong>
								</div>
								<div class="col">
									Garages: <strong><?echo $arItem["DISPLAY_PROPERTIES"]["HAS_GARAGE"]["VALUE"] ? 1 : 0 ?></strong>
								</div>
							</div>
						</div>
					</div>
				</a>
			</div>
		<?endforeach;?>

	</div>

	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?><br />
	<?endif;?>
</div>