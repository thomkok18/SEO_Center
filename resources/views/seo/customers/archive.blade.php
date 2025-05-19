<x-app-layout
    :active-page="'seo_archive_customer'"
    :css="asset('css/seo/customers/archive.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{__('webpage.archive')}}</h3>
                </div>

                <div class="card-body">
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
                                    <form class="ml-2 p-0" method="POST" action="{{ route('seo.customers.recover', ['customer' => $company->id]) }}">
                                        @csrf
                                        <a class="p-0" href="#" onclick="event.preventDefault(); this.closest('form').submit();" title="{{__('title.archive_customer')}}">
                                            <i class="fas fa-undo-alt fa-2x"></i>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div>
                                {{__('pagination.customers_not_found')}}
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
