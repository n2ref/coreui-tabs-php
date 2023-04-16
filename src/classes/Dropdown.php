<?php
namespace CoreUI\classes;
use CoreUI\classes\Dropdown\Item;

require_once 'Dropdown/Item.php';


/**
 *
 */
class Dropdown {

    protected $id       = '';
    protected $title    = '';
    protected $disabled = false;
    protected $active   = false;
    protected $items    = [];


    /**
     * @param string|null $id
     */
    public function __construct(string $id = null) {

        if ($id) {
            $this->id = $id;
        } else {
            $this->id = crc32(uniqid());
        }
    }


    /**
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self {

        $this->title = $title;
        return $this;
    }


    /**
     * Получение названия таба
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }


    /**
     * Получение ID таба
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }


    /**
     * @param bool $is_disabled
     * @return $this
     */
    public function disabled(bool $is_disabled): self {

        $this->disabled = $is_disabled;
        return $this;
    }


    /**
     * @param bool $is_active
     * @return self
     */
    public function active(bool $is_active): self {

        $this->active = $is_active;
        return $this;
    }


    /**
     * Добавление значения в список
     * @param string      $title
     * @param string|null $id
     * @param string|null $url
     * @return Item
     */
    public function addItem(string $title, string $id = null, string $url = null): Item {

        $item = new Item($id);
        $item->setTitle($title);

        if ($url) {
            $item->setUrl($url);
        }

        $this->items[] = $item;

        return $item;
    }


    /**
     * Добавление разделителя
     * @return void
     */
    public function addDivider(): void {

        $this->items[] = [
            'type' => 'divider'
        ];
    }


    /**
     * Получение значений таба
     * @return array
     */
    public function getItems(): array {

        return $this->items;
    }


    /**
     * @return array
     */
    public function toArray(): array {

        $items = [];

        foreach ($this->items as $item) {
            if (is_array($item)) {
                $items[] = $item;

            } else {
                $items[] = $item->toArray();
            }
        }

        return [
            'id'       => $this->id,
            'type'     => 'dropdown',
            'title'    => $this->title,
            'disabled' => $this->disabled,
            'active'   => $this->active,
            'items'    => $items,
        ];
    }
}