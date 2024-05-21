<?php
$directories = [
    ['source' => __DIR__ . '/vendor/ryantao/api-response/intall/config/rlog.php', 'target' => __DIR__ . '/../app/config/'],
    ['source' => __DIR__ . '/vendor/ryantao/api-response/intall/library', 'target' => __DIR__ . '/../app/'],
    // 添加更多目录...
];

foreach ($directories as $directory) {
    $sourceDir = $directory['source'];
    $targetDir = $directory['target'];

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($sourceDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $item) {
        $targetPath = $targetDir . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        if ($item->isDir()) {
            if (!is_dir($targetPath)) {
                mkdir($targetPath, 0755, true);
            }
        } else {
            copy($item, $targetPath);
        }
    }

    echo "Files from '$sourceDir' copied to '$targetDir' successfully.\n";
}
