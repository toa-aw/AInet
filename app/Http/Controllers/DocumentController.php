<?php

namespace App\Http\Controllers;

use App\Document;
use App\Movement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function delete(Document $document)
    {
        $this->authorize('delete', $document);
        $movement = Movement::where('document_id', $document->id)->first();
        $movement->document_id = null;
        $movement->save();
        $path = 'documents/' . $movement->account_id . '/' . $movement->id . '.' . $document->type;
        Storage::delete($path);

        $document->delete();
        return redirect()->route('home')->with('success', 'Document deleted successfully.');
    }

    public function downloadDocument(Document $document)
    {
        $this->authorize('download', $document);
        $movement = Movement::where('document_id', $document->id)->first();
        $path = 'documents/' . $movement->account_id . '/' . $movement->id . '.' . $document->type;    
        return Storage::download($path, $document->original_name);
    }
}
