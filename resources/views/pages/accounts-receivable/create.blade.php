<x-app-layout>
    <data-table v-slot="{ params, setParam, data, links, meta, next, prev, selectAllHandler, loading }"
                :searches="{{json_encode($searches)}}"
                url="{{route('ticket.fetch')}}"
    >

        <account-receivable-filter v-slot="{ list_office, search, field, office, show, registerPaymentHandler, loading, modalMessage, modalTitle, showModal, closeModal }" :get-offices="{{ $offices }}" register-payment-url="{{ route('ticket.register-payment') }}"> 
            <div class="mx-auto sm:px-6 lg:px-8 py-6">
                <div class="flex items-center">
                    <div class="text-base mr-auto">
                        <span class="font-semibold mr-3">{{__('Accounts Receivable')}}</span>
                    </div>
                </div>


                <div class="mt-12 mx-auto w-3/4">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-1/4 sm:col-span-1/4">
                            <x-label for="state" class="font-semibold">{{__('State')}}</x-label>
                            <multi-select :items="{{$states}}" :multiple="false" v-slot="{ selected }" name="selectedIds" label="name" type="state" search-by="state_name"></multi-select>
                        </div>
                        <div class="col-span-1/4 sm:col-span-1/4">
                            <x-label for="office" class="font-semibold">{{__('Office')}}</x-label>
                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="field.office_id">
                                <option disabled selected>Select your option</option>
                                <option  v-for="office in list_office" :value="office.id">@{{ office.name }}</option>
                            </select>
                            {{-- <x-select :lists="list_office" name="office_id" selected="none"  @change="setParam('office_id', $event.target.value)"/> --}}
                        </div>

                        <toggle v-slot="{ display, toggled }">
                            <div :class="display ? 'col-span-3 sm:col-span-3' : 'col-span-2 sm:col-span-2'">
                                    <div class="col-span-2 sm:col-span-2 grid grid-cols-3 gap-3">
                                        <div class="col-span-1 sm:col-span-1 mx-auto">
                                            <x-label for="" class="font-semibold">Type</x-label>
                                            <div class="flex items-center space-x-3 mt-3">
                                                <span id="toggleLabel">
                                                    <span class="text-sm leading-5 font-medium text-gray-900">Day </span>
                                                </span>
                                                <!-- On: "bg-green-500", Off: "bg-red-500" -->
                                                <span  @click="toggled" role="checkbox" tabindex="0" aria-checked="false" aria-labelledby="toggleLabel" :class="display ? 'bg-green-500' : 'bg-red-500'" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline">
                                                    <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                                    <span aria-hidden="true" :class="display ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
                                                </span>

                                                <span id="toggleLabel">
                                                    <span class="text-sm leading-5 font-medium text-gray-900">Date Range  </span>
                                                </span>
                                                <input type="checkbox" id="type" :checked="display" class="hidden">
                                            </div>
                                        </div>
                                        <div :class="display ? 'col-span-1 sm:col-span-1' : 'col-span-2 sm:col-span-2'">
                                            <x-label for="start_date" class="font-semibold">Start Date</x-label>
                                            <input type="date" v-model="field.date" class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1" v-show="display">
                                            <x-label for="end_date" class="font-semibold">End Date</x-label>
                                            <input type="date" v-model="field.end_date" class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" />
                                        </div>
                                    </div>
                                {{-- <x-label for="route" class="font-semibold">{{__('Select Date')}}</x-label> --}}
                                {{-- <input type="date" v-model="field.date" class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" /> --}}
                            </div>
                        </toggle>


                        <div class="col-span-1/4 sm:col-span-1/4 text-center">
                            <button type="button" class="bg-lightblue border-transparent h-1/2 hover:bg-lighterblue items-center mt-6 rounded-md text-base text-center text-white w-2/4" @click="search">{{__('Search')}}</button>
                        </div>
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

                <div class="mt-12 mx-auto w-3/4" v-if="show">
                    <div class="bg-white shadow sm:rounded-lg">
                        <div class="px-4 py-5 sm:p-6">

                            <form action="" method="POST">
                            {{-- <form action="{{ route('payment-document.store') }}" method="POST"> --}}
                                @csrf
                                <div class="grid grid-cols-2 gap-3" >
                                    <div class="col-span-1 sm:col-span-1">
                                        <div class="grid grid-cols-2 gap-2" >
                                            <div class="col-span-1 sm:col-span-1 text-right">
                                                <x-label class="font-semibold">{{__('Office/Agent')}}: </x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label class="font-semibold">@{{ office.name }}</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1 text-right">
                                                <x-label class="font-semibold">{{__('Sales Pending Receipt')}}:</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label class="font-semibold">0.00</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1 text-right">
                                                <x-label class="font-semibold">{{__('Commission Agent')}}:</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label class="font-semibold">0.00</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1 text-right">
                                                <x-label class="font-semibold">{{__('Net Amount Receivable')}}:</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label class="font-semibold">0.00</x-label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-start-2 sm:col-start-2">
                                        <div class="grid grid-cols-2 gap-2" >
                                            {{-- <div class="col-span-full sm:col-span-full">
                                                <x-label for="payment_document_id" class="font-semibold">{{__('Payment Document')}}</x-label>
                                                <multi-select :items="{{ $payment_documents }}" :multiple="false" label="payment_document" name="payment_document_id"></multi-select>
                                            </div> --}}

                                            {{-- <div class="col-span-1 sm:col-span-1 text-right">
                                                <x-label class="font-semibold">{{__('Value of Payment Document')}}:</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label class="font-semibold">0.00</x-label>
                                            </div> --}}
                                            <div class="col-span-1 sm:col-span-1 text-right">
                                                <x-label class="font-semibold">{{__('Amount Paid')}}:</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label class="font-semibold">0.00</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1 text-right">
                                                <x-label class="font-semibold">{{__('Receivables')}}:</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label class="font-semibold">0.00</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1 text-right">
                                                <x-label class="font-semibold">{{__('Credit')}}:</x-label>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label class="font-semibold">0.00</x-label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <loading
                                    :show="loading"
                                ></loading>
                                
                                <x-modal  :hasFooter="false" maxWidth="max-w-screen-md">
                                    <x-slot name="title">
                                        @{{ modalTitle }}
                                    </x-slot>
                                    <x-slot name="body">
                                        @{{ modalMessage }}
                                    </x-slot>
                                </x-modal>

                                <div class="mt-5 text-center">
                                    <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" @click="registerPaymentHandler">
                                        {{__('Register Payment')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mt-12 mx-auto" v-if="show">
                    
                    <x-table :headers="$headers" canSelectMultiple="true">
                        <x-slot name="body">
                            <tr>
                                <td colspan="13" class="text-center border-b-2 border-gray-300 px-3"></td>
                            </tr>
                            <template v-if="data.length > 0">
                                <tr v-for="(ticket, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        <input type="checkbox" class="inline-flex duration-150 ease-in-out focus:border-blue-300 focus:outline-none focus:shadow-outline-blue form-input leading-none mx-auto my-3 rounded shadow-sm transition" v-model="ticket.is_selected">
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.ticket}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.purchase_date}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.departure}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.arrival}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.travel_date}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.passenger}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.office}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.amount}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.commssion}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.receivable}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.amount_paid}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.balance}}
                                    </td>
                                </tr>
                                <!--Pagination-->
                                <tr>
                                    <td colspan="2" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                    </td>
                                    <td colspan="11" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        <button @click="prev" class="relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.prev">
                                            Previous
                                        </button>
                                        <button @click="next" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.next">
                                            Next
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="13" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        No Record . . .
                                    </td>
                                </tr>
                            </template>
                        </x-slot>
                    </x-table>
                </div>
            </div>
        </account-receivable-filter>
    </data-table>
</x-app-layout>