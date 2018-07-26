<?php
namespace ArtisanTrain;

use Illuminate\Filesystem\Filesystem;
use ArtisanTrain\Support\Config\Config;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{

    protected $basePath;

    protected $config;

    /**
     * @var Illuminate\Filesystem\Filesystem
     */
    protected $fileSystem;

    protected $environment;

    public function __construct(string $path, string $name = 'ArtisanTrian', string $version = '0.0.1')
    {
        $this->basePath = $path;
        $this->config = new Config();
        $this->fileSystem = new Filesystem();
        $this->environment = $this->getEnvironment();
        $this->config->loadConfigFiles($path . '/src/Config');
        $this->loadCommand($path . '/src/Command');

        parent::__construct($name);
    }

    public function getEnvironment()
    {
        $environment = '';
        $environmentPath = $this->basePath . '/../.env';

        if ($this->fileSystem->isFile($environmentPath)) {
            $environment = trim($this->fileSystem->get($environmentPath));
            $environmentFile = $this->basePath . "/../.{$environment}";

            if ($this->fileSystem->isFile($environmentFile . '.env')) {
                $dotEnv = new \Dotenv\Dotenv($this->basePath . "/../", ".{$environment}.env");
                $dotEnv->load();
            }
        }
        return $environment;
    }

    /**
     *
     */
    public function loadCommand($commandPath)
    {
        $commands = array();
        if (! $this->fileSystem->isDirectory($commandPath)) {
            return false;
        }

        foreach ($this->fileSystem->allFiles($commandPath) as $file) {
            $relativePathName = $file->getRelativePathname();

            $pathInfo = pathinfo($relativePathName);
            if ($pathInfo['dirname'] === '.') {
                $commandName = "\\ArtisanTrain\\Command\\{$pathInfo['filename']}";
                $commands[] = new $commandName;
            }
        }

        if(!empty($commands)) {
            $this->addCommands($commands);
        }
    }
}
