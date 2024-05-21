<?php

namespace Ryantao;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Install
{
    public static function warmCache()
    {
        $directories = [
            ['source' => __DIR__ . '\vendor\ryantao\api-response\install\config', 'target' => __DIR__ . '\config'],
            ['source' => __DIR__ . '\vendor\ryantao\api-response\install\library', 'target' => __DIR__ . '\app\Library'],
        ];

        foreach ($directories as $directory) {
            $sourceDir = $directory['source'];
            $targetDir = $directory['target'];

            if (!is_dir($targetDir) && !mkdir($targetDir, 0755, true) && !is_dir($targetDir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $targetDir));
            }

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($sourceDir, FilesystemIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($iterator as $item) {
                $targetPath = $targetDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
                if ($item->isDir()) {
                    if (!is_dir($targetPath) && !mkdir($targetPath, 0755, true) && !is_dir($targetPath)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $targetPath));
                    }
                } else {
                    copy($item, $targetPath);
                }
            }

            echo "Files from '$sourceDir' copied to '$targetDir' successfully.\n";
        }
    }
}