<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Technology;
use App\Functions\Helper;
use App\Http\Requests\TechnologyRequest;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = Technology::all();
        return view("admin.technologies.index", compact("technologies"));
    }

    public function projectsTechnology(Technology $technology) {
        return view('admin.technologies.projects-technology', compact('technology'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route("admin.technologies.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TechnologyRequest $request)
    {
        $form_data = $request->all();
        $form_data['slug'] = Helper::generateSlug($form_data['name'], Technology::class);

        $new_technology = Technology::create($form_data);

        return redirect()->route('admin.technologies.index')->with('success', 'Hai inserito una nuova tecnologia con successo.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        $title = "Modifica il progetto ''$technology->title''";
        $route = route('admin.technologies.update', $technology);
        $method = "PUT";

        return view('admin.technologies.edit', compact('technology', 'title', 'route', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TechnologyRequest $request, Technology $technology)
    {
        $form_data = $request->all();

        // se il nome che mi arriva dal form(request) è diverso dal nome della tecnologia che sto modificato, vuol dire che è stato cambiato quindi genero un nuovo slug,
        // altrimenti assegno lo stesso slug poiché significa che non è stato cambiato il nome della tecnologia
        if ($form_data['name'] !== $technology->title) {
            $form_data['slug'] = Helper::generateSlug($form_data['name'], Technology::class);
        } else {
            $form_data['slug'] = $technology->slug;
        }

        $technology->update($form_data);

        return redirect()->route('admin.technologies.index')->with('success','Hai apportato correttamente le modifiche.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('success',"Hai eliminato la Tecnologia ''$technology->name'' con successo.");
    }
}
