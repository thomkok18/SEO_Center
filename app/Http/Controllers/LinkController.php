<?php

namespace App\Http\Controllers;

use App\Http\Requests\Import\CsvImportRequest;
use App\Http\Requests\Link\StoreLinkRequest;
use App\Http\Requests\Link\UpdateLinkRequest;
use App\Imports\LinksImport;
use App\Models\ImportData;
use App\Models\Link;
use App\Models\Role;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class LinkController extends Controller
{
    /**
     * Display a listing of links as an admin.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.links.index', [
            'links' => Link::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new link as an admin.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.links.create');
    }

    /**
     * Store a newly created link in storage as an admin.
     *
     * @param StoreLinkRequest $linkRequest
     * @return RedirectResponse
     */
    public function store(StoreLinkRequest $linkRequest): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        Link::create($linkRequest->validated());

        return redirect()->route('admin.links.index')->with('status', [
            'storeLink' => __('status.link_store')
        ]);
    }

    /**
     * Search the specified link as an admin.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.links.index', [
            'links' => Link::getLinkSearchResults($request),
        ]);
    }

    /**
     * Show the form for editing the specified link as an admin.
     *
     * @param Link $link
     * @return Application|Factory|View
     */
    public function edit(Link $link): View|Factory|Application
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.links.edit', [
            'link' => $link,
        ]);
    }

    /**
     * Update the specified link in storage as an admin.
     *
     * @param UpdateLinkRequest $request
     * @param Link $link
     * @return RedirectResponse
     */
    public function update(UpdateLinkRequest $request, Link $link): RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        $link->update($request->validated());

        return back()->with('status', [
            'updateLink' => __('status.link_update')
        ]);
    }

    /**
     * Remove the specified link from storage as an admin.
     *
     */
    public function destroy(int $id): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        Link::destroy($id);

        return view('admin.links.index', [
            'links' => Link::paginate(20),
        ]);
    }

    /**
     * Import links as an admin.
     *
     * @return Application|Factory|View
     */
    public function getImport(): Application|Factory|View
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        return view('admin.links.import');
    }

    /**
     * Parsing imported links data as an admin.
     *
     * @param CsvImportRequest $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function parseImport(CsvImportRequest $request): Application|Factory|View|RedirectResponse
    {
        abort_if(auth()->user()->role_id !== Role::ADMIN, '403');

        $path = $request->file('data')->getRealPath();

        // Two ways to retrieve the data from the file depending on if the header is present.
        if ($request->has('header')) {
            $data = Excel::toArray(new LinksImport(), $request->file('data'))[0];
        } else {
            $data = array_map('str_getcsv', file($path));
        }

        // Remove these fields from the link data.
        $document_fields = array_values(array_diff(Schema::getColumnListing('links'), [
            'id',
            'created_at',
            'updated_at',
        ]));

        // If data is present. Save the file data into the database.
        if (count($data) > 0) {
            $csv_data = array_slice($data, 0);

            $csv_data_file = ImportData::create([
                'name' => $request->file('data')->getClientOriginalName(),
                'header' => $request->has('header'),
                'data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }

        return view('admin.links.import-fields', compact('document_fields', 'csv_data', 'csv_data_file'));
    }

    /**
     * Store link data of a csv file as an admin.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function processImport(Request $request): RedirectResponse
    {
        $links = ImportData::find($request->data_file_id);

        $csv_data = json_decode($links->data, true);

        // If header exists. Remove those values.
        if ($links->header) {
            array_shift($csv_data);
        }

        $duplicates = 0;

        foreach ($csv_data as $row) {
            $link = new Link();

            // Add data fields for each row to an empty link.
            foreach ($request->fields as $index => $field) {
                $link->$field = $row[$index];
            }

            $duplicateLink = Link::where('website', '=', $link->website)
                ->where('anchor_text', '=', $link->anchor_text)
                ->where('anchor_url', '=', $link->anchor_url)
                ->exists();

            // Count duplicates or save link.
            if ($duplicateLink) {
                $duplicates++;
            } else {
                $link->save();
            }
        }

        ImportData::destroy($links->id);

        // Return warning with amount of duplicate links if they exist.
        if ($duplicates > 0) {
            return redirect(route('admin.links.index'))->with('warning', ['link' => trans_choice('status.duplicate_links_warning', $duplicates, ['amount' => $duplicates])]);
        }

        return redirect(route('admin.links.index'))->with('status', ['storeLinks' => __('status.link_store')]);
    }
}
