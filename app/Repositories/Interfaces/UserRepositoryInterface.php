<?php
namespace App\Repositories\Interfaces;

use App\DTO\UserDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Get all users.
     *
     * @return User[]
     */
    public function getAll(): array;

    /**
     * Get a user by ID.
     *
     * @param string $id
     * @return User
     */
    public function getById(string $id): ?User;

    /**
     * Create a new user.
     *
     * @param UserDTO $userDTO
     * @return User
     */
    public function create(UserDTO $userDTO): User;

    /**
     * Update an existing user.
     *
     * @param string $id
     * @param UserDTO $userDTO
     * @return User
     */
    public function update(string $id, UserDTO $userDTO): ?User;

    /**
     * Delete a user.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;
}