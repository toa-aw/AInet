<?php

namespace App\Http\Controllers;

use App\Account;
use App\Document;
use App\Http\Requests\UploadDocumentRequest;
use App\Movement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MovementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function associateDocumentToMovement(UploadDocumentRequest $request, Movement $movement)
    {
        $this->authorize('uploadDocument', $movement);
        $data = $request->validated();
        $accountId = $movement->account->id;

        if ($movement->hasDocument()) {
            $document = Document::find($movement->document_id);
            $old_path = 'documents/' . $accountId . '/' . $movement->id . '.' . $document->type;
            Storage::delete($old_path);
            $document->delete();
        }

        $documentName = $movement->id . '.' . $data['document_file']->extension();

        $path = $data['document_file']->storeAs('documents/' . $accountId, $documentName);
        $file = basename($path);
        // $exists = Storage::disk('local')->exists($path);
        // dd($exists);

        $documet = Document::create([
            'type' => $data['document_file']->extension(),
            'original_name' => $data['document_file']->getClientOriginalName(),
            'description' => $data['document_description'],
        ]);

        $movement['document_id'] = $documet->id;
        $movement->save();
        return redirect()->route('home')->with('status', 'User updated succesfuly.');

    }

    public function addDocument()
    {
        $id = Auth::id();
        return view('movements.add-document', compact('id'));
    }

    public function index(Account $account)
    {
        $movements = Movement::where('account_id', $account->id)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(40);
        foreach ($movements as $movement) {
            $this->authorize('view', $movement);
        }
        return view('movements.index', compact('movements', 'account'));
    }

    public function create(Account $account)
    {
        $movement = new Movement;
        return view('movements.add', compact('movement', 'account'));
    }

    public function edit(Movement $movement)
    {
        return view('movements.edit', compact('movement'));
    }

    public function delete(Movement $movement)
    {
        $this->authorize('delete', $movement);
        $movement->delete();

        return redirect()
            ->route('movements.index')
            ->with('success', 'Movement deleted successfully.');
    }
}
