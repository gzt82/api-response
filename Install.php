<?php

namespace ryantao\Install;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

Install::postInstall();

class Install
{
    public static function postInstall(): void
    {
        $directories = [
            ['source' => __DIR__ . '/install/config', 'target' => __DIR__ . '/../../../config', 'description' => '配置文件部署成功'],
            ['source' => __DIR__ . '/install/library', 'target' => __DIR__ . '/../../../app/Library', 'description' => '类库部署成功'],
        ];

        foreach ($directories as $directory) {
            $sourceDir = $directory['source'];
            $targetDir = $directory['target'];

            if (!file_exists($targetDir) && !mkdir($targetDir, 0755, true) && !is_dir($targetDir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $targetDir));
            }

            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($sourceDir, FilesystemIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );

            $allFilesExist = true;
            foreach ($iterator as $item) {
                if ($item->isFile()) {
                    $targetPath = $targetDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

                    if (!file_exists($targetPath)) {
                        $allFilesExist = false;
                        break;
                    }
                }
            }

            if ($allFilesExist) {
                continue; // 跳过当前循环迭代
            }

            foreach ($iterator as $item) {
                if ($item->isFile()) {
                    $targetPath = $targetDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
                    copy($item, $targetPath);
                }
            }

            echo $directory['description'] . "\n";
        }
    }
}
