<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
// add this
use App\Repositories\AuthRepository;
use App\Interfaces\AuthRepositoryInterface;

class AuthController extends Controller
{
    private $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository){
        $this->authRepository = $authRepository;
    }

    public function register(Request $request)
    {
       $auth = $this->authRepository->register($request);
       return json_encode($auth, JSON_PRETTY_PRINT);
    }

    public function login(Request $request)
    {
         $auth = $this->authRepository->login($request);
       return json_encode($auth, JSON_PRETTY_PRINT);
    }
}