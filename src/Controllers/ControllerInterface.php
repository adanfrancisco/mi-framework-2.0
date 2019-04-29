<?php
namespace Mixplay\Controllers;

interface ControllerInterface
{
    public function get($request,$argv);
    public function post($request,$argv);
}
