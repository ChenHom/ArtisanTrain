<?php
namespace ArtisanTrain\Support\Config;

use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;

class Config extends Repository
{
    public function loadConfigFiles($path)
    {
        $fileSystem = new Filesystem();
        // $configPath = $path
        if (! $fileSystem->isDirectory($path)) {
            return false;
        }

        foreach ($fileSystem->allFiles($path) as $file) {
            $relativePathName = $file->getRelativePathname();
            $pathInfo = pathinfo($relativePathName);
            if($pathInfo['dirname'] == '.') {
                $key = $pathInfo['filename'];
            } else {
                $key = str_replace('/', '.', $pathInfo['dirname']) . '.' . $pathInfo['filename'];
            }
            $this->set($key, require "{$path}/{$relativePathName}");
        }
    }
}
