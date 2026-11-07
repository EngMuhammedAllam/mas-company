<?php

namespace App\Services;

use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactService
{
    protected $contactRepo;

    public function __construct(ContactRepositoryInterface $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }

    public function getAllMessages(int $perPage = 10)
    {
        return $this->contactRepo->getLatestPaginated($perPage);
    }

    public function storeMessage(array $data)
    {
        return $this->contactRepo->create($data);
    }

    public function deleteMessage($id)
    {
        return $this->contactRepo->delete($id);
    }
}
