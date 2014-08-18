<?php


namespace Panda\Services;


trait ServiceTrait
{
    protected $type = false;

    protected $msg;

    public function getMsg()
    {
        return $this->msg;
    }

    public function getType()
    {
        return $this->type;
    }
} 