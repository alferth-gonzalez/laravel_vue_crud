<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Client;

class ClientPolicy
{
    // opcional: bloquear todo si no está autenticado
    public function before(?User $user) { return $user ? null : false; }

    public function viewAny(User $user): bool { return true; }
    public function view(User $user, Client $client): bool { return true; }
    public function create(User $user): bool { return true; }
    public function update(User $user, Client $client): bool { return true; }
    public function delete(User $user, Client $client): bool { return true; }
    // si usas soft deletes:
    public function restore(User $user, Client $client): bool { return true; }
    public function forceDelete(User $user, Client $client): bool { return false; }
}