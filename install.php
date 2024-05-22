<?php
$directories = [
    ['source' => './install/config', 'target' => '../../../config'],
    ['source' => './install/library', 'target' => '../../../app\Library'],
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