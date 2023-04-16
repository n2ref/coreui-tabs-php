<?php
namespace CoreUI\classes\Dropdown;

/**
 *
 */
class Item {

    private $id       = '';
    private $title    = '';
    private $url      = '';
    private $disabled = false;
    private $active   = false;

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
     * @param string $url
     * @return self
     */
    public function setUrl(string $url): self {

        $this->url = $url;
        return $this;
    }


    /**
     * Получение url таба
     * @return string
     */
    public function getUrl(): string {
        return $this->url;
    }


    /**
     * Установка ID таба
     * @param string $id
     * @return void
     */
    public function setId(string $id): void {
        $this->id = $id;
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
     * @return array
     */
    public function toArray(): array {

        return [
            'type'     => 'tab',
            'id'       => $this->id,
            'title'    => $this->title,
            'url'      => $this->url,
            'disabled' => $this->disabled,
            'active'   => $this->active,
        ];
    }
}