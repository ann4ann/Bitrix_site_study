<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

error_reporting(E_ALL);

ini_set('display_errors', '1');

#region Bitrix includes
use \Bitrix\Main\Errorable;
use \Bitrix\Main\Engine\Contract\Controllerable;

use \Bitrix\Main\Error;
use \Bitrix\Main\ErrorCollection;

use \Bitrix\Main\Application;

use \Bitrix\Main\Data\Cache;
use \Bitrix\Main\Data\TaggedCache;

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Highloadblock\HighloadBlockTable;
use \Bitrix\Main\Engine\ActionFilter;
#endregion

class AgentsList extends CBitrixComponent implements Controllerable, Errorable
{
    protected ErrorCollection $errorCollection;

    protected Cache $cache;
    protected TaggedCache $taggedCache;

    protected int $cacheTime;
    protected bool $cacheInvalid;
    protected string $cacheKey;
    protected string $cachePatch;

    protected const category = 'mcart_agent';
    protected const name = 'options_agents_star';

    #region Получение, добавление и вывод ошибок

    /**
     * Получение ошибок
     */
    final public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    final public function getErrorByCode($code): Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    /**
     * Добавление ошибки
     */
    private function addError(Error $error): void
    {
        $this->errorCollection[] = $error;
    }

    /**
     * Добавление ошибок
     */
    private function addErrors(array $errors): void
    {
        $this->errorCollection->add($errors);
    }

    /**
     * Вывод ошибок в публичке
     */
    private function showErrors(): bool
    {
        if (count($this->getErrors())) {
            foreach ($this->getErrors() as $error) {
                if ((int)$error->getCode() === 404) {
                    ShowError($error->getMessage());
                }
            }

            return true;
        }

        return false;
    }
    #endregion

    /**
     * Обязательный метод, запускается всегда при загрузке класса, используется для проверки Параметров
     */
    final public function onPrepareComponentParams($arParams): array
    {
        $this->initCacheParams(); // создание параметров для работы кеша


        // Проверка подключение модуля highloadblock, отдать ошибку если модуль не подключен
        if (!Loader::includeModule('highloadblock')) {
            $this->addError(
                new Error(Loc::getMessage('MCART_AGENTS_LIST_MODULE_NOT_INSTALLED',
                            ['#MODULE#' => 'highloadblock']), 404)
            );
        }


        /*
         * Нужно проверить, что заданы значения в $arParams "Время кеширования" и "Количество элементов"
         * Если не заданы, то указать дефолтные значения
         */
         if ( is_null( $arParams['CACHE_TIME'] ) ||
              $arParams['CACHE_TIME'] == '0' )
         {
            $arParams['CACHE_TIME'] = 36000000;
         }
         if ( is_null($arParams['PAGE_ELEMENTS_COUNT']) ||
              $arParams['PAGE_ELEMENTS_COUNT'] == '0' )
         {
            $arParams['PAGE_ELEMENTS_COUNT'] = 20;
         }
         
        return parent::onPrepareComponentParams($arParams);
    }

    // Вызывается 1 раз в onPrepare
    private function initCacheParams(): void
    {
        $this->cacheInvalid = false;
        $this->errorCollection = new ErrorCollection();
        $this->cacheKey = self::class . '_' . md5(json_encode($this->arParams)); // тут указывается от каких параметров зависит кэш
        $this->cachePatch = self::class; // директория для хранения файлов кеша

        $this->cache = Cache::createInstance();
        $this->taggedCache = Application::getInstance()->getTaggedCache();
    }

    // Основной метод, вызывается каждый раз при отрисовке
    final public function executeComponent(): void
    {
        //$this->checkModules();
        //$this->_request = Application::getInstance()->getContext()->getRequest(); 
        
        if ( empty($this->arParams["HLBLOCK_TNAME"]) ) {
            /**
             * Если параметр Название таблицы (TABLE_NAME) Highload-блока не задан,
             * нужно отдать ошибку (Loc::getMessage('MCART_AGENTS_LIST_NOT_HLBLOCK_TNAME')).
             * Пример как создать ошибку есть выше при проверки подключения модуля "highloadblock"
             */
            $this->addError(
                new Error(Loc::getMessage('MCART_AGENTS_LIST_NOT_HLBLOCK_TNAME'), 404)
            );
        }

        if ($this->showErrors()) {
            return;
        }

        // InitCache проверяет есть ли кэш (а не создает его)
        $bCacheExists = $this->cache->initCache( $this->arParams["CACHE_TIME"],
                                                 $this->cacheKey,
                                                 $this->cachePatch);

        // echo '<pre>';
        // var_export($bCacheExists);
        // echo '</pre>';

        if ($bCacheExists)
        { // если кэш есть
            // getVars возвращает PHP переменные сохраненные в кэше
            $this->arResult =  $this->cache->getVars();
        } 
        else 
        { // если кэша нет, создадим его
            $bStarted = $this->cache -> startDataCache();
            if ($bStarted)
            {
                $this->taggedCache->startTagCache($this->cachePatch); // старт для тегированного кеша

                $this->arResult = []; // объявим результирующий массив
    
                // получить хлблок по TABLE_NAME
                $arHlblock = self::getHlblockByTableName($this->arParams["HLBLOCK_TNAME"]); 
    
                // Название тэга, который поименуем кэш
                $tagName = 'hlblock_table_name_' . $arHlblock['TABLE_NAME'];
                // Регистрируем тэг, чтобы сбрасывать кэш только данного тега 
                //      после событий добавление/изменение/удаление элементов хлблока
                $this->taggedCache->registerTag($tagName); 
    
                // получить FQN класса для работы с хлблоком
                $entityFQN = self::getEntityDataClassById($arHlblock); 
    
                // получить массив со значениями списочного свойства Виды деятельности агентов
                $arTypeAgents = self::getFieldListValue($arHlblock, 'UF_TYPE_OF_ACTIVITY');
    
                // получить массив со списком агентов и объектом для пагинации
                $agents = $this->getAgents($entityFQN, $arTypeAgents);
                $this->arResult['AGENTS'] = $agents; 
    
                if ($this->cacheInvalid) {
                    $this->taggedCache->abortTagCache();
                    $this->cache->abortDataCache();
                }
    
                $this->taggedCache->endTagCache(); // конец области, для тегированого кеша
                $this->cache->endDataCache($this->arResult); // запись arResult в кеш
            } 
        }

        /*
         * Получить Избранных агентов для текущего пользователя записать их в ['STAR_AGENTS']
         * Это можно cделать с помощью CUserOptions::GetOption
         */ 
         $this->arResult['STAR_AGENTS'] = CUserOptions::GetOption(self::category, self::name);
        /*
         * Данного метода нет в документации, код метода и его параметры можно найти в ядре (/bitrix/modules/main/) или в гугле
         * $category - это категория настройки, можете придумать любую, например mcart_agent
         * $name - это название настройки, например options_agents_star
         * Эти настройки храняться в таблице b_user_option
         */

        $this->IncludeComponentTemplate(); // вызов шаблона компонента
    }

    #region private static functions

    /**
     * Метод для получения данных хлблока по TABLE_NAME
     * @param string $hl_block_table_name - название таблицы хлблока
     * @return array
     */
    private static function getHlblockByTableName(string $hl_block_table_name): array
    {
        if (empty($hl_block_table_name) || strlen($hl_block_table_name) < 1) {
            return [];
        }

        /*
         * Делаем запрос для получения данных хлблока по TABLE_NAME, используя HighloadBlockTable::getList
         * https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=5753
         */
        $result = HighloadBlockTable::getList([
            'filter' => [
                'TABLE_NAME' => $hl_block_table_name
            ], 
        ]);

        if ($row = $result->fetch()) { // Получим результат запросв
            return $row;
        }

        return [];
    }

    /**
     * Метод для получения FQN класса для работы с элементами хлблока
     * @param array $arHlblock - массив с данными хлблока
     * @return string - в string передается Fully Qualified Name (FQN) для хлблока
     */
    private static function getEntityDataClassById(array $arHlblock): string
    {
        if (empty($arHlblock)) {
            return '';
        }

        /*
         * Написать запрос для получения класса хлблока (нужно использовать getDataClass())
         * https://tichiy.ru/wiki/rabota-s-highload-blokami-bitriks-cherez-api-d7/
         */
        $entity = HighloadBlockTable::compileEntity($arHlblock); 
        $entity_data_class = $entity->getDataClass(); 

        return $entity_data_class;
    }

    #endregion

    #region private functions

    /**
     * Метод для получения значений списочного свойства
     * @param array $arHlblock - массив с данными HLблока (нужен ID HLблока)
     * @param string $fieldName - Код списочного свойства
     * @return array
     */
    private function getFieldListValue(array $arHlblock, string $fieldName): array
    {
        $result = [];

        //Получаем ID пользовательского поля, по его коду
        $fieldID = Bitrix\Main\UserFieldTable::getList([
            'filter' => [
                "ENTITY_ID" => "HLBLOCK_" . $arHlblock['ID'],
                "FIELD_NAME" => $fieldName,
            ],
        ])->Fetch()["ID"];

        if ($fieldID) {
            // Получить список свойств UF типа enum через $fieldID
            $UF_Query = CUserFieldEnum::GetList(array(), array("USER_FIELD_ID" => $fieldID));

            while ( $ar_props = $UF_Query->Fetch() ) {
                $result[] = $ar_props;
            }
        }

        return $result;
    }

    /**
     * Метод для получения списка агентов
     * @param string $entity - FQN класса хлблока
     * @param array $arTypeAgents - массив Видов деятельности агентов
     * @return array|array[]
     */
    private function getAgents(string $entity, array $arTypeAgents): array
    {
        $arAgents = [
            'NAV_OBJECT' => [], // для построения постраничной навигации
            'ITEMS' => [], // список агентов
        ];

        // Объект для для пагинации, подробнее можно почитать 
        $nav = new \Bitrix\Main\UI\PageNavigation("nav-agents");
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams['PAGE_ELEMENTS_COUNT']) //Количество элементов из arParams
            ->initFromUri();

        
        $filter = array("UF_ACTIVITY" => '1');

        $rsAgents = $entity::GetList([
            /*
             * С помощью GetList запросить список "Активных" агентов,
             * в запросе ограничить количество агентов (использовать объект для пагинации) 
             * https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=2741
             */
            "filter" => $filter,
            "count_total" => true,
            "offset" => $nav->getOffset(),
            "limit" => $nav->getLimit(),
        ]);
    
        while ( $arAgent = $rsAgents -> fetch() ) {
            /**
             * 1. В свойстве "Вид деятельности" записан ID значения списка.
             * C помощью массива $arTypeAgents определить значение */

            $type_of_activity_id = $arAgent['UF_TYPE_OF_ACTIVITY'];

            $keys = array_column($arTypeAgents, 'ID');
            $index = array_search($type_of_activity_id, $keys);

            if ($index !== false) {
                $arAgent['UF_TYPE_OF_ACTIVITY'] = $arTypeAgents[$index]['VALUE'];
            }
            /** 
             * 2. В свойстве Фото записан ID файла из таблицы b_file.
             * Если значение есть, то получить путь через класс \CFile  */
            
             $photo_id = $arAgent['UF_PHOTO'];
             if ( $photo_id != 0 ) {
                $arFile = CFile::GetByID( $photo_id ) -> Fetch();
                $arAgent['UF_PHOTO'] = $arFile['SRC'];
             }
             else {
                $arAgent['UF_PHOTO'] = 
                '/local/components/mcart/agents.list/templates/.default/images/no-avatar.png';
             }

            // Записываем получившийся массив в $arAgents['ITEMS']
            $arAgents['ITEMS'][$arAgent['ID']] = $arAgent; 
        }

        // В объект для пагинации передаем общее количество агентов
        $nav->setRecordCount( $rsAgents->getCount() ); 

        // Записываем получившийся объект в $arAgents['NAV_OBJECT']
        $arAgents['NAV_OBJECT'] = $nav; 

        return $arAgents;
    }

    #endregion

    #region 2 метода для AJAX

    // Далее код для ajax, к нему можно вернуться после внедрения верстки и js
    /**
     * Конфигурация событий для ajax
     */
    final public function configureActions(): array
    {
        return [
            'clickStar' => [
                'prefilters' => [
                    new ActionFilter\Authentication(),
                    new ActionFilter\HttpMethod(
                        [ActionFilter\HttpMethod::METHOD_POST]
                    ),
                    new ActionFilter\Csrf(),
                ]
            ],
        ];
    }

    /**
     * Метод для изменения избранных агентов через ajax
     * @param $agentID - ID элемента агента
     * @return array|string[]
     */
    public function clickStarAction($agentID)
    {
        $result = []; // ответ, который уйдет на фронт

        $arStarredAgentsIDs = []; // массив ID элементов, которые пользователь добавил в избраное
        /*
         * 1. Получить значения свойства из настроек пользователя (CUserOptions) для текущего пользователя
         * https://dev.1c-bitrix.ru/community/webdev/user/259944/blog/17105/
         * 2. Если значение есть, то
         *   2.1. Проверить, что значение массив, если нет, то сделать массивом
         *   2.2. Проверить есть ли в массиве $agentID
         *     2.2.3. Если есть, удалить из массива
         *     2.2.4. Если нет, добавить в массив
         *   2.3. Записать в $arStarredAgentsIDs
         * 3. Если значения нет, то $agentID записать в $arStarredAgentsIDs
         * 4. Записать $arStarredAgentsIDs (результат) в БД, метод CUserOptions::SetOption
         * (его нет в документации, код метода и его параметры можно найти в ядре (/bitrix/modules/main/) или в гугле
         * 5. Отправить на фронт в массиве $result в ключе 'action' значение 'success', если все прошло удачно
         */
        $user_option_res = CUserOptions::GetOption(self::category, self::name);
        //$result['user_option_res'] = $user_option_res;

        if ( $user_option_res !== null && is_array($user_option_res) )
        {
            $arStarredAgentsIDs = $user_option_res;

            if ( in_array($agentID, $arStarredAgentsIDs, false) )
            { // Удаляем звездочку, если она была
                $key = array_search($agentID, $arStarredAgentsIDs);
                unset( $arStarredAgentsIDs[$key] );
            }
            else
            { // Добавляем звездочку, если ее не было
                $arStarredAgentsIDs[] = $agentID;
            }
        }
        else
        {
            $arStarredAgentsIDs[] = $agentID;
        }
        //$result['arStarredAgentsIDs'] = $arStarredAgentsIDs;

        $bSuccess = CUserOptions::SetOption( self::category,
                                             self::name, 
                                             $arStarredAgentsIDs);

        $result['action'] = $bSuccess ? 'success' : 'fail';
        
        return $result;
    }
    #endregion
}
