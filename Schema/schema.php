<?php

namespace Kanboard\Plugin\Kanboard_plus\Schema;

use PDO;

const VERSION = 1;

function version_1(PDO $pdo)
{
    $pdo->exec("ALTER TABLE projects ADD COLUMN justify VARCHAR(255)");
}
