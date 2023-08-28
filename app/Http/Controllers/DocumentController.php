<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{



    public function index($path)
    {
        if ($path != 'IT' && $path != 'motas'){
            $documents = Storage::files('documents/' . $path);
            return view('documents.index', compact('documents', 'path'));
        } else {
                $documents = Storage::files('documents/actas/' . $path);
                return view('documents.index', compact('documents', 'path'));
        }

    }

    public function create($path)
    {
        $departments = Department::pluck('name', 'id');
        return view('documents.create', compact('path', 'departments'));
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



    public function uploadDocument(Request $request)
    {
        $path = $request->input('path');
        $file = $request->file('document');
        $file_name = $request->input('name'); // Nome desejado fornecido pelo usuário
        $extension = $file->getClientOriginalExtension();
        $new_file_name = $file_name . '.' . $extension;


        if ($path != 'motas' && $path != 'IT'){
            $file->storeAs('documents/' . $path, $new_file_name);
        } else {


                $file->storeAs('documents/actas/' . $path , $new_file_name);

        }

        // Criar um novo registro de documento no banco de dados
        $document = new Document();
        $document->name = $new_file_name;
        $document->path = $path;

        if ($path == 'motas' || $path == 'IT') {
            $department = $request->input('department_id');
            $document->department_id = $department;
            $document->meeting_date = $request->input('meeting_date');
        }
        $document->save();

        flash('success', 'Documento carregado com sucesso')->success();
            return redirect()->route('documents.index', $path);
    }



}
