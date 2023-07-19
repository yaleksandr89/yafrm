<?php

declare(strict_types=1);

namespace YafrmCore\Helpers;

use DirectoryIterator;
use RuntimeException;

final class Filesystem
{
    public static function deleteFilesThenSelf(string $folder): void
    {
        foreach (new DirectoryIterator($folder) as $f) {
            if ($f->isDot()) {
                // skip '. and ..'
                continue;
            }
            if ($f->isFile()) {
                unlink($f->getPathname());
            } elseif ($f->isDir()) {
                self::deleteFilesThenSelf($f->getPathname());
            }
        }
        rmdir($folder);
    }

    public static function createFolderIfNotExist(string $path): void
    {
        if (!file_exists($path) && !mkdir($path, 0777, true) && !is_dir($path)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
        }
    }
}
