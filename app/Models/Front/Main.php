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
}
