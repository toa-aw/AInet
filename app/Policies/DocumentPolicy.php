<?php

namespace App\Policies;

use App\Document;
use App\Movement;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class DocumentPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Document $document)
    {
        $movement = Movement::where('document_id', $document->id)->first();
        return $user->id == $movement->account->owner_id;
    }

    public function download(User $user, Document $document)
    {
        
        $movement = Movement::where('document_id', $document->id)->first(); 
        // dd('t');
        return $user->id == $movement->account->owner_id || $user->isAssociate(Auth::id()) ;
    }
}
