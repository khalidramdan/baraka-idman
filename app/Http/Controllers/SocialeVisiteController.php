<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialeVisiteRequest;
use App\Models\Beneficiaire;
use App\Models\SocialeVisite;
use Illuminate\Http\Request;

class SocialeVisiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sociale_visites = SocialeVisite::all();
        return response()->json($sociale_visites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SocialeVisiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SocialeVisiteRequest $request)
    {
        $socialeVisite = new SocialeVisite;
        $socialeVisite->visite_date = $request->visite_date;
        if ($request->has('visite_remarque')) {
            $socialeVisite->visite_remarque = $request->visite_remarque;
        }
        $beneficiaire = Beneficiaire::find($request->beneficiaire);
        if ($beneficiaire->sociale_visites()->save($socialeVisite)) {
            $result = $socialeVisite;
            $status = 200;
            $msg = "Visite sociale ajoutée avec success.";
        }else {
            $result = null;
            $status = 500;
            $msg = "Proléme au serveur.";
        }
        return response()->json(
            [
                'result' => $result,
                'msg' => $msg,
            ],
            $status
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SocialeVisite  $socialeVisite
     * @return \Illuminate\Http\Response
     */
    public function show(SocialeVisite $socialeVisite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SocialeVisite  $socialeVisite
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialeVisite $socialeVisite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SocialeVisiteRequest  $request
     * @param  \App\Models\SocialeVisite  $socialeVisite
     * @return \Illuminate\Http\Response
     */
    public function update(SocialeVisiteRequest $request, SocialeVisite $socialeVisite)
    {
        $socialeVisite->visite_date = $request->visite_date;
        $socialeVisite->visite_remarque = $request->visite_remarque;
        if ($socialeVisite->update()) {
            $result = $socialeVisite;
            $status = 200;
            $msg = "Visite sociale modifiée avec success.";
        } else {
            $result = null;
            $status = 500;
            $msg = "Proléme au serveur.";
        }
        return response()->json(
            [
                'result' => $result,
                'msg' => $msg,
            ],
            $status
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SocialeVisite  $socialeVisite
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialeVisite $socialeVisite)
    {
        if ($socialeVisite->delete()) {
            $result = $socialeVisite;
            $status = 200;
            $msg = "Visite sociale supprimée avec success.";
        } else {
            $result = null;
            $status = 500;
            $msg = "Proléme au serveur.";
        }
        return response()->json(
            [
                'result' => $result,
                'msg' => $msg,
            ],
            $status
        );
    }
}
