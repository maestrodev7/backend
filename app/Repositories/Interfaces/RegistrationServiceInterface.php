<?php
namespace App\Services\Interfaces;
use App\DTO\RegistrationDTO;
use App\Models\Registration;

interface TrainingServiceInterface{
    public function getAll():array;
    public function getById(string $id): ?Registration;
    public function create(RegistrationDTO $registrationDTO):Registration;
    public function update( string $id, RegistrationDTO $registrationDTO):?Registration;
    public function delete(string $id):bool;
}