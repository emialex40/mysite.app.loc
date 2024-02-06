<?php

namespace App\Kernel\Database;

interface DatabaseInterfaсe
{
    public function insert(string $table, array $data): int|false;
}
