<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceType\StorePriceTypeRequest;
use App\Http\Requests\PriceType\UpdatePriceTypeRequest;
use App\Models\Language;
use App\Models\PriceType;
use App\Models\PromotionUrl;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PriceTypeController extends Controller
{
    /**
     * Display a listing of the promotion url prices as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.price-type.index', [
            'priceTypes' => PriceType::where('archived', '=', false)->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new price type as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.price-type.create', [
            'languages' => Language::all()
        ]);
    }

    /**
     * Store a newly created price type in storage as a seo employee.
     *
     * @param StorePriceTypeRequest $priceTypeRequest
     * @return RedirectResponse
     */
    public function store(StorePriceTypeRequest $priceTypeRequest): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        PriceType::create($priceTypeRequest->validated());

        return redirect()->route('seo.price-types.index')->with('status', [
            'storePriceType' => __('status.promotion_url_price_store')
        ]);
    }

    /**
     * Show the form for editing the specified promotion url price as a seo employee.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.price-type.edit', [
            'priceType' => PriceType::find($id),
            'languages' => Language::all()
        ]);
    }

    /**
     * Update the specified promotion url price in storage as a seo employee.
     *
     * @param UpdatePriceTypeRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdatePriceTypeRequest $request, int $id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        $priceType = PriceType::find($id);

        if ($request->price !== $priceType->price) {
            PromotionUrl::where('price_type_id', '=', $id)->update([
                'price_type_id' => null,
                'custom_price' => $priceType->price,
            ]);
        }

        $priceType->update($request->validated());

        return back()->with('status', [
            'updatePriceType' => __('status.promotion_url_price_update')
        ]);
    }

    /**
     * Remove the specified price type from storage as a seo employee.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function destroy(int $id): Application|Factory|View
    {
        abort_if(
            (
                auth()->user()->role_id !== Role::SEO ||
                PromotionUrl::where('promotion_url_id', '=', $id)->exists()
            ),'403'
        );

        PriceType::destroy($id);

        return view('seo.price-type.index', [
            'priceTypes' => PriceType::where('archived', '=', false)->paginate(20)
        ]);
    }

    /**
     * Display a listing of the archived price types as a seo employee.
     *
     * @return Application|Factory|View
     */
    public function archived(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::SEO, '403');

        return view('seo.price-type.archive', [
            'priceTypes' => PriceType::where('archived', '=', true)->paginate(20)
        ]);
    }

    /**
     * Archive the specified price type from storage as a seo employee.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function archive(int $id): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::SEO,'403');

        $priceType = PriceType::find($id);

        $priceType->archived = true;

        $priceType->save();

        return redirect()->route('seo.price-types.index');
    }

    /**
     * Recover price type from archive as a seo employee.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function recover(int $id): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::SEO,'403');

        $priceType = PriceType::find($id);

        $priceType->archived = false;

        $priceType->save();

        return view('seo.price-type.archive', [
            'priceTypes' => PriceType::where('archived', '=', true)->paginate(20)
        ]);
    }
}
