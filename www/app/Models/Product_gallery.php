<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product_gallery extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function add(int $id, string $img): void
    {
        $obj = new self();
        $obj->product_id = $id;
        $obj->img = $img;
        $obj->save();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function get(int $id): mixed
    {
        return self::where('product_id', $id)->get();
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @param array $data
     * @return void
     */
    public static function set_update(array $data): void
    {
        foreach ($data as $item => $value) {
            $obj = self::find($item);
            if (Storage::has('/uploads/products/'.$obj->img)) {
                Storage::delete('/uploads/products/'.$obj->img);
            }
            $obj->img = $value;
            $obj->save();
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public static function remove(int $id): void
    {
        self::find($id)->delete();
    }
}
