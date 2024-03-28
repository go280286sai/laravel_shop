<?php

namespace App\Actions;

use App\Models\Category;
use App\Models\Main;
use App\Models\Product;
use App\Models\Product_gallery;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GetParseDataClass
{
    /**
     * @var string
     */
    public string $path_categories = 'uploads/Images/Categories/';
    /**
     * @var string
     */
    public string $path_products = 'uploads/Images/Products/';
    /**
     * @var string
     */
    public string $path_jsons = 'uploads/jsons/';

    /**
     * @return bool
     */
    public function existsFiles(): bool
    {
        try {
            $files = Storage::files($this->path_jsons);
            return $this->getData($files);
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * @param array $files
     * @return bool
     */
    public function getData(array $files): bool
    {
        try {
            foreach ($files as $file) {
                $data = Storage::json($file);
                $main = $this->create_main($data['main']);
                $categories = $data['categories'];
                foreach ($categories as $value) {
                    $title = $value['title'];
                    $img = $this->path_categories . $value['img'];
                    $category_id = $this->create_categories(['main' => $main, 'img' => $img, 'title' => $title]);
                    foreach ($value['products'][0] as $product) {
                        $title = $product['title'];
                        $price = $this->toPrice($product['price']);
                        $exerpt = $product['exerpt'];
                        $description = $product['description'];
                        $content = $product['content'];
                        $img = $this->path_products . $product['images'][0];
                        $create_id = $this->create_products(['category' => $category_id, 'title' => $title, 'price' => $price,
                            'exerpt' => $exerpt, 'description' => $description, 'content' => $content,
                            'img' => $img]);
                        $this->create_images($create_id, $product['images']);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
        return true;
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function create_images(int $id, array $data): void
    {
        $count_img = count($data);
        for ($i = 1; $i < $count_img; $i++) {
            Product_gallery::add($id, $this->path_products . $data[$i]);
        }
    }

    /**
     * @param string $price
     * @return int
     */
    public function toPrice(string $price): int
    {
        $number = '';
        $count = strlen($price);
        for ($i = 0; $i < $count; $i++) {
            if (is_numeric($price[$i])) {
                $number .= $price[$i];
            }
        }
        return (int)$number;
    }

    /**
     * @param string $title
     * @return int
     */
    public function create_main(string $title): int
    {
        $main = [];
        $main["main_description_1"] = $title;
        $main["main_description_2"] = $title;
        $main["main_description_3"] = $title;
        return Main::add($main);
    }

    /**
     * @param array $data
     * @return int
     */
    public function create_categories(array $data): int
    {
        $data = ['main' => $data['main'],
            'title_1' => $data['title'] ?? '',
            'description_1' => $data['description'] ?? '',
            'keywords_1' => $data['keywords'] ?? '',
            'content_1' => $data['content'] ?? '',
            'title_2' => $data['title'] ?? '',
            'description_2' => $data['description'] ?? '',
            'keywords_2' => $data['keywords'] ?? '',
            'content_2' => $data['content'] ?? '',
            'title_3' => $data['title'] ?? '',
            'description_3' => $data['description'] ?? '',
            'keywords_3' => $data['keywords'] ?? '',
            'content_3' => $data['content'] ?? '',
            'img' => $data['img']] ?? '';
        return Category::add($data);
    }

    /**
     * @param array $data
     * @return int
     */
    public function create_products(array $data): int
    {
        $data = [
            'title_1' => $data['title'] ?? '',
            'content_1' => $data['content'] ?? '',
            'exerpt_1' => $data['exerpt'] ?? '',
            'keywords_1' => $data['keywords'] ?? '',
            'description_1' => $data['description'] ?? '',
            'title_2' => $data['title'] ?? '',
            'content_2' => $data['content'] ?? '',
            'exerpt_2' => $data['exerpt'] ?? '',
            'keywords_2' => $data['keywords'] ?? '',
            'description_2' => $data['description'] ?? '',
            'title_3' => $data['title'] ?? '',
            'content_3' => $data['content'] ?? '',
            'exerpt_3' => $data['exerpt'] ?? '',
            'keywords_3' => $data['keywords'] ?? '',
            'description_3' => $data['description'] ?? '',
            'category' => $data['category'],
            'new_price' => $data['price'],
            'amount' => $data['amount'] ?? 50,
            'img' => $data['img'] ?? ''
        ];
        return Product::add($data);
    }

    /**
     * @return void
     */
    public function clearJsons(): void
    {
        $files = Storage::files($this->path_jsons);
        foreach ($files as $file) {
            Storage::delete($file);
        }
    }

    /**
     * @return void
     */
    public function clearAll(): void
    {
        $files = [
            $this->path_jsons,
            $this->path_categories,
            $this->path_products
        ];
        foreach ($files as $file) {
            $images = Storage::files($file);
            foreach ($images as $image) {
                Storage::delete($image);
            }
        }
    }
}
