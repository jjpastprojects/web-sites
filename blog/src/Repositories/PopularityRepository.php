<?php

namespace Lembarek\Blog\Repositories;

use Carbon\Carbon;
use Lembarek\Blog\Repositories\PopularityRepositoryInterface;
use Lembarek\Blog\Models\Popularity;

class PopularityRepository extends Repository implements PopularityRepositoryInterface
{


    protected $model;

    public function __construct(Popularity $model)
    {
        $this->model = $model;
    }

    /**
     * add popularity to post
     *
     * @param  integer  $post_id
     * @param  integer  $factor_id
     * @return integer
     */
    public function add($post_id, $factor_id)
    {
        $day = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->subYears(47)->getTimestamp();

        $popularity  = $this->factor($factor_id)*$time;

        $post_popularity = $this->model->where('day', $day)->where('post_id' ,$post_id)->first();
        if($post_popularity){
            $post_popularity->popularity += $popularity;
            $post_popularity->save();
        }else{
            $post_popularity = $this->model->create(['day' => $day, 'post_id' => $post_id, 'popularity' => $popularity]);
        }

        return $post_popularity->popularity;
    }

    /**
     * get factor value
     *
     * @param  integer  $factor_id
     * @return void
     */
    public function factor($factor_id)
    {
        return $this->factors()[$factor_id];
    }

    /**
     * it return the factors for popularity
     *
     * @return Array
     */
    public function factors()
    {
        return [
            1 => 1, //one view
            2 => 2, //facebook share
            3 => 3, //twitter share
            4 => 2, //google+ share
        ];
    }

}
