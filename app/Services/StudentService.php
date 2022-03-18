<?php

namespace App\Services;

use App\Repositories\RegistrationRepository;

Class StudentService
{
    /**
     * @var RegistrationRepository
     */
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