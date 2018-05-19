<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\SitemapGenerator;

class AdminSitemapGenerator extends Controller
{
    private $path = 'sitemaps/sitemap.xml';

    public function run()
    {
        SitemapGenerator::create('https://wmsports.gr')
            ->writeToFile($this->path);

        return 'Sitemap created';
    }

}
