<x-app-layout
    :active-page="'admin_create_company'"
    :css="asset('css/admin/companies/create.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{__('webpage.add_company')}}</h3>
                </div>

                <div class="card-body">
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
                        <form class="w-100" method="POST" action="{{ route('admin.companies.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="name">{{__('company.name')}}</x-label>
                                        <x-input id="name" type="text" name="name" :value="old('name')" placeholder="Google" required autofocus/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <button class="btn btn-primary" type="submit">{{__('form.submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
