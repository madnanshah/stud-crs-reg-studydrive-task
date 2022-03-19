<?php

namespace App\Services;

use App\Repositories\CourseRepository;

Class CourseService
{
    /**
     * @var CourseRepository
     */
    // We named it "$repo". As we are in CourseService, it is understandable that this 
    // instance is of CourseRepository.
    private CourseRepository $repo;

    /**
     * @param CourseRepository $repo
     */

    public function __construct(CourseRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getAll(){
        return $this->repo->getAll();
    }
}