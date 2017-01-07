<?php
namespace App\Scopes;

use DateTime;

trait TimeTravel
{
    /**
     * Boot the logger
     */
    public static function bootTimeTravel()
    {
        if(\Auth::user() !== null){
            if (request()->has(config('timetraveller.at'))) {
                static::addGlobalScope(new TimeTravelScope);
            }


            static::saved(function ($model) {
                $route = \Route::current();
                if($route !== null)
                    $action_name = ($route->getName() !== null) ? $route->getName() : $route->getUri();
                else
                    $action_name = 'none';

                if(\Auth::user() !== null)
                    $user_id = \Auth::user()->id;
                else
                    $user_id = 0;
                $revision = config('timetraveller.model');
                (new $revision)->create([
                    'revisionable_type' => get_class($model),
                    'revisionable_id'   => $model->id,
                    'admin_user_id'   => $user_id,
                    'action'   => $action_name,
                    'at'                => (new DateTime())->getTimestamp(),
                    'by'                => $model->getBy(),
                    'state'             => serialize($model),
                ]);
            });

            static::deleting(function($model){
                $revision = config('timetraveller.model');
                $route = \Route::current();
                $action_name = ($route->getName() !== null) ? $route->getName() : $route->getUri();
                (new $revision)->create([
                    'revisionable_type' => get_class($model),
                    'revisionable_id'   => $model->id,
                    'admin_user_id'   => \Auth::user()->id,
                    'action'   => $action_name,
                    'at'                => (new DateTime())->getTimestamp(),
                    'by'                => $model->getBy(),
                    'state'             => serialize($model),
                ]);
            });
        }

    }
    /**
     * @return mixed
     */
    public function revisions()
    {
        return $this->morphMany(config('timetraveller.model'), 'revisionable');
    }
    /**
     * Get the revisions at the given timestamp
     *
     * @param $query
     * @param $time
     * @return mixed
     */
    public function scopeAt($query, $time)
    {
        return $query->with([
            'revisions' => function ($q) use ($time) {
                $q->whereAt($time);
            },
        ]);
    }
    /**
     * Revision made by
     *
     * @return mixed
     */
    abstract public function getBy();
}