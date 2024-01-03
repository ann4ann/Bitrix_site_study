<?

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\EventManager;
use Bitrix\Main;

class HLBlockChange
{
	public static function OnChange( Bitrix\Main\ORM\Event $event )
	{
    // $arItem = Array(
    //   "MODIFIED_BY"    => 1, // элемент изменен текущим пользователем
    //   "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
    //   "IBLOCK_ID"      => 6,
    //   "PROPERTY_VALUES"=> [],
    //   "NAME"           => "Записано в классе",
    //   "ACTIVE"         => "Y",            // активен
    //   "PREVIEW_TEXT"   => "1",
    //   "DETAIL_TEXT"    => "1",
    //   "DETAIL_PICTURE" => 0,
    //   "CODE"           => "123"
    // );
    // $el = new CIBlockElement;
    // $el->Add($arItem);

    $estate_agents_HLBlock_table_name = "estate_agents";

    //id добавляемого элемента
    // $id = $event -> getParameter("id");
  
    // $entity = $event -> getEntity();
    // $entityDataClass = $entity -> GetDataClass(); // FQM

    // // тип события. вернет ColorsOnAfterAdd
    // $eventType = $event -> getEventType();
    // // получаем массив полей хайлоад блока
    // $arFields = $event->getParameter("fields");


    $tagName = 'hlblock_table_name_' . $estate_agents_HLBlock_table_name;

    $taggedCache = Bitrix\Main\Application::getInstance() -> getTaggedCache();
    $taggedCache -> clearByTag( $tagName );
  } 
};

?>