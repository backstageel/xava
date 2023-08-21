<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{


    public function index()
    {
        $documents = Storage::files('documents');

        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }
    public function viewDocument($filename)
    {
        $filePath = storage_path('app/documents/' . $filename);
        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            abort(404);
        }
    }

    public function uploadDocument(DocumentRequest $request)
    {
        if ($request->hasFile('document')) {
            $desiredName = $request->input('name'); // Nome desejado fornecido pelo usuário
            $document = $request->file('document');

            $extension = $document->getClientOriginalExtension();
            $newFileName = $desiredName . '.' . $extension; // Novo nome do arquivo

            $document->storeAs('documents', $newFileName); // Salva o documento com o novo nome na pasta "documents" no storage

            // Resto do código para salvar os detalhes do documento no banco de dados, se necessário

            flash('success', 'Documento carregado com sucesso')->success();
            return redirect()->route('documents.index');

        }

        return redirect()->back()->with('error', 'Erro ao carregar o documento.');
    }



}
