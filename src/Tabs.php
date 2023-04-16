<?php
namespace CoreUI;
use CoreUI\classes\Dropdown;
use CoreUI\classes\Tab;


require_once 'classes/Dropdown.php';
require_once 'classes/Tab.php';


/**
 *
 */
class Tabs {

    const TABS_TYPE_TABS      = 'tabs';
    const TABS_TYPE_PILLS     = 'pills';
    const TABS_TYPE_UNDERLINE = 'underline';

    const TABS_POS_TOP_LEFT       = 'top-left';
    const TABS_POS_TOP_CENTER     = 'top-center';
    const TABS_POS_TOP_RIGHT      = 'top-right';
    const TABS_POS_LEFT           = 'left';
    const TABS_POS_LEFT_SIDEWAYS  = 'left-sideways';
    const TABS_POS_RIGHT          = 'right';
    const TABS_POS_RIGHT_SIDEWAYS = 'right-sideways';

    const TABS_FILL_NONE    = '';
    const TABS_FILL         = 'fill';
    const TABS_FILL_JUSTIFY = 'justify';

    private $id            = '';
    private $title         = '';
    private $subtitle      = '';
    private $tabs_type     = self::TABS_TYPE_TABS;
    private $tabs_position = self::TABS_POS_TOP_LEFT;
    private $tabs_fill     = self::TABS_FILL_NONE;
    private $tabs_width    = 200;
    private $tabs          = [];
    private $content       = '';


    /**
     * @param string|null $panel_id
     */
    public function __construct(string $panel_id = null) {

        if ($panel_id) {
            $this->id = $panel_id;
        } else {
            $this->id = crc32(uniqid());
        }
    }


    /**
     * Установка заголовка
     * @param string      $title
     * @param string|null $subtitle
     */
    public function setTitle(string $title, string $subtitle = null): void {
        $this->title    = $title;
        $this->subtitle = $subtitle;
    }


    /**
     * @param string $tabs_type
     * @return void
     */
    public function setTabsType(string $tabs_type): void {

        $this->tabs_type = $tabs_type;
    }

    /**
     * @param string $tabs_position
     * @return void
     */
    public function setTabsPosition(string $tabs_position): void {

        $this->tabs_position = $tabs_position;
    }


    /**
     * @param string $tabs_fill
     * @return void
     */
    public function setTabsFill(string $tabs_fill): void {

        $this->tabs_fill = $tabs_fill;
    }


    /**
     * @param int $tabs_width
     * @return void
     */
    public function setTabsWidth(int $tabs_width): void {

        $this->tabs_width = $tabs_width;
    }


    /**
     * Добавление таба
     * @param string      $title
     * @param string|null $id
     * @param string|null $url
     * @return Tab
     */
    public function addTab(string $title, string $id = null, string $url = null): Tab {

        $tab = new Tab($id);
        $tab->setTitle($title);

        if ($url) {
            $tab->setUrl($url);
        }

        $this->tabs[] = $tab;

        return $tab;
    }


    /**
     * Добавление dropdown таба
     * @param string $title
     * @return Dropdown
     */
    public function addDropdown(string $title): Dropdown {

        $dropdown = new Dropdown();
        $dropdown->setTitle($title);

        $this->tabs[] = $dropdown;

        return $dropdown;
    }


    /**
     * Установка содержимого для контейнера
     * @param mixed $content
     * @throws \Exception
     */
    public function setContent(mixed $content): void {

        if ( ! is_scalar($content) &&
             ! is_array($content)
        ) {
            throw new \Exception('Содержимое может быть в виде строки или массива');
        }

        $this->content = $content;
    }


    /**
     * @param string $tab_id
     * @return void
     */
    public function setActiveTab(string $tab_id): void {

        if ( ! empty($this->tabs)) {
            foreach ($this->tabs as $tab) {
                if ($tab instanceof Dropdown) {
                    $items      = $tab->getItems();
                    $tab_active = false;

                    foreach ($items as $item) {
                        if ($item instanceof Dropdown\Item) {
                            if ($item->getId() == $tab_id) {
                                $item->active(true);
                                $tab_active = true;
                            } else {
                                $item->active(false);
                            }
                        }
                    }

                    $tab->active($tab_active);

                } elseif ($tab instanceof Tab) {
                    $tab->active($tab->getId() == $tab_id);
                }
            }
        }
    }


    /**
     * Формирует данные панели
     * @return array
     */
    public function toArray(): array {

        $tabs = [];

        foreach ($this->tabs as $tab) {
            $tabs[] = $tab->toArray();
        }

        return [
            'component'    => 'coreui.panel',
            'id'           => $this->id,
            'title'        => $this->title,
            'subtitle'     => $this->subtitle,
            'tabsType'     => $this->tabs_type,
            'tabsPosition' => $this->tabs_position,
            'tabsFill'     => $this->tabs_fill,
            'tabs'         => $tabs,
            'content'      => $this->content,
        ];
    }
} 