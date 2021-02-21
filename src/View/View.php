<?php

namespace testtask\View;

class View
{
    private $templatesPath;

    public function __construct(string $templatesPath)
    {
        ///var/www/testtask/src/Controllers/../templates
        $this->templatesPath = $templatesPath;
    }

        //Имя конкретного шаблона и массив с переменными
    public function renderHtml(string $templateName, array $vars = [])
    {
        extract($vars);
//    echo __DIR__;
        ob_start();
        include  $this->templatesPath . '/' . $templateName;
        $buffer = ob_get_contents(); //переданы данные в поток вывода
        ob_end_clean();

//        $error = 'В шаблоне была ошибка!';

//        if (empty($error)) {
            echo $buffer;
//        } else {
//            echo $error;
//        }
    }
}