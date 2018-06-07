<?php

namespace App\Policies;

use App\User;
use App\Movement;
use App\Document;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Document $document)
    {
        $movement = Movement::where('document_id', $document->id)->first();
        return $user->id == $movement->account->owner_id;
    }
}
