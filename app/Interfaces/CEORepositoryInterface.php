<?php

namespace App\Interfaces;

interface CEORepositoryInterface 
{
    public function index();
   
    public function store($request);
    
    public function show($ceo);
   
    public function update($request, $ceo);
    
    public function destroy($ceo);
    
}