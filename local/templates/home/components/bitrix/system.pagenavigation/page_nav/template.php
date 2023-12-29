<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * @var array $arResult
 * @var array $arParam
 * @var CBitrixComponentTemplate $this
 */

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>

<div class="row">
<div class="col-md-12 text-center">
<div class="site-pagination">

<?
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

// Если вкл. обратная постраничная навигация
if($arResult["bDescPageNumbering"] === true):
	//номер текущей страницы < общее количество страниц
	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		// номер страницы слева от текущей < общее количество страниц
		if ($arResult["nStartPage"] < $arResult["NavPageCount"]):
			// Запоминать последнюю открытую страницу - вкл.
			if($arResult["bSavePage"]):
				?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">1</a><?
			else:
				?><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a><?
			endif;

			// номер страницы слева от текущей < общее количество страниц - 1
			if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)):
				?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=intval($arResult["nStartPage"] + ($arResult["NavPageCount"] - $arResult["nStartPage"]) / 2)?>">...</a><?
			endif;
		endif;
	endif;

	do
	{
		$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;

		// номер страницы слева от текущей == номер текущей страницы
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
			?><a class="active"><?=$NavRecordGroupPrint?></a><?
		// номер страницы слева от текущей == общее количество страниц И Запоминать последнюю открытую страницу - выкл.
		elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
			?><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a><?
		else:
			?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a><?
		endif;

		$arResult["nStartPage"]--;
	}

	// номер страницы слева от текущей >= номер страницы справа от текущей
	while($arResult["nStartPage"] >= $arResult["nEndPage"]);

	// номер текущей страницы
	if ($arResult["NavPageNomer"] > 1):
		// номер страницы справа от текущей
		if ($arResult["nEndPage"] > 1):
			if ($arResult["nEndPage"] > 2):
				?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] / 2)?>">...</a><?
			endif;
			?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=$arResult["NavPageCount"]?></a><?
		endif;
	endif;
	?>


<?
// Если выкл. обратная постраничная навигация
else:
	// номер текущей страницы
	if ($arResult["NavPageNomer"] > 1):
		// номер страницы слева от текущей
		if ($arResult["nStartPage"] > 1):
			// Запоминать последнюю открытую страницу - вкл.
			if($arResult["bSavePage"]):
				?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">1</a><?
			else:
				?><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a><?
			endif;

			// номер страницы слева от текущей
			if ($arResult["nStartPage"] > 2):
				?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nStartPage"] / 2)?>">...</a><?
			endif;
		endif;
	endif;

	do
	{
		// номер страницы слева от текущей == номер текущей страницы
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
			?><a class="active"><?=$arResult["nStartPage"]?></a><?
		// номер страницы слева от текущей И Запоминать последнюю открытую страницу - выкл.
		elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
			?><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a><?
		else:
			?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a><?
		endif;
		$arResult["nStartPage"]++;
	}

	// номер страницы слева от текущей <= номер страницы справа от текущей
	while($arResult["nStartPage"] <= $arResult["nEndPage"]);

	// номер текущей страницы < общее количество страниц
	if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		// номер страницы справа от текущей < общее количество страниц
		if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
			if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
				?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] + ($arResult["NavPageCount"] - $arResult["nEndPage"]) / 2)?>">...</a><?
			endif;
			?><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a><?
		endif;
	endif;
	?>

<?
endif;
?>

</div></div></div>