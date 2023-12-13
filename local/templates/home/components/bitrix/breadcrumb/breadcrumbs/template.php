<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))
{
	$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}

$strReturn .= '<div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(/local/templates/home/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5" itemscope itemtype="http://schema.org/BreadcrumbList">
								<div class="container">
									<div class="row align-items-center justify-content-center text-center">
										<div class="col-md-10">';

$itemSize = count($arResult);

$strReturn .= '<h1 class="mb-2">'.$arResult[$itemSize-1]["TITLE"].'</h1>';

for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '<span class="mx-2 text-white">&bullet;</span>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= $arrow.'
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item">'.$title.'</a>
				<meta itemprop="position" content="'.($index + 1).'" />';
	}
	else
	{
		$strReturn .= $arrow.'<strong class="text-white">'.$title.'</strong>';
	}
}

$strReturn .= '</div></div></div></div>';

return $strReturn;

?>