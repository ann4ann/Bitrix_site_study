<?

use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\EventManager;

class HLBlockChange
{
	public static function OnChange( Entity\Event $event )
	{
    $estate_agents_HLBlock_table_name = "estate_agents";

    $tagName = 'hlblock_table_name_' . $estate_agents_HLBlock_table_name;

    $taggedCache = \Bitrix\Main\Application::getInstance() -> getTaggedCache();
    $taggedCache -> clearByTag( $tagName );
  } 
};

?>