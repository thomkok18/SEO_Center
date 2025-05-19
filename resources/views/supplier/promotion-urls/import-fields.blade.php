<x-app-layout
    :active-page="'supplier_import_fields_promotion_urls'"
    :css="asset('css/supplier/promotion-urls/import-fields.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.import_promotion_urls') }}</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('supplier.promotion-urls.process-import') }}" method="POST">
                        @csrf
                        <input type="hidden" name="data_file_id" value="{{ $csv_data_file->id }}" />

                        <div class="row">
                            <table class="table">
                                @foreach($csv_data as $row)
                                    <tr>
                                        @foreach($row as $key => $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr>
                                    @foreach($csv_data[0] as $key => $value)
                                        <td>
                                            <select class="form-control" name="fields[{{ $key }}]" title="{{__('title.database_column')}}">
                                                @foreach($document_fields as $field)
                                                    <option value="{{ $field }}"
                                                            @if($key === $loop->index) selected @endif>{{ __('promotionUrl.' . $field) }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
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
