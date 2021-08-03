<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Ticket Type Management')}}" currentPage="Show" route="{{ route('ticket-type.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $ticket_type->name }}
                </x-breadcrumb>
            </div>
        </div>
        @if(Session::has('success'))
            <x-alert message="{{ Session::get('success') }}" />
        @elseif(Session::has('errors'))
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
                    
                    <form action="{{ route('ticket-type.update', $ticket_type->id) }}" method="POST">
                        @csrf
                
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-4 sm:col-span-4">
                                <x-label for="name" class="font-semibold">Name</x-label>
                                <x-form-input type="text" name="name" id="name" value="{{ $ticket_type->name }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="document_type_id" class="font-semibold">Document Type</x-label>
                                <x-select :lists="$documents" name="document_type_id" :selected="$ticket_type->document_type_id"/>
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Available to Sale Web" name="available_sale_web" :item="$ticket_type"/>
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Available to Coupon" name="available_to_coupon" :item="$ticket_type"/>
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Discount Type" name="discount_type" rightLabel="Decimal" leftLabel="Percent" type="modified" :item="$ticket_type"/>
                            </div>
                            <div class="col-span-full sm:col-span-6">
                                <x-label for="discount" class="font-semibold">Discount</x-label>
                                <x-form-input type="number" name="discount" id="discount" value="{{ $ticket_type->discount }}" />
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Return Discount" name="return_discount" :item="$ticket_type"/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Required Authorization" name="required_authorization" :item="$ticket_type"/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Require Email" name="required_email" :item="$ticket_type"/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Require Telephone" name="required_telephone" :item="$ticket_type"/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="message" class="font-semibold">Message</x-label>
                                <x-text-area name="message" value="{{ $ticket_type->message }}"/>
                            </div>
                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="dependence" class="font-semibold">Dependence</x-label>
                                <multi-select :items="{{ $dependencies }}" label="name" v-slot="{ selected }" name="selectedIds"  :selected-value="{{ $ticket_type->selectedIds }}"></multi-select>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-switch label="Show Message" name="show_message" :item="$ticket_type"/>
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