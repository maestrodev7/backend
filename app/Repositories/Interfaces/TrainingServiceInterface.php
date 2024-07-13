<?php
namespace App\Services\Interfaces;
use App\DTO\TrainingDTO;
use App\Models\Trainings;

interface TrainingServiceInterface{
    public function getAll():array;
    public function getById(string $id): ?Trainings;
    public function create(TrainingDTO $trainingDTO):Trainings;
    public function update( string $id, TrainingDTO $trainingDTO):?Trainings;
    public function delete(string $id):bool;
}