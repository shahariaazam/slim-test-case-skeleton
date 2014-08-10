<?php

require_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'startup.php';

require_once dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'routes.php';

$app->run();