<?php declare(strict_types=1);

/** Build through pinned Shopware CLI; preserve sources and publish only runtime files. */
$root = dirname(__DIR__);
$composer = json_decode(file_get_contents($root . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
$version = $composer['version'];
if (!preg_match('/^\d+\.\d+\.\d+$/D', $version)) {
    throw new RuntimeException('Invalid release version.');
}
$cli = getenv('SHOPWARE_CLI_BIN') ?: 'shopware-cli';
$output = $root . '/.build';
if (!is_dir($output) && !mkdir($output, 0775, true) && !is_dir($output)) {
    throw new RuntimeException('Cannot create build directory.');
}
// Shopware CLI 0.20 reads the dotted path. The repository/ExtensionMesh source is
// shopware-extension.yml. Generate an identical alias only while packaging.
$config = $root . '/.shopware-extension.yml';
$yaml = file_get_contents($root . '/shopware-extension.yml');
$created = false;
if (is_file($config)) {
    if (file_get_contents($config) !== $yaml) {
        throw new RuntimeException('A different native CLI config exists; preserved.');
    }
} else {
    if (file_put_contents($config, $yaml, LOCK_EX) === false) {
        throw new RuntimeException('Cannot prepare native CLI config.');
    }
    $created = true;
}
$archiveName = 'EcomponentsStarterTheme-' . $version . '.zip';
try {
    $command = implode(' ', array_map('escapeshellarg', [$cli, '--no-interaction', '--no-update-hint', '--no-ai-hint', 'extension', 'package', $root, '--disable-git', '--release', '--filename', $archiveName, '--output-directory', $output]));
    passthru($command, $status);
    if ($status !== 0) {
        throw new RuntimeException('Shopware CLI package build failed.');
    }
} finally {
    if ($created && is_file($config) && file_get_contents($config) === $yaml) {
        unlink($config);
    }
}
$archivePath = $output . '/' . $archiveName;
$zip = new ZipArchive();
if ($zip->open($archivePath, ZipArchive::CHECKCONS) !== true) {
    throw new RuntimeException('Invalid built ZIP.');
}
$files = [];
for ($i = 0; $i < $zip->numFiles; ++$i) {
    $entry = $zip->getNameIndex($i);
    if (str_ends_with($entry, '/')) {
        continue;
    }
    if (!str_starts_with($entry, 'EcomponentsStarterTheme/') || str_contains($entry, '../')) {
        throw new RuntimeException('Invalid archive path.');
    }
    $relative = substr($entry, strlen('EcomponentsStarterTheme/'));
    if ($relative === 'checksum.json') {
        $checksums = json_decode($zip->getFromIndex($i), true, 512, JSON_THROW_ON_ERROR);
        if (($checksums['algorithm'] ?? '') !== 'xxh128' || ($checksums['extensionVersion'] ?? '') !== $version || !is_array($checksums['hashes'] ?? null)) {
            throw new RuntimeException('Invalid native Shopware checksum manifest.');
        }
        foreach ($checksums['hashes'] as $checksumPath => $digest) {
            $bytes = $zip->getFromName('EcomponentsStarterTheme/' . $checksumPath);
            if ($bytes === false || ltrim(hash('xxh128', $bytes), '0') !== ltrim($digest, '0')) {
                throw new RuntimeException('Native checksum mismatch: ' . $checksumPath);
            }
        }
        $files[] = $relative;
        continue;
    }
    if (!in_array($relative, ['composer.json', 'README.md', 'LICENSE', 'CHANGELOG.md'], true) && !str_starts_with($relative, 'src/')) {
        throw new RuntimeException('Development or metadata file leaked into ZIP: ' . $relative);
    }
    $contents = $zip->getFromIndex($i);
    if ($contents === false || !is_file($root . '/' . $relative)
        || hash('sha256', $contents) !== hash_file('sha256', $root . '/' . $relative)) {
        throw new RuntimeException('Archive/source content mismatch: ' . $relative);
    }
    $files[] = $relative;
}
$packaged = json_decode($zip->getFromName('EcomponentsStarterTheme/composer.json'), true, 512, JSON_THROW_ON_ERROR);
if ($packaged['version'] !== $version || $packaged['extra']['shopware-plugin-class'] !== $composer['extra']['shopware-plugin-class']) {
    throw new RuntimeException('Archive identity mismatch.');
}
$zip->close();
sort($files);
$required = ['composer.json', 'LICENSE', 'src/EcomponentsStarterTheme.php', 'src/Resources/theme.json', 'src/Resources/config/plugin.png', 'src/Resources/views/storefront/base.html.twig'];
if (array_diff($required, $files)) {
    throw new RuntimeException('Required runtime files are missing.');
}
$hash = hash_file('sha256', $archivePath);
file_put_contents($output . '/SHA256SUMS', $hash . '  ' . $archiveName . PHP_EOL);
file_put_contents($output . '/package.json', json_encode(['version' => $version, 'archive' => $archiveName, 'sha256' => $hash, 'files' => $files], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
echo 'Verified ' . $archiveName . ' (' . count($files) . ' runtime files)', PHP_EOL;
