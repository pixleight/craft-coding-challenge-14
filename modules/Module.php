<?php

namespace modules;

use Craft;
use Craft\helpers\FileHelper;
use Craft\helpers\UrlHelper;

class Module extends \yii\base\Module
{
    public function init(): void
    {
        Craft::setAlias('@modules', __DIR__);

        parent::init();
    }

    /**
     * Returns the URL merged with the path, without an overlapping suffix and prefix.
     */
    public function mergeUrlWithPath(string $url, string $path): string
    {
        // Join the $url and $path to create the full URL
        $fullUrl = $url . '/' . $path;

        // Get the actual base URL, regardless of how those tricksy elves entered it
        $baseUrl = UrlHelper::hostInfo($fullUrl);

        // Get the actual path, no matter how the elves entered it
        $rootRelativePath = UrlHelper::rootRelativeUrl($fullUrl);

        // Normalize the path to remove any extra slashes
        $rootRelativePath = FileHelper::normalizePath($rootRelativePath);

        // Break the path up into its segments
        $segments = collect(explode('/', $rootRelativePath));

        // remove any duplicate path segments
        $dedupedSegments = $segments->filter(function ($value, $key) use ($segments) {
            // Keep the current path segment if it does not match the previous one
            return $key === 0 || $value !== $segments->get($key - 1);
        })->toArray();

        // join up deduped segments
        $dedupedRootRelativePath = implode('/', $dedupedSegments);

        // Return the URL
        return $baseUrl . $dedupedRootRelativePath;
    }
}
