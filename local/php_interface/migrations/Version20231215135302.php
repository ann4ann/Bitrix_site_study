<?php

namespace Sprint\Migration;


class Version20231215135302 extends Version
{
    protected $description = "Миграция Агентов по недвижимости";

    protected $moduleVersion = "4.6.1";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
    $hlblockId = $helper->Hlblock()->saveHlblock(array (
  'NAME' => 'EstateAgents',
  'TABLE_NAME' => 'estate_agents',
  'LANG' => 
  array (
    'ru' => 
    array (
      'NAME' => 'Агенты по недвижимости',
    ),
    'en' => 
    array (
      'NAME' => 'Estate agents',
    ),
  ),
));
    $helper->Hlblock()->saveGroupPermissions($hlblockId, array (
  'customer' => 'R',
  'celler' => 'W',
  'administrators' => 'W',
));
        $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_FULLNAME',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_FULLNAME',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Full name',
    'ru' => 'ФИО',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Full name',
    'ru' => 'ФИО',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Full name',
    'ru' => 'ФИО',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Full name',
    'ru' => 'ФИО',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_ACTIVITY',
  'USER_TYPE_ID' => 'boolean',
  'XML_ID' => 'UF_ACTIVITY',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DEFAULT_VALUE' => 1,
    'DISPLAY' => 'CHECKBOX',
    'LABEL' => 
    array (
      0 => '',
      1 => '',
    ),
    'LABEL_CHECKBOX' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Activity',
    'ru' => 'Активность',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Activity',
    'ru' => 'Активность',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Activity',
    'ru' => 'Активность',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Activity',
    'ru' => 'Активность',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_MAIL',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_MAIL',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Mail',
    'ru' => 'Почта',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Mail',
    'ru' => 'Почта',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Mail',
    'ru' => 'Почта',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Mail',
    'ru' => 'Почта',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_PHONE',
  'USER_TYPE_ID' => 'string',
  'XML_ID' => 'UF_PHONE',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'ROWS' => 1,
    'REGEXP' => '',
    'MIN_LENGTH' => 0,
    'MAX_LENGTH' => 0,
    'DEFAULT_VALUE' => '',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Phone',
    'ru' => 'Телефон',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Phone',
    'ru' => 'Телефон',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Phone',
    'ru' => 'Телефон',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Phone',
    'ru' => 'Телефон',
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_TYPE_OF_ACTIVITY',
  'USER_TYPE_ID' => 'enumeration',
  'XML_ID' => 'UF_TYPE_OF_ACTIVITY',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'DISPLAY' => 'LIST',
    'LIST_HEIGHT' => 1,
    'CAPTION_NO_VALUE' => '',
    'SHOW_NO_VALUE' => 'Y',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Type of activity',
    'ru' => 'Вид деятельности',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Type of activity',
    'ru' => 'Вид деятельности',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Type of activity',
    'ru' => 'Вид деятельности',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Type of activity',
    'ru' => 'Вид деятельности',
  ),
  'ENUM_VALUES' => 
  array (
    0 => 
    array (
      'VALUE' => 'Брокер',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'UF_BROKER',
    ),
    1 => 
    array (
      'VALUE' => 'Риэлтор',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'UF_REALTOR',
    ),
    2 => 
    array (
      'VALUE' => 'Агент по покупке',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'UF_BUYING_AGENT',
    ),
    3 => 
    array (
      'VALUE' => 'Агент по продаже',
      'DEF' => 'N',
      'SORT' => '500',
      'XML_ID' => 'UF_SELLING_AGENT',
    ),
  ),
));
            $helper->Hlblock()->saveField($hlblockId, array (
  'FIELD_NAME' => 'UF_PHOTO',
  'USER_TYPE_ID' => 'file',
  'XML_ID' => 'UF_PHOTO',
  'SORT' => '100',
  'MULTIPLE' => 'N',
  'MANDATORY' => 'N',
  'SHOW_FILTER' => 'N',
  'SHOW_IN_LIST' => 'Y',
  'EDIT_IN_LIST' => 'Y',
  'IS_SEARCHABLE' => 'N',
  'SETTINGS' => 
  array (
    'SIZE' => 20,
    'LIST_WIDTH' => 0,
    'LIST_HEIGHT' => 0,
    'MAX_SHOW_SIZE' => 0,
    'MAX_ALLOWED_SIZE' => 0,
    'EXTENSIONS' => 
    array (
    ),
    'TARGET_BLANK' => 'Y',
  ),
  'EDIT_FORM_LABEL' => 
  array (
    'en' => 'Photo',
    'ru' => 'Фото',
  ),
  'LIST_COLUMN_LABEL' => 
  array (
    'en' => 'Photo',
    'ru' => 'Фото',
  ),
  'LIST_FILTER_LABEL' => 
  array (
    'en' => 'Photo',
    'ru' => 'Фото',
  ),
  'ERROR_MESSAGE' => 
  array (
    'en' => '',
    'ru' => '',
  ),
  'HELP_MESSAGE' => 
  array (
    'en' => 'Photo',
    'ru' => 'Фото',
  ),
));
        }

    public function down()
    {
      $helper = $this->getHelperManager();

      $hlblockId = $helper->Hlblock()->getHlblockIdIfExists('EstateAgents');

      $helper->Hlblock()->deleteHlblock($hlblockId);
    }
}
