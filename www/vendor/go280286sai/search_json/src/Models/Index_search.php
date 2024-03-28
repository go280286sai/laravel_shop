<?php

namespace go280286sai\search_json\Models;

use go280286sai\search_json\Json\LogMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Index_search extends Model
{
    use HasFactory;

    /**
     * @param string $title
     * @return void
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function add(string $title): void
    {
        if (!self::where('name', $title)->exists()) {
            $obj = new self();
            $obj->name = $title;
            $obj->save();
        }
    }

    /**
     * @param string $title
     * @return void
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function remove(string $title): void
    {
        self::where('name', $title)->delete();
    }

    /**
     * @return void
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function create_search(): void
    {
        $resources = self::all();
        foreach ($resources as $resource) {
            $title = "\App\Models\\" . ucfirst($resource->name);
            $obj = $title::get_data();
            self::create(ucfirst($resource->name), $obj);
        }
    }

    /**
     * @param string $text
     * @return array
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function search_text(string $text): array
    {
        $result = [];
        $resources = self::all();
        foreach ($resources as $resource) {
            foreach (self::read_json(ucfirst($resource->name), $text) as $value) {
                $result[] = $value;
            }
        }

        return $result;
    }

    /**
     * @param string $name
     * @param object $text
     * @return void
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function create(string $name, object $text): void
    {
        $path = __DIR__ . '/../Json/files/' . $name . '.json';
        $file = fopen($path, 'w');
        try {
            foreach ($text as $item) {
                fwrite($file, json_encode($item) . PHP_EOL);
            }
            fclose($file);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    /**
     * @param string $name
     * @param string $text
     * @return iterable
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function read_json(string $name, string $text): iterable
    {
        $path = __DIR__ . '/../Json/files/' . $name . '.json';
        $file = fopen($path, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $data = json_decode($line, true);
                if ($data !== null) {
                    foreach ($data as $item) {
                        if (str_contains($item, $text)) {
                            yield $data;
                        }
                    }
                } else {
                    LogMessage::send("Error decoder JSON: " . json_last_error_msg() . PHP_EOL);
                }
            }
            fclose($file);
        } else {
            LogMessage::send('Don\'t open file for reading: ' . $path);
        }
    }

    /**
     * @return void
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function clear(): void
    {
        self::truncate();
        self::clear_files();
    }

    /**
     * @return void
     * @author Aleksander Storchak <go280286sai@gmail.com>
     */
    public static function clear_files(): void
    {
        $files = scandir(__DIR__ . '/../Json/files');
        foreach ($files as $file) {
            if (str_ends_with($file, '.json')) {
                unlink(__DIR__ . '/../Json/files/' . $file);
            }
        }
    }
}
