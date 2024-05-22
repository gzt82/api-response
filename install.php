<?php
$directories = [
    ['source' => __DIR__ . '/install/config', 'target' => __DIR__ . '/../../../config', 'description' => '配置文件部署成功'],
    ['source' => __DIR__ . './install/library', 'target' => __DIR__ . '/../../../app/Library', 'description' => '类库部署成功'],
];

foreach ($directories as $directory) {
    $sourceDir = $directory['source'];
    $targetDir = $directory['target'];

    // 创建目标目录，如果不存在
    if (!file_exists($targetDir) && !mkdir($targetDir, 0755, true) && !is_dir($targetDir)) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', $targetDir));
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($sourceDir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $item) {
        $targetPath = $targetDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName();

        // 如果是目录，尝试创建，如果失败抛出异常
        if ($item->isDir() && !file_exists($targetPath)) {
            if (!mkdir($targetPath, 0755, true) && !is_dir($targetPath)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $targetPath));
            }
        } else {
            // 如果是文件，直接复制
            copy($item, $targetPath);
        }
    }

    echo $directory['description'] . "\n";
}