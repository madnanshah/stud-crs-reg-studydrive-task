<?php

namespace App\Services;

use App\Repositories\CourseRepository;

Class CourseService
{
    /**
     * @var CourseRepository
     */
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