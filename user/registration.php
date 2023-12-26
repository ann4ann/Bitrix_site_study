<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Регистрация");
$APPLICATION->SetTitle("Регистрация");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.registration",
	"",
	Array(
		"AUTH" => "Y",
		"REQUIRED_FIELDS" => array(),
		"SET_TITLE" => "Y",
		"SHOW_FIELDS" => array(),
		"SUCCESS_PAGE" => "/",
		"USER_PROPERTY" => array("UF_ROLE"),
		"USER_PROPERTY_NAME" => "",
		"USE_BACKURL" => "N"
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>