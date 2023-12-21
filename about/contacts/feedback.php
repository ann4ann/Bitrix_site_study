<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь");
?>

<div class="site-section">
	<div class="container">
		<div class="row">

			<!-- FORM -->
			<?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback", 
	"feedback_form", 
	array(
		"EMAIL_TO" => "prograkk29@gmail.com",
		"EVENT_MESSAGE_ID" => array(
			0 => "7",
		),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "MESSAGE",
		),
		"USE_CAPTCHA" => "Y",
		"COMPONENT_TEMPLATE" => "feedback_form"
	),
	false
);?> 

			<!-- CONTACT INFO -->
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "file",
					"AREA_FILE_SUFFIX" => "inc",
					"EDIT_TEMPLATE" => "",
					"PATH" => "/include/contact_info.php"
				)
			);?>

		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>