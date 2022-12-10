<?php

namespace app\system;

class Common {
    public const CONTROLLERS_DIR = 'controllers' . DIRECTORY_SEPARATOR . 'v1';

    /**
     * @return string[]
     */
    public static function getControllersList(): array
    {
        return array_map(static function(string $controller): string {
            return explode('.', $controller)[0];
        }, self::fullFilesList(self::CONTROLLERS_DIR));
    }

    public static function getRoot(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . '..';
    }

    /**
     * @param string $root
     * @return string[]
     */
    private static function fullFilesList(string $root): array
    {
        $entries = scandir(self::getRoot() . DIRECTORY_SEPARATOR . $root);
        $result = [];

        foreach ($entries as $entry) {
            if (in_array($entry, ['.', '..'])) {
                continue;
            }

            if (is_dir(self::getRoot() . DIRECTORY_SEPARATOR . $root . DIRECTORY_SEPARATOR . $entry)) {
                $subDirFiles = self::fullFilesList($root . DIRECTORY_SEPARATOR . $entry);
                $result = array_merge($result, $subDirFiles);
            } else {
                $result[] = $root . DIRECTORY_SEPARATOR.  $entry;
            }
        }

        return $result;
    }
}