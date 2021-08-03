<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Ticket Type Management')}}" route="{{ route('ticket-type.index') }}"></x-breadcrumb>
            </div>
        </div>


        @if(Session::get('errors'))
            <x-alert message="Error encountered" type="error" >
                @if ($errors->any())
                    <ul class="list-inside list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </x-alert>
        @endif

        <div class="mt-12 mx-auto w-3/4">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <form action="{{ route('ticket-type.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-4 sm:col-span-4">
                                <x-label for="name" class="font-semibold">Name</x-label>
                                <x-form-input type="text" name="name" id="name" value="{{ old('name') }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="document_type_id" class="font-semibold">Document Type</x-label>
                                <x-select :lists="$documents" name="document_type_id"/>
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Available to Sale Web" name="available_sale_web" />
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Available to Coupon" name="available_to_coupon" />
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Discount Type" name="discount_type" rightLabel="Decimal" leftLabel="Percent" type="modified"/>
                            </div>
                            <div class="col-span-full sm:col-span-6">
                                <x-label for="discount" class="font-semibold">Discount</x-label>
                                <x-form-input type="number" min="0" name="discount" id="discount" value="{{ old('discount') }}" required/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Return Discount" name="return_discount"/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Required Authorization" name="required_authorization"/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Require Email" name="required_email"/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Require Telephone" name="required_telephone"/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="message" class="font-semibold">Message</x-label>
                                <x-text-area name="message"/>
                            </div>
                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="dependence" class="font-semibold">Dependence</x-label>
                                <multi-select :items="{{ $dependencies }}" label="name" v-slot="{ selected }" name="selectedIds"></multi-select>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Show Message" name="show_message"/>
                            </div>
                        </div>
                        <div class="mt-5 text-left">
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>