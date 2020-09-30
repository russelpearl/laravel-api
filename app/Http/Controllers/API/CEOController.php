<?php

namespace App\Http\Controllers\API;

use App\CEO;
use App\Http\Controllers\Controller;
use App\Http\Resources\CEOResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// add this
use App\Repositories\CEORepository;
use App\Interfaces\CEORepositoryInterface;

class CEOController extends Controller
{
    private $ceoRepository;

    public function __construct(CEORepositoryInterface $ceoRepository){
        $this->ceoRepository = $ceoRepository;
    }

    public function index()
    {
        // $ceos = CEO::all();
        // return response([ 'ceos' => CEOResource::collection($ceos), 'message' => 'Retrieved successfully'], 200);

        $ceo = $this->ceoRepository->index();
       return json_encode($ceo, JSON_PRETTY_PRINT);
    }

    public function store(Request $request)
    {
        $ceo = $this->ceoRepository->store($request);
       return json_encode($ceo, JSON_PRETTY_PRINT);
    }

    public function show(CEO $ceo)
    {
        $ceo = $this->ceoRepository->show($ceo);
       return json_encode($ceo, JSON_PRETTY_PRINT);
    }

    public function update(Request $request, CEO $ceo)
    {
         $ceo = $this->ceoRepository->update($request, $ceo);
       return json_encode($ceo, JSON_PRETTY_PRINT);

    }

    public function destroy(CEO $ceo)
    {
        $ceo = $this->ceoRepository->destroy($ceo);
       return json_encode($ceo, JSON_PRETTY_PRINT);
    }
}