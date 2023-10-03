<!-- den här koden är för produktdatabasen -->
<?php

class Product
{
    public $id;
    public $title;
    public $description;
    public $difficult_level;
    public $img_url;

    public function __construct($title, $description, $difficult_level, $img_url, $id = 0)
    {
        if ($id > 0) {
            $this->id = $id;
        }

        $this->title = $title;
        $this->description = $description;
        $this->difficult_level = $difficult_level;
        $this->img_url = $img_url;
    }
}

?>