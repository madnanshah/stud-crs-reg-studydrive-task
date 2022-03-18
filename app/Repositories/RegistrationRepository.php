<?php

namespace App\Repositories;
use App\Models\Registration;
use Exception;


Class RegistrationRepository
{
    public function register($data){
        try {
            return Registration::create($data);
        } catch (Exception $e) {
            return null;
        }
    }
}