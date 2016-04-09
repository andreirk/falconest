<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 4/9/2016
 * Time: 7:29 PM
 */
class Template {

    private $dir_tmpl; // Директория с tpl-файлами
    private $data = array(); // Данные для вывода

    public function __construct($dir_tmpl) {
        $this->dir_tmpl = $dir_tmpl;
    }

    /* Метод для добавления новых значений в данные для вывода */
    public function set($name, $value) {
        $this->data[$name] = $value;
    }

    /* Метод для удаления значений из данных для вывода */
    public function delete($name) {
        unset($this->data[$name]);
    }

    /* При обращении, например, к $this->title будет выводиться $this->data["title"] */
    public function __get($name) {
        if (isset($this->data[$name])) return $this->data[$name];
        return "";
    }

    /* Вывод tpl-файла, в который подставляются все данные для вывода */
    public function display($template) {
        $template = $this->dir_tmpl.$template.".tpl";
        ob_start();
        include ($template);
        echo ob_get_clean();
    }
}
// USING EXAMPLE
//<?php
//  $template = new Template("tmpl/");
//  $menu = array();
//  $menu["http://site.ru"] = "Главная";
//  $menu["http://site.ru/page-1.html"] = "Страница 1";
//  $menu["http://site.ru/page-2.html"] = "Страница 2";
//  $template->set("menu", $menu);
//  $template->display("menu");
//?>