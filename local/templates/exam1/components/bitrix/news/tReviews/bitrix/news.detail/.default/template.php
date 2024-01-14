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


$itemImageSrc = $arResult["DETAIL_PICTURE"]["SRC"] ?? '/local/templates/exam1/img/rew/no_photo.jpg';

$itemCompany = $arResult['DISPLAY_PROPERTIES']['COMPANY']['DISPLAY_VALUE'];
$itemPosition = $arResult['DISPLAY_PROPERTIES']['POSITION']['DISPLAY_VALUE'];
$itemDate = $arResult["DISPLAY_ACTIVE_FROM"] . ' ' . GetMessage("YEAR_SHORT_LETTER");

// Выставим строку вида "Отзыв - Сергей Родионов - CTC-Медиа" в Title
//$revTitle = GetMessage('REVIEW_HEADER'); // Слово "Отзыв"
//$headerLine = "{$revTitle} - {$arResult["NAME"]} - {$itemCompany}";
//$APPLICATION -> SetTitle($headerLine);

$authorLine = "{$arResult["NAME"]}, {$itemDate}, {$itemPosition}, {$itemCompany}";

$itemDocs = $arResult['DISPLAY_PROPERTIES']['DOCS'];
$bHaveDocs = ($itemDocs != null) && (is_array($itemDocs));

echo '<pre>';
//var_export($itemDocs);
// var_export($bHaveDocs);
echo '</pre>';

?>

<div class="review-block">
	<div class="review-text">
		<div class="review-text-cont">
			<?=($arResult["FIELDS"]["DETAIL_TEXT"] ?? '');?>
		</div>

		<div class="review-autor">
			<?=$authorLine?>
		</div>
	</div>

	<? // Картинка - DISPLAY_PICTURE
	if( $arParams["DISPLAY_PICTURE"]!="N" ): ?>
		<div style="clear: both;" class="review-img-wrap">
				<img src="<?=$itemImageSrc?>" alt="img" />
		</div>
	<?endif?>
</div>

<? // Блок со списком документов, если они есть - 'DISPLAY_PROPERTIES' - 'DOCS'
if( $bHaveDocs ): ?>
	<div class="exam-review-doc">
		<p>
			<?=GetMessage("DOCS_TITLE")?>
		</p>
		<? foreach ($itemDocs['FILE_VALUE'] as $docFile): 
				$docFilePath = CFile::GetPath( $docFile['ID'] );
				?>
				<div class="exam-review-item-doc">
					<img class="rew-doc-ico" src="<?=SITE_TEMPLATE_PATH?>/img/icons/pdf_ico_40.png">
					<a href="<?= $docFilePath ?>">
						<?=$docFile['ORIGINAL_NAME']?>
					</a>
				</div>
		<?endforeach;?>
	</div>
<?endif?>

<?
// echo '<pre>';
// var_export($arResult["FIELDS"]["PREVIEW_TEXT"]);
// echo '</pre>';
?>

