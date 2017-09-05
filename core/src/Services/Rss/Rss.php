<?php

namespace Lembarek\Core\Services\Rss;

use Carbon\Carbon;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Item;
use Lembarek\Blog\Repositories\PostRepositoryInterface;

abstract class Rss
{
  /**
   * check if the rss has a item
   *
   * @param  string  $item
   * @return void
   */
  public function has($item)
  {
      return $this->cache->has($item);
  }

  /**
   * get a rss item
   *
   * @param  string  $item
   * @return void
   */
  public function get($item)
  {
      return $this->cache->get($item);
  }

  /**
   * add rss item
   *
   * @param  string  $item
   * @return void
   */
  public function add($item, $rss, $time)
  {
     return $this->cache->add($item, $rss, $time);
  }

  /**
   * Return a string with the feed data
   *
   * @return string
   */
  public function buildRssFeed()
  {
    $now = Carbon::now();
    $feed = new Feed();
    $channel = new Channel();
    $channel
      ->title($this->title())
      ->description($this->description())
      ->url(url('/'))
      ->language($this->getLang())
      ->copyright('Copyright (c) '.$this->author())
      ->lastBuildDate($now->timestamp)
      ->appendTo($feed);

    $its = $this->repo->getRssItems();

    foreach ($its as $it) {
      $item = new Item();
      $item = $this->format($item, $it);
      $item->guid($this->getuid($it), true)
        ->appendTo($channel);
    }


    // Replace a couple items to make the feed more compliant
    $feed = str_replace(
      '<rss version="2.0">',
      '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">',
      $feed
    );
    $feed = str_replace(
      '<channel>',
      '<channel>'."\n".'    <atom:link href="'.url('/rss').
      '" rel="self" type="application/rss+xml" />',
      $feed
    );

    return $feed;
  }

  /**
   * get Rss feed
   *
   * @return Rss
   */
  public function getRssFeed()
  {

    if ($this->has('rss-feed')) {
      return $this->get('rss-feed');
    }

    $rss = $this->buildRssFeed();

    $this->add('rss-feed', $rss, $this->getCacheTime());

    return $rss;

  }

  protected function getCacheTime()
  {
      return 120;
  }

  protected function getLang()
  {
      return "en";
  }

    abstract protected function title();

    abstract protected function description();

    abstract protected function  author();

    abstract protected function  url($post);

    abstract protected function getuid($post);

    abstract protected function format($item, $it);

}
