<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Clients\StoreClientRequest;
use App\Http\Requests\Clients\UpdateClientRequest;
use App\Models\Client;
use Inertia\Inertia;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::query()
            ->filter($request->only('search'))
            ->orderByDesc('id')
            ->paginate($request->integer('per_page', 10))
            ->withQueryString()
            ->through(fn ($c) => [
                'id' => $c->id,
                'name' => $c->name,
                'email' => $c->email,
                'phone' => $c->phone,
                'document_number' => $c->document_number,
                'city' => $c->city,
                'status' => $c->status,
                'created_at' => $c->created_at?->format('Y-m-d'),
            ]);

        return Inertia::render('Clients/Index', [
            'filters' => $request->only('search','per_page'),
            'clients' => $clients,
        ]);
    }

    public function create()
    {
        return Inertia::render('Clients/Create');
    }

    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());
        return redirect()->route('clients.index')->with('success', 'Cliente creado');
    }

    public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit', [
            'client' => [
                'id' => $client->id,
                'name' => $client->name,
                'email' => $client->email,
                'phone' => $client->phone,
                'document_number' => $client->document_number,
                'address' => $client->address,
                'city' => $client->city,
                'status' => $client->status,
                'notes' => $client->notes,
            ],
        ]);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return redirect()->route('clients.index')->with('success', 'Cliente Actualizado');
    }

    public function destroy(Client $client)
    {
        try {
            $client->delete();
            // dd('Eliminado');
            return redirect()->route('clients.index')->with('success', 'Cliente Eliminado');
        } catch (\Throwable $th) {
            dd('Error al eliminar el cliente: ' . $th->getMessage());
        }
    }
}
