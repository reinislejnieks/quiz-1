<?php

namespace Quiz\Models;

abstract class BaseModel implements \JsonSerializable
{
     public function __construct(array $attributes = [])
     {
         $this->setAttributes($attributes);
//         $this->validator = new Validator();
     }

    /** @var int */
    public $id;

    /**  @var bool */
    public $isNew = true;

    /** @var array */
    public $attributes;

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }
//
//    public function validate()
//    {
//        $rules = $this->rules();
//
//        foreach ($rules as $attribute => $rule) {
//            $this->validator($this, $attribute, $rule);
//        }
//    }
//
//    private function rules()
//    {
//        return [];
//    }
}
