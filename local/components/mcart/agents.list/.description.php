<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/*
 *  Задать имя компонента и Описание
 *  Разместить его в своем разделе в Визуальном редакторе
 */

$arComponentDescription = array(
	"NAME" => GetMessage("T_HBLOCK_AGENTLIST"),
	"DESCRIPTION" => GetMessage("T_HBLOCK_AGENTLIST_DESC"),
	//"CACHE_PATH" => "Y",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "hlblock",
			"NAME" => GetMessage('T_HBLOCK_AGENTLIST_CATEGORY_TITLE'),
		),
	),
);

?>