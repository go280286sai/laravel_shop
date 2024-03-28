<?php

namespace go280286sai\search_json\Json;

use Illuminate\Database\Eloquent\Collection;

trait JsonModel
{
    /**
     * If isset select fields in model,
     * then return collection, otherwise return all.
     * @return Collection
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function get_data(): Collection
    {
        if (isset(self::$select_fields)) {

            return self::all(self::$select_fields);
        } else {

            return self::all();
        }
    }
}
