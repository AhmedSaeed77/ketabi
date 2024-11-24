<?php

namespace App\Repository;

interface LearnableRepositoryInterface extends RepositoryInterface
{

    public function getCategories($id);

    public function isDeletable($id);

    public function isAccessible($id);

    public function getLectures($id);

    public function getSchedules($id);

    public function getPackages();

    public function getSubscribed(array $types);

    public function getSubscribedSchedules();

    public function filter($educational_stage_id = null, $subject_id = null);
    public function getPaginatedPackages() ;
}
