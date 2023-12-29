<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/*
 * Нужно создать пареметры, можно посмотреть как это сделано в компоненте news.list
 * 1. Строка для Название таблицы (TABLE_NAME) Highload-блока. Ниже приведино в качестве примера
 * 2. Количество элементов для постраничной пагинации
 * 3. Кеширования(CACHE_TIME)
 */

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "HLBLOCK_TNAME"  =>  Array( // Код поля
            "PARENT" => "BASE", //
            "NAME" => GetMessage("MCART_AGENTS_LIST_HLBLOCK_TNAME"), // Название параметра, берется из языкового файла
            "TYPE" => "STRING", // Тип поля
            "DEFAULT" => "", // Значение по дефолту
        ),
        "PAGE_ELEMENTS_COUNT" => [
			"PARENT" => "BASE",
			"NAME" => GetMessage("MCART_AGENTS_LIST_PAGE_ELEMENTS_COUNT"),
			"TYPE" => "STRING",
			"DEFAULT" => "20",
		],
        "CACHE_TIME"  =>  ["DEFAULT"=>36000000],
    ),
);

// CIBlockParameters::AddPagerSettings(
// 	$arComponentParameters,
// 	GetMessage("T_IBLOCK_DESC_PAGER_NEWS"), //$pager_title
// 	true, //$bDescNumbering
// 	true, //$bShowAllParam
// 	true, //$bBaseLink
// 	($arCurrentValues["PAGER_BASE_LINK_ENABLE"] ?? '') ==="Y" //$bBaseLinkEnabled
// );

// CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);


