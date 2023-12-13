<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Главная страница");
$APPLICATION->SetTitle("Главная страница");
?>
 
<!-- Slider -->
<?
	// Slider filter
	GLOBAL $priorityNewsFilter;
	$priorityNewsFilter = array("PROPERTY_IS_PRIORITY_DEAL"=>5);
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slider", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "#SITE_DIR#/announcement/#ELEMENT_CODE#/",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "priorityNewsFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "announcements",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "9",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "IS_PRIORITY_DEAL",
			1 => "PRICE",
			2 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "slider"
	),
	false
);?>

<!-- advantages -->
<div class="py-5">
	<div class="container">

		<div class="row">
			<div class="col-md-6 col-lg-4 mb-3 mb-lg-0">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/advantage_range.php"
					)
				);?>
			</div>
			<div class="col-md-6 col-lg-4 mb-3 mb-lg-0">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/advantage_type.php"
					)
				);?>
			</div>
			<div class="col-md-6 col-lg-4 mb-3 mb-lg-0">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/advantage_location.php"
					)
				);?>
			</div>
		</div>
	</div>
</div>

<!-- Announcements -->
<div class="site-section site-section-sm bg-light">
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.line", 
		"announcements_galery", 
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000",
			"CACHE_TYPE" => "A",
			"DETAIL_URL" => "#SITE_DIR#/announcement/#ELEMENT_CODE#/",
			"FIELD_CODE" => array(
				0 => "PREVIEW_PICTURE",
				1 => "PROPERTY_PRICE",
				2 => "PROPERTY_TOTAL_AREA",
				3 => "PROPERTY_NUMBER_OF_FLOORS",
				4 => "PROPERTY_NUMBER_OF_BATHS",
				5 => "PROPERTY_HAS_GARAGE",
				6 => "",
			),
			"IBLOCKS" => array(
			),
			"IBLOCK_TYPE" => "announcements",
			"NEWS_COUNT" => "9",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"COMPONENT_TEMPLATE" => "galery_two_rows"
		),
		false
	);?>
</div>

<!-- Services -->
<div class="site-section">
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.line", 
		"links_galery", 
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000",
			"CACHE_TYPE" => "A",
			"DETAIL_URL" => "#SITE_DIR#/references/#ELEMENT_CODE#/",
			"FIELD_CODE" => array(
				0 => "ID",
				1 => "PROPERTY_TYPE",
				2 => "",
			),
			"IBLOCKS" => array(
				0 => "6",
			),
			"IBLOCK_TYPE" => "references",
			"NEWS_COUNT" => "6",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"COMPONENT_TEMPLATE" => "links_galery_two_rows"
		),
		false
	);?>
</div>

<!-- News -->
<div class="site-section bg-light">
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.line", 
		"news_galery", 
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000",
			"CACHE_TYPE" => "A",
			"DETAIL_URL" => "#SITE_DIR#/about/news/#ELEMENT_CODE#/",
			"FIELD_CODE" => array(
				0 => "PREVIEW_TEXT",
				1 => "PREVIEW_PICTURE",
				2 => "",
			),
			"IBLOCKS" => array(
			),
			"IBLOCK_TYPE" => "news",
			"NEWS_COUNT" => "3",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC",
			"COMPONENT_TEMPLATE" => "news_galery"
		),
		false
	);?>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>