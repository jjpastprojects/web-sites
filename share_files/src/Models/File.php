<?php

 namespace Lembarek\ShareFiles\Models;

use Lembarek\Core\Models\Model;

class File extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'links', 'universities'];

    /**
     * set the links
     *
     * @param  array $links
     * @return string
     */
    public function setLinksAttribute($links)
    {
        if (!is_array($links)) {
            $links = [$links];
        }
            $this->attributes['links']  = serialize($links);
    }


    /**
     * get the links
     *
     * @param  string  $links
     * @return array
     */
    public function getLinksAttribute($links)
    {
        return unserialize($links);
    }


    /**
     * set the universities
     *
     * @param  array  $universities
     * @return void
     */
    public function setUniversitiesAttribute($universities)
    {
        if (!is_array($universities)) {
            $universities = [$universities];
        }
        $this->attributes['universities'] = serialize($universities);
    }


    /**
     * get the universities
     *
     * @param  string  $universities
     * @return array
     */
    public function getUniversitiesAttribute($universities)
    {
        return unserialize($universities);
    }
}
