<?php


namespace Panda\Controller;


use Panda\Services\XMLImportService;

class HomeController extends BaseController
{
    public function home()
    {

    }

    public function import()
    {
        $url = "http://www.gsmeasy.nl/feeds/active/output/gsmeasy_los_gsmnu.xml";

        $service = new XMLImportService();

        $service->import($url);
    }
} 