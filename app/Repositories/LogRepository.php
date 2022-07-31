<?php

namespace App\Repositories;

use App\Models\Logs;
use App\Repositories\Interfaces\LogRepositoryInterface;

class LogRepository implements LogRepositoryInterface
{
    public function all()
    {
        return Logs::all();
    }

    public function find($id)
    {
    	return Logs::find($id);
    }
}