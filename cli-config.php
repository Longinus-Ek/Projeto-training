<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Erick\Sistema\Infra\EntitymanagerCreator;

require_once __DIR__ . '/vendor/autoload.php';

return ConsoleRunner::createHelperSet(
    (new EntitymanagerCreator())->getEntityManager()
);
