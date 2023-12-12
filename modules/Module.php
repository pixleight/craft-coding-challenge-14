<?php

namespace modules;

use Craft;

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
        return $url . $path;
    }
}
