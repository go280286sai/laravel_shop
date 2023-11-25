<?php

namespace App\Models;

use go280286sai\search_json\Json\JsonModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product_description extends Model
{
    use HasFactory, JsonModel;

    /**
     * @var array
     */
    private static array $select_fields = ['title', 'product_id', 'language_id', 'content'];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * @param array $data
     * @param int $id
     * @return void
     */
    public static function set_update(array $data, int $id): void
    {
        $is_set =count(self::where('product_id', $id)->get())>0;
        for ($i = 1; $i <= 3; $i++) {
        if ($is_set){
            $obj = self::all()
                ->where('product_id', $id)
                ->where('language_id', $i)
                ->first();
        }
            else{
                 $obj = new self();
                 $obj->product_id = $id;
            }
            $obj->language_id = $i;
            $obj->title = $data['title_'.$i];
            $obj->description = $data['description_'.$i];
            $obj->keywords = $data['keywords_'.$i];
            $obj->content = $data['content_'.$i];
            $obj->exerpt = $data['exerpt_'.$i];
            $obj->save();
        }
    }
}
