<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{
    public function index() {

        $projects = Project::with('type', 'technologies')->get();

        return response()->json($projects);

    }

    public function getProject($slug) {

        // seleziono il progetto che ha lo slug uguale a quello passato, poi aggancio le tabelle in relazione con 'with'
        // inoltre aggiungo un flag 'success' per sapere, lato front, se quello slug è stato trovato o meno
        $project = Project::where('slug', $slug)->with('type', 'technologies')->first();
        if($project) $success = true;
        else $success = false;

        // come altro dato all'api passo il link assoluto dell'immagine nello storage, se c'è
        // se non c'è passo il link dell'immagine placeholder
        if($project->image) $project->image = asset('storage/' . $project->image);
        else $project->image = asset('img/placeholder.webp');

        return response()->json(compact('project', 'success'));

    }
}
