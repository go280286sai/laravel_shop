<?php
/*
 * Copyright (c) 2024.
 * Author: Aleksandr Storchak
 * e-mail: <go280286sai@gmail.com>
 * All rights reserved.
 */

namespace Root\Parser\application\service\data;

use Exception;

class Cleaning extends Index implements FileInterface
{

    /**
     * @return bool
     */
    public function run(): bool
    {
        try {
            foreach ($this->list_dirs as $dir) {
                $this->delete($this->path_files, $dir);
            }
            return true;
        } catch (Exception) {
            return false;
        }
    }

    /**
     * @param string $path
     * @param string $dirname
     * @return void
     */
    private function delete(string $path, string $dirname): void
    {
        $files = scandir($path . $dirname);
        foreach ($files as $file) {
            if (is_file($path . $dirname . $file)) {
                unlink($path . $dirname . $file);
            }
        }
    }
}