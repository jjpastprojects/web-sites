<?php

namespace Lembarek\Blog\Controllers;

use Lembarek\Blog\Services\Rss\Rss;

class RssController extends Controller
{


    protected $rss;

    public function __construct(Rss $rss)
    {
        $this->rss = $rss;
    }

    /**
     * return posts
     *
     * @param  string  $
     * @return Response
     */
    public function rss()
    {
        $rss = $this->rss->getRssFeed();
        return response($rss)
               ->header('Content-type', 'application/rss+xml');
    }
}
