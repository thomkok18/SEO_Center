<?php

namespace App\Http\Controllers;

use App\Http\Requests\Observation\StoreObservationRequest;
use App\Http\Requests\Observation\UpdateObservationRequest;
use App\Models\Language;
use App\Models\Observation;
use App\Models\ObservationCheck;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ObservationController extends Controller
{
    /**
     * Display a listing of the observation as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.observations.index', [
            'observations' => Observation::where('archived', '=', false)->paginate(20)
        ]);
    }

    /**
     * Search the specified observation as a seo employee.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.observations.index', [
            'observations' => Observation::getObservationSearchResults($request),
        ]);
    }

    /**
     * Show the form for creating a new observation as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.observations.create', [
            'languages' => Language::all()
        ]);
    }

    /**
     * Store a newly created observation in storage as a seo employee.
     *
     * @param StoreObservationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreObservationRequest $request): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        Observation::create($request->validated());

        return redirect()->route('seo.observations.index')->with('status', ['storeObservation' => __('status.observation_store')]);
    }

    /**
     * Display the specified observation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified observation as a seo employee.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.observations.edit', [
            'observation' => Observation::find($id),
            'languages' => Language::all()
        ]);
    }

    /**
     * Update the specified observation in storage as a seo employee.
     *
     * @param  UpdateObservationRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpdateObservationRequest $request, int $id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $observation = Observation::find($id);

        $observation->update($request->validated());

        return back()->with('status', ['updateObservation' => __('status.observation_update')]);
    }

    /**
     * Remove the specified observation from storage as a seo employee.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function destroy(int $id): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        Observation::destroy($id);

        return view('seo.observations.index', [
            'observations' => Observation::paginate(20)
        ]);
    }

    /**
     * Display a listing of the archived observations as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function archived(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.observations.archive', [
            'observations' => Observation::where('archived', '=', true)->paginate(20)
        ]);
    }

    /**
     * Archive the specified observation from storage as a seo employee.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function archive(int $id): Application|Factory|View
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SEO ||
                ObservationCheck::where('observation_id', '=', $id)->doesntExist()
            ),'403'
        );

        $observation = Observation::find($id);

        $observation->archived = true;

        $observation->save();

        return view('seo.observations.index', [
            'observations' => Observation::where('archived', '=', false)->paginate(20)
        ]);
    }

    /**
     * Recover observation from archive as a seo employee.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function recover(int $id): Application|Factory|View
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SEO ||
                ObservationCheck::where('observation_id', '=', $id)->doesntExist()
            ),'403'
        );

        $observation = Observation::find($id);

        $observation->archived = false;

        $observation->save();

        return view('seo.observations.archive', [
            'observations' => Observation::where('archived', '=', true)->paginate(20)
        ]);
    }
}
