<x-app-layout
    :active-page="'seo_edit_website_budget'"
    :css="asset('css/seo/customers/websites/budgets/edit.min.css')"
    :font-awesome="true"
>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">{{ __('webpage.edit_website_budget') }}</h3>
                </div>

                <div class="card-body">
                    @if($errors->hasBag('budgetError'))
                        <div class="alert alert-danger" role="alert">
                            <ul class="m-0">
                                @foreach($errors->getBag('budgetError')->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-md-flex align-items-center">
                        <form class="w-100" method="POST" action="{{ route('seo.customers.websites.budgets.update', ['customer' => $customer_id, 'website' => $website_id, 'budget' => $budget->id]) }}">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-md-7 pr-1">
                                    <div class="form-group">
                                        <x-label for="startdate">{{__('budget.start_date')}}</x-label>
                                        <input id="startdate" class="form-control" type="date" name="date" value="{{$budget->date}}" disabled autofocus/>
                                    </div>
                                    <div class="form-group">
                                        <x-label for="amount">{{__('budget.amount')}}</x-label>
                                        <input id="amount" class="form-control" type="number" min="0" step="0.01" name="amount" value="{{$budget->amount}}" required autofocus/>
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
