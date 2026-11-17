<?php declare(strict_types=1);

/** Check release inputs without a Shopware installation or database. */
$root = dirname(__DIR__);
$composer = json_decode(file_get_contents($root . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
if (function_exists('yaml_parse_file')) {
    $metadata = yaml_parse_file($root . '/shopware-extension.yml');
} elseif (class_exists(Symfony\Component\Yaml\Yaml::class)) {
    $metadata = Symfony\Component\Yaml\Yaml::parseFile($root . '/shopware-extension.yml');
} else {
    throw new RuntimeException('Enable PHP ext-yaml or preload Symfony Yaml for metadata validation.');
}
$check = static function (bool $condition, string $message): void {
    if (!$condition) {
        throw new RuntimeException($message);
    }
};
$check($composer['type'] === 'shopware-platform-plugin' && $composer['license'] === 'MIT', 'Unexpected package type or license.');
$version = $composer['version'];
$check((bool) preg_match('/^\d+\.\d+\.\d+$/D', $version), 'Expected a stable semantic version.');
$check(str_contains(file_get_contents($root . '/CHANGELOG.md'), '## ' . $version . ' – '), 'Current version missing from changelog.');
$check(($composer['extra']['shopware-plugin-class'] ?? '') === 'Ecomponents\\StarterTheme\\EcomponentsStarterTheme', 'Unexpected technical name.');
$check(isset($composer['authors'][0]['name'], $composer['require']['php'], $composer['require']['shopware/core']), 'Missing publisher metadata.');
$check(is_array($metadata) && is_array($metadata['store'] ?? null), 'Missing store metadata.');
$store = $metadata['store'];
$check(($store['type'] ?? null) === 'theme', 'Store type must be theme.');
$check(($store['default_locale'] ?? null) === 'de_DE' && ($store['localizations'] ?? []) === ['de_DE', 'en_GB'], 'Expected German and English localisations.');
$path = static function (string $relative) use ($root, $check): string {
    $resolved = realpath($root . '/' . $relative);
    $check($resolved !== false && str_starts_with($resolved, $root . '/') && is_file($resolved), 'Missing or unsafe metadata asset: ' . $relative);
    return $resolved;
};
$icon = getimagesize($path($store['icon']));
$check($icon !== false && $icon[0] === 256 && $icon[1] === 256 && $icon['mime'] === 'image/png', 'Icon must be a 256x256 PNG.');
$check($composer['extra']['shopware-icon'] === $store['icon'], 'Composer and store icons differ.');
foreach (['de', 'en'] as $locale) {
    foreach (['description', 'installation_manual'] as $field) {
        $check(is_string($store[$field][$locale] ?? null) && mb_strlen($store[$field][$locale]) > 200, 'Missing full ' . $locale . ' ' . $field);
    }
    $check(mb_strlen($store['meta_title'][$locale] ?? '') > 5 && mb_strlen($store['meta_title'][$locale]) <= 50, 'Invalid meta title length.');
    $check(mb_strlen($store['meta_description'][$locale] ?? '') > 50 && mb_strlen($store['meta_description'][$locale]) <= 185, 'Invalid meta description length.');
    $check(count($store['highlights'][$locale] ?? []) >= 3 && count($store['features'][$locale] ?? []) >= 5, 'Missing highlights/features.');
    $check(count($store['tags'][$locale] ?? []) <= 5 && count($store['faq'][$locale] ?? []) >= 3, 'Invalid tags or missing FAQ.');
}
$images = $store['images'] ?? [];
$check(count($images) >= 4 && count($images) <= 8, 'Expected four to eight genuine screenshots.');
$positions = [];
foreach ($images as $image) {
    $filename = ($store['image_directory'] ?? '') . '/' . $image['file'];
    $size = getimagesize($path($filename));
    $check($size !== false && $size['mime'] === 'image/png' && min($size[0], $size[1]) >= 390, 'Invalid screenshot: ' . $filename);
    $check(($image['priority'] ?? null) === ($image['position'] ?? null), 'CLI and ExtensionMesh image positions differ.');
    $positions[] = $image['position'];
    foreach (['de', 'en'] as $locale) {
        $check(($image['activate'][$locale] ?? false) === true, 'Screenshot disabled for ' . $locale);
    }
}
$check(count(array_unique($positions)) === count($images), 'Duplicate image positions.');
foreach (['de', 'en'] as $locale) {
    $check(count(array_filter($images, static fn ($image) => ($image['preview'][$locale] ?? false) === true)) === 1, 'Exactly one preview image is required.');
}
$check(($metadata['build']['zip']['composer']['enabled'] ?? null) === false && ($metadata['build']['zip']['assets']['enabled'] ?? null) === false, 'Source-only theme must not install dependencies or bundle native Storefront JS.');
echo json_encode(['passed' => true, 'version' => $version, 'type' => 'theme', 'locales' => ['de', 'en'], 'screenshots' => count($images), 'icon' => '256x256 PNG'], JSON_PRETTY_PRINT), PHP_EOL;
