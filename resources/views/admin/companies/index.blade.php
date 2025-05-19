<x-app-layout
    :active-page="'admin_index_company'"
    :css="asset('css/admin/companies/index.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{__('webpage.companies')}}</h3>
                </div>

                <div class="card-body">
                    @if (session('status')['storeCompany'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['storeCompany'] }}
                        </div>
                    @endif
                    @if (session('status')['destroyCompany'] ?? null)
                        <div class="alert alert-success" role="alert">
                            {{ session('status')['destroyCompany'] }}
                        </div>
                    @endif
                    @if($errors->hasBag('companyError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('companyError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <div class="d-flex">
                            <x-nav-link :href="route('admin.companies.create')" class="p-0 py-2 pr-3" :active="request()->routeIs('admin.create_company')" aria-label="{{__('title.add_company')}}" title="{{__('title.add_company')}}">
                                <i class="fas fa-plus fa-2x"></i>
                            </x-nav-link>
                        </div>
                        <form class="w-100" method="GET" action="{{ route('admin.companies.search') }}">
                            @csrf
                            <div class="d-md-flex align-items-center">
                                <div class="form-group mb-md-0 mr-md-2">
                                    <x-input id="search" type="text" name="search" placeholder="{{__('form.search')}}" value="{{request('search')}}" title="{{__('title.search_company')}}" autofocus/>
                                </div>
                                <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 p-0">
                        @forelse($companies as $company)
                            <div class="border mb-2 mb-xl-0 p-2">
                                <div class="d-flex align-items-center">
                                    <div class="w-100" title="{{__('company.name')}}">{{$company->name}}</div>
                                    <x-nav-link class="ml-2 p-0" :href="route('admin.companies.edit', ['company' => $company->id])" :active="request()->routeIs('admin.edit_company', ['id' => $company->id])" aria-label="{{__('title.edit_company')}}" title="{{__('title.edit_company')}}">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </x-nav-link>
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.companies_not_found')}}
                            </div>
                        @endforelse
                        <div
                            @if(!$companies->isEmpty()) class="mt-2"> {{$companies->links()}} @else > @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
