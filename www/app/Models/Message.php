<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['text', 'is_read'];

    /**
     * @return void
     */
    public function is_read(): void
    {
        $obj = self::where('is_read', 0)->get();
        foreach ($obj as $value) {
            $value->is_read = 1;
            $value->save();
        }
    }

    /**
     * @param array $data
     * @return void
     */
    public static function add(array $data): void
    {
        $obj = new self;
        $obj->fill($data);
        $obj->save();
    }

    /**
     * @param int $id
     * @return void
     */
    public static function remove(int $id): void
    {
        self::find($id)->delete();
    }

    /**
     * @return void
     */
    public static function removeAll(): void
    {
        $obj = self::get('id');
        foreach ($obj as $value) {
            self::remove($value['id']);
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public static function setStatus(int $id): void
    {
        $obj = Message::find($id);
        $obj->is_read = 1;
        $obj->save();
    }
}
