<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Client\StoreClientRequest;
use App\Http\Requests\Dashboard\Client\UpdateClientRequest;
use App\Services\Dashboard\Client\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index()
    {
        $clients = $this->clientService->getAllClients();
        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        $this->clientService->createClient($request->validated(), $request->file('image'));

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Request $request)
    {
        $client = $this->clientService->getClientById($request->id);
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request)
    {
        $this->clientService->updateClient($request->id, $request->validated(), $request->file('image'));

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Request $request)
    {
        $this->clientService->deleteClient($request->id);

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}
