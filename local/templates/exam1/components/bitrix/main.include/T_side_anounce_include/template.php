<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

$filePath = $arResult["FILE"];
$fileContent = $filePath ? file_get_contents($filePath) : null;

$hasContent = $fileContent ? strlen($fileContent) > 0 : false;

			// echo '<pre>';
			// var_export(file_get_contents($filePath) );
			// echo '</pre>';

if ( $hasContent ):
?>

	<div class="side-block side-anonse">
		<div class="title-block">
			<span class="i i-title01"></span>Полезная информация!
		</div>
		<div class="item">
			<?include($filePath);?>
		</div>
	</div>

<?endif;?>

