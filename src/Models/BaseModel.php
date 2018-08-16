<?php

namespace Quiz\Models;

abstract class BaseModel
{
    /**  @var bool */
    public $isNew = true;

    /** @var array */
    public $attributes;
}
