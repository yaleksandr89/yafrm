<?php

namespace YafrmApp\Models\Front;

use RedBeanPHP\R;
use YafrmCore\Classes\BaseModel;

class Main extends BaseModel
{
    public function findAll(string $tableName): array
    {
        return R::findAll($tableName);
    }

    public function findById(string $tableName, int $id): array
    {
        return R::getRow(
            "SELECT * FROM $tableName WHERE id = :id",
            ['id' => $id]
        );
    }
}
