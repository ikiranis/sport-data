<?php

namespace App\Http\Controllers;

use Spatie\Sitemap\SitemapGenerator;

class AdminSitemapGenerator extends Controller
{
    private $path = 'sitemaps/sitemap.xml';

    /**
     * Display create sitemap button
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.sitemap.sitemap');
    }

    /**
     * Create sitemap
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function run()
    {
        SitemapGenerator::create('https://wmsports.gr')
            ->writeToFile($this->path);

        return view('admin.sitemap.created');
    }

}
