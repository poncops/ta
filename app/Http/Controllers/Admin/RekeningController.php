<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rekening;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\RekeningRequest;
use Symfony\Component\HttpFoundation\Response;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        abort_if(Gate::denies('rekening_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rekenings = Rekening::latest()->paginate(5); 

        return view('admin.rekenings.index', compact('rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('rekening_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

         return view('admin.rekenings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RekeningRequest $request)
    {
        abort_if(Gate::denies('rekening_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        Rekening::create($request->validated());

        return redirect()->route('admin.rekenings.index')->with([
            'message' => 'success created !',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rekening $rekening)
    {
        abort_if(Gate::denies('rekening_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rekenings.show', compact('rekening'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rekening $rekening)
    {
        abort_if(Gate::denies('rekening_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.rekenings.edit', compact('rekening'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RekeningRequest $request, Rekening $rekening)
    {
        abort_if(Gate::denies('rekening_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $rekening->update($request->validated());

        return redirect()->route('admin.rekenings.index')->with([
            'message' => 'success updated !',
            'alert-type' => 'info'
        ]);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rekening $rekening)
    {
        abort_if(Gate::denies('rekening_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rekening->delete();

        return redirect()->route('admin.rekenings.index')->with([
            'message' => 'success deleted !',
            'alert-type' => 'danger',
            ]);
    }
}
