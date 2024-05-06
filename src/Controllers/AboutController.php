<?php

namespace Iplague\Project\Controllers;

use Iplague\Project\Viewer;

class AboutController
{
    public function index(): void
    {
        $page = 'about';
        $title = 'About Page';
        $content = 'Hello! Its about page';
        $info = 'Text djksfjk.dgj.gbkj.dfgbk.jdfgbkj.dfzbgk.jz';

        $view = new Viewer(
            [
                'page' => $page,
                'title' => $title,
                'content' => $content,
                'info' => $info
            ]
        );

        $view->render();
    }
}
