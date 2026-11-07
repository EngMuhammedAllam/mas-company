<?php

namespace App\Services\Dashboard\Client;

use App\Models\Client\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ClientService
{
    public function getAllClients()
    {
        return Client::latest()->get();
    }

    public function createClient(array $data, ?UploadedFile $image = null): Client
    {
        if ($image) {
            $data['image'] = $image->store('clients', 'public');
        }

        return Client::create($data);
    }

    public function getClientById($id)
    {
        return Client::findOrFail($id);
    }

    public function updateClient($id, array $data, ?UploadedFile $image = null): Client
    {
        $client = $this->getClientById($id);

        if ($image) {
            if ($client->image && Storage::disk('public')->exists($client->image)) {
                Storage::disk('public')->delete($client->image);
            }
            $data['image'] = $image->store('clients', 'public');
        }

        $client->update($data);

        return $client;
    }

    public function deleteClient($id): bool
    {
        $client = $this->getClientById($id);

        if ($client->image && Storage::disk('public')->exists($client->image)) {
            Storage::disk('public')->delete($client->image);
        }

        return $client->delete();
    }
}
