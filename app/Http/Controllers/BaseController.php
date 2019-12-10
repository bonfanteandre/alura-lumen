<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController extends Controller
{
    protected $class;

    public function __construct(string $class)
    {
        $this->class = $class;
    }

    public function index(Request $request)
    {
        return $this->class::paginate($request->per_page);
    }

    public function show(int $id)
    {
        $model = $this->class::find($id);

        if (is_null($model)) {
            return response()->json('', 204);
        }

        return response()->json($model);
    }

    public function store(Request $request)
    {
        $model = $this->class::create($request->all());

        return response()->json($model, 201);
    }

    public function update(int $id, Request $request)
    {
        $model = $this->class::find($id);
        
        if (is_null($model)) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }
        
        $model->fill($request->all());
        $model->save();

        return response()->json($model);
    }

    public function destroy(int $id)
    {
        $destroyedModels = $this->class::destroy($id);

        if ($destroyedModels === 0) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }

        return response()->json('', 204);
    }
}
