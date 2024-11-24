<?php

namespace App\Repository;

interface UserRepositoryInterface extends RepositoryInterface
{

    public function searchStudents($keyword);

    public function searchTeachers($keyword);
    public function getTeachers();
    public function getStudents();

    public function getTeacherById($id);

    public function getByEmail($email);

    public function getByConfirm($confirm,$id);

}
