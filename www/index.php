<?php

declare(strict_types=1);

use Apitte\Core\Application\IApplication as ApiApplication;
use App\Bootstrap;
use Nette\Application\Application as UIApplication;

require __DIR__ . '/../vendor/autoload.php';

$container = Bootstrap::boot()->createContainer();
// Nette application
$container->getByType(UIApplication::class)->run();
