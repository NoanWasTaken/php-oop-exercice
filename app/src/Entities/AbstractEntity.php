<?php

namespace App\Entities;

abstract class AbstractEntity
{
    abstract protected function getId();

    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }
        return $array;
    }

    public function removeSpecialChar($str)
    {
        $res = preg_replace('/[0-9\@\.\;\" "]+/', '', $str);
        return $res;
    }
}
