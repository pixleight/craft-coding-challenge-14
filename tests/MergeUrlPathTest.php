<?php

/**
 * Tests merging of URLs with paths.
 */

use modules\Module;

test('Merging URL with path works', function () {
    $output = Module::getInstance()->mergeUrlWithPath(
        'https://SantasHelper.com/es',
        'products/gifts/three-foot-candy-cane',
    );

    expect($output)
        ->toBe('https://SantasHelper.com/es/products/gifts/three-foot-candy-cane');
});

test('Merging URL with overlapping path works', function () {
    $output = Module::getInstance()->mergeUrlWithPath(
        'https://SantasHelper.com/es',
        'es/products/gifts/three-foot-candy-cane',
    );

    expect($output)
        ->toBe('https://SantasHelper.com/es/products/gifts/three-foot-candy-cane');
});

test('Merging URL with trailing slash with overlapping path works', function () {
    $output = Module::getInstance()->mergeUrlWithPath(
        'https://SantasHelper.com/es/',
        'es/products/gifts/three-foot-candy-cane',
    );

    expect($output)
        ->toBe('https://SantasHelper.com/es/products/gifts/three-foot-candy-cane');
});

test('Merging URL with overlapping path with leading slash works', function () {
    $output = Module::getInstance()->mergeUrlWithPath(
        'https://SantasHelper.com/es',
        '/es/products/gifts/three-foot-candy-cane',
    );

    expect($output)
        ->toBe('https://SantasHelper.com/es/products/gifts/three-foot-candy-cane');
});

test('Merging URL with trailing slash with overlapping path with leading slash works', function () {
    $output = Module::getInstance()->mergeUrlWithPath(
        'https://SantasHelper.com/es/',
        '/es/products/gifts/three-foot-candy-cane',
    );

    expect($output)
        ->toBe('https://SantasHelper.com/es/products/gifts/three-foot-candy-cane');
});

test('Merging URL with trailing slash with overlapping path partial works', function () {
    $output = Module::getInstance()->mergeUrlWithPath(
        'https://SantasHelper.com/es/',
        '/essentials/gifts/three-foot-candy-cane',
    );

    expect($output)
        ->toBe('https://SantasHelper.com/es/essentials/gifts/three-foot-candy-cane');
});
