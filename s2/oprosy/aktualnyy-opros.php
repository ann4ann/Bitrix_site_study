<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Актуальный опрос");

?><?$APPLICATION->IncludeComponent(
	"bitrix:voting.current",
	"",
	array()
);?><br><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

?>