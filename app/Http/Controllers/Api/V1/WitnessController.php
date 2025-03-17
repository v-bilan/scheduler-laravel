<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\WitnessResource;
use App\Models\Witness;
use Illuminate\Http\Request;

class WitnessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WitnessResource::collection(Witness::with('roles')->paginate());
    }

    /**
     * Display the specified resource.
     */
    public function show(Witness $witness)
    {
        return new WitnessResource($witness);
    }
}
