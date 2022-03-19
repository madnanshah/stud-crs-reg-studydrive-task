<?php

namespace App\Services;

use App\Repositories\RegistrationRepository;

Class StudentService
{
    /**
     * @var RegistrationRepository
     */
    // I named it as "$registrationRepo", not "$repo", 
    // We are in StudentService (Service of Student) 
    // And making instance of RegistrationRepository (Repository of Registration not Student)
    // So this name will differentiate it from "StudentRepository"
    private RegistrationRepository $registrationRepo;

    /**
     * @param RegistrationRepository $registrationRepo
     */

    public function __construct(RegistrationRepository $registrationRepo)
    {
        $this->registrationRepo = $registrationRepo;
    }

    public function register($data){
        return $this->registrationRepo->register($data);
    }
}