<x-app-layout
    :active-page="'admin_import_links'"
    :css="asset('css/admin/links/import.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.import_links') }}</h3>
                </div>

                <div class="card-body">
                    @if($errors->hasBag('csvError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('csvError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.links.parse-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <h4 class="card-title">
                                    <label for="csv">{{__('form.single_file')}}</label>
                                </h4>
                                <div class="form-group form-file-upload form-file-simple">
                                    <input type="text" class="form-control inputFileVisible" placeholder="{{__('form.choose_file')}}">
                                    <input id="csv" type="file" class="inputFileHidden" name="data" accept=".csv" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="header" checked> {{__('form.file_contains_header')}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <button class="btn btn-primary" type="submit">{{__('form.import_data')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
