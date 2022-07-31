<?php

namespace App\Repositories\Interfaces;

interface LogRepositoryInterface
{
    public function all();
    
    public function find($id);
}