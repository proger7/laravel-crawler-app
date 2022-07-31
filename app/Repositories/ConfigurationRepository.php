<?php

namespace App\Repositories;

use App\Models\Configurations;
use App\Repositories\Interfaces\ConfigurationRepositoryInterface;

class ConfigurationRepository implements ConfigurationRepositoryInterface
{
    public function all()
    {
        return Configurations::all();
    }

    public function find($id)
    {
    	return Configurations::find($id);
    }

    public function getNewest()
    {
    	return Configurations::orderBy('v_function')->pluck('v_function', 'v_function');
    }
}