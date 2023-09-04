<?php


namespace App\Repository;


use App\DTO\DTOInterface;

interface RepositoryInterface
{

    public function list();

    public function search();

    public function findBy(array $condition);

    public function save(DTOInterface $dto);

    public function delete();


}
