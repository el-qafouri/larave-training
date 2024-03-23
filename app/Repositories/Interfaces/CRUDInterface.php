<?php

namespace App\Repositories\Interfaces;

interface CRUDInterface
{
    public function getClass();

    public function setModel($model);
}
