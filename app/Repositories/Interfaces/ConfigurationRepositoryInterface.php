<?php

namespace App\Repositories\Interfaces;

interface ConfigurationRepositoryInterface
{
    public function all();
    
    public function find($id);

    public function getNewest();
}