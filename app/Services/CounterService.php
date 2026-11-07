<?php

namespace App\Services;

use App\Repositories\Interfaces\CounterRepositoryInterface;
use App\Models\Counter\Counter;

class CounterService
{
    protected $counterRepo;

    public function __construct(CounterRepositoryInterface $counterRepo)
    {
        $this->counterRepo = $counterRepo;
    }

    public function getAllCounters()
    {
        return $this->counterRepo->get()->sortByDesc('created_at');
    }

    public function createCounter(array $data)
    {
        return $this->counterRepo->create($data);
    }

    public function updateCounter(Counter $counter, array $data)
    {
        return $counter->update($data);
    }

    public function deleteCounter(Counter $counter)
    {
        return $counter->delete();
    }
}
