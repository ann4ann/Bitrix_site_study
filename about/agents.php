<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Агенты");

// $hlblocks = \Bitrix\Highloadblock\HighloadBlockTable::getList([])->fetchAll();

// $hlblock = Highloadblock\HighloadBlockTable::getList([
// 	'filter' => ['=NAME' => 'EstateAgents']
// ])->fetch();

// $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
// $eventManager = \Bitrix\Main\EventManager::getInstance();
// $eventManager->addEventHandler('', 'EstateAgentsOnAdd', '\Partner\Myentity\OnAdd');

// echo '<pre>';
// var_export($hlblocks);
// echo '</pre>';


?>

<? $APPLICATION->IncludeComponent(
	"mcart:agents.list",
	"",
	Array(
		"CACHE_TIME" => "36000",
		"CACHE_TYPE" => "A",
		"HLBLOCK_TNAME" => "estate_agents",
		"PAGE_ELEMENTS_COUNT" => "2"
	)
); ?>


<!-- 
"CACHE_TIME" => "36000",
		"CACHE_TYPE" => "A",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_TOP_PAGER" => "Y",
		"HLBLOCK_TNAME" => "estate_agents",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "",
		"PAGE_ELEMENTS_COUNT" => "1",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"COMPONENT_TEMPLATE" => ".default" -->
		
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>