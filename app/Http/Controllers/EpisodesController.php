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

    public function bySerie(int $serieId, Request $request)
    {
        return Episode::query()
            ->where('serie_id', $serieId)
            ->paginate($request->per_page);
    }
}
