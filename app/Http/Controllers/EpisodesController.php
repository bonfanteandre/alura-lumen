<?php

namespace App\Http\Controllers;

use App\Episode;
use Illuminate\Http\Request;

class EpisodesController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Episode::class);
    }
}
