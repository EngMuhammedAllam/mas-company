<?php

namespace App\Services\Dashboard\Counter;

use App\Models\Counter\Counter;

class CounterService
{
    public function getAllCounters()
    {
        return Counter::latest()->get();
    }

    public function createCounter(array $data): Counter
    {
        return Counter::create($data);
    }

    public function updateCounter(Counter $counter, array $data): bool
    {
        return $counter->update($data);
    }

    public function deleteCounter(Counter $counter): ?bool
    {
        return $counter->delete();
    }
}
