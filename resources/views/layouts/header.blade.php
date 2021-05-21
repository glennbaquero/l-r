<!-- Page Heading -->
<header class="bg-darkblue shadow text-white">
    <nav aria-label="primary" class="flex flex-grow max-w-full space-x-16 mx-8 relative z-20">
        <x-header-link link="{{route('dashboard')}}">
            <x-slot name="name">{{__('Dashboard')}}</x-slot>
        </x-header-link>
        
        <x-header-link link="{{route('dashboard')}}">
            <x-slot name="name">{{__('Management')}}</x-slot>
            <x-header-sub-link link="#" :caret="true" class="group-management hover:bg-lightblue">
                <x-slot name="name">{{__('Management')}}</x-slot>
                    <x-header-absolute-link class="group-management-hover:block bg-lightblue">
                        <x-header-sub-link link="#" :caret="true" class="group-sales hover:bg-lighterblue">
                            <x-slot name="name">Sales Management</x-slot>
                            <x-header-absolute-link class="group-sales group-sales-hover:block bg-lighterblue">
                                <x-header-sub-link link="{{route('expense-income.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Expenses & Income</x-slot>
                                </x-header-sub-link>
                                {{-- <x-header-sub-link link="{{route('voucher.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Voucher Management</x-slot>
                                </x-header-sub-link> --}}
                                <x-header-sub-link link="{{route('coupon.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Coupon Management</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('discount.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    {{-- <x-slot name="name">Promotions and Discounts</x-slot> --}}
                                    <x-slot name="name">Used Coupon</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('discount-option.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Promotion Option</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('frequent-traveler.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Frequent Traveler Management</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('open-cash.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Open / Close Till</x-slot>
                                </x-header-sub-link>
                                {{-- <x-header-sub-link link="{{route('office.open-close')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Open / Close Office</x-slot>
                                </x-header-sub-link> --}}
                            </x-header-absolute-link>
                        </x-header-sub-link>
                        
                        <x-header-sub-link link="#" :caret="true" class="group-route hover:bg-lighterblue">
                            <x-slot name="name">Route Management</x-slot>
                            <x-header-absolute-link class="group-route group-route-hover:block bg-lighterblue">
                                <x-header-sub-link link="{{route('route.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Route</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('multi-route.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Multiple Route</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('price.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Prices</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('interline-price.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Interline Price</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('trip.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Itineraries</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('boarding.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Passenger Boarding</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('daily-itinerary.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Daily Itineraries</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('itinerary-update.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Itineraries, Logs & Notifications</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('travel-expense.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Travel Expense</x-slot>
                                </x-header-sub-link>
                                {{-- <x-header-sub-link link="{{route('route-main-driver.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Route & Main Driver</x-slot>
                                </x-header-sub-link> --}}
                            </x-header-absolute-link>
                        </x-header-sub-link>
                        
                        <x-header-sub-link link="#" :caret="true" class="group-bus hover:bg-lighterblue">
                            <x-slot name="name">Bus Management</x-slot>
                            <x-header-absolute-link class="group-bus group-bus-hover:block bg-lighterblue">
                                <x-header-sub-link link="{{route('cell.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Type of Cell</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('bus-model.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Bus Model</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('bus.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Bus</x-slot>
                                </x-header-sub-link>
                            </x-header-absolute-link>
                        </x-header-sub-link>

                        <x-header-sub-link link="{{route('user.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">{{__('Users')}}</x-slot>
                        </x-header-sub-link>

                        <x-header-sub-link link="#" :caret="true" class="group-groups hover:bg-lighterblue">
                            <x-slot name="name">Groups</x-slot>
                            <x-header-absolute-link class="group-groups group-groups-hover:block bg-lighterblue">
                                <x-header-sub-link link="{{route('group.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Group Management</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{ route('group-privilege.index') }}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Grant or Restrict Previleges</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('group-message.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Group Message</x-slot>
                                </x-header-sub-link>
                            </x-header-absolute-link>
                        </x-header-sub-link>

                        <x-header-sub-link link="{{route('option.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Options</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('city.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Cities</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('office.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">{{__('Offices')}}</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('currency.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">{{__('Currency')}}</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('ticket-type.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Ticket Type</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('company.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Agency</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Base Fares Administration</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Agency Management</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('service.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Services</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('driver.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Driver Management</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Training Videos</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Tracking Messages</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('group-email.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Group Email Management</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('recommendation.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Recommendation Management</x-slot>
                        </x-header-sub-link>
                </x-header-absolute-link>
            </x-header-sub-link>

            <x-header-sub-link link="#" :caret="true" class="group-configuration hover:bg-lightblue">
                <x-slot name="name">{{__('Configuration')}}</x-slot>
                    <x-header-absolute-link class="group-configuration-hover:block bg-lightblue">
                        {{-- <x-header-sub-link link="{{route('terminal.index')}}" :caret="false" class="group-sales hover:bg-lighterblue">
                            <x-slot name="name">Terminal Management</x-slot>
                        </x-header-sub-link> --}}
                        <x-header-sub-link link="{{route('printer.index')}}" :caret="false" class="group-sales hover:bg-lighterblue">
                            <x-slot name="name">Printer Management</x-slot>
                        </x-header-sub-link>
                    </x-header-absolute-link>
            </x-header-sub-link>
        </x-header-link>

        <x-header-link link="{{route('dashboard')}}">
            <x-slot name="name">{{__('Billing')}}</x-slot>
            <x-header-sub-link link="{{route('account-receivable.index')}}" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Accounts Receivable</x-slot>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Accounts Payable</x-slot>
            </x-header-sub-link>
            <x-header-sub-link link="{{route('payment-document.index')}}" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Payment Document</x-slot>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Authorize.net Transactions</x-slot>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Credit Sales</x-slot>
            </x-header-sub-link>
        </x-header-link>

        <x-header-link link="{{route('dashboard')}}">
            <x-slot name="name">{{__('Support')}}</x-slot>
            <x-header-sub-link link="{{route('information.index')}}" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Information</x-slot>
            </x-header-sub-link>
            <x-header-sub-link link="{{route('ticket-support.index')}}" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Tickets Support</x-slot>
            </x-header-sub-link>
            <x-header-sub-link link="{{route('baggage.index')}}" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Baggage Support</x-slot>
            </x-header-sub-link>
        </x-header-link>

        <x-header-link link="{{route('dashboard')}}">
            <x-slot name="name">{{__('Report')}}</x-slot>
            <x-header-sub-link link="#" :caret="true" class="group-account hover:bg-lightblue">
                <x-slot name="name">Accounts</x-slot>
                    <x-header-absolute-link class="group-account-hover:block bg-lightblue">
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Checklist</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('receivable')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Receivables</x-slot>
                        </x-header-sub-link>
                    </x-header-absolute-link>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="true" class="group-closure hover:bg-lightblue">
                <x-slot name="name">Closure of Till</x-slot>
                    <x-header-absolute-link class="group-closure-hover:block bg-lightblue">
                        <x-header-sub-link link="{{route('my-daily-closure')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">My Daily Closure</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('daily-till-closure')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Daily Till Closure Reports</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('daily-till-report-terminal')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Daily Till Report Terminal</x-slot>
                        </x-header-sub-link>
                    </x-header-absolute-link>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="true" class="group-reportsale hover:bg-lightblue">
                <x-slot name="name">Sales</x-slot>
                    <x-header-absolute-link class="group-reportsale-hover:block bg-lightblue">
                        <x-header-sub-link link="{{route('sales-by-user')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Users</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('sales-by-credit-card')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Credit Card</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Web & Mobile</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('sales-by-agency')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Agency</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('sales-by-travel')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Travel</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('sales-by-ticket')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Ticket</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('sales-by-state')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by State</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('sales-by-departure-arrival')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Departure - Arrival</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('sales-by-voucher')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Voucher</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sasles by Coupons</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Trip Type</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Unified Sales</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Unified Sales Grouped</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Unified Sales Simplified</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Total Sales</x-slot>
                        </x-header-sub-link>
                    </x-header-absolute-link>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="true" class="group-passenger hover:bg-lightblue">
                <x-slot name="name">Passenger</x-slot>
                    <x-header-absolute-link class="group-passenger-hover:block bg-lightblue">
                        <x-header-sub-link link="{{route('passenger-report.index')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Passengers</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Passengers Transferred</x-slot>
                        </x-header-sub-link>
                    </x-header-absolute-link>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="true" class="group-route hover:bg-lightblue">
                <x-slot name="name">Routes</x-slot>
                    <x-header-absolute-link class="group-route-hover:block bg-lightblue">
                        <x-header-sub-link link="{{route('reservation-per-route')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Reservation per Route</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('price-per-route')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Price per Route</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('income-by-route')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Income by Route</x-slot>
                        </x-header-sub-link>
                    </x-header-absolute-link>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="true" class="group-route hover:bg-lightblue">
                <x-slot name="name">Billings</x-slot>
                    <x-header-absolute-link class="group-route-hover:block bg-lightblue">
                        <x-header-sub-link link="{{route('billing-by-transactions')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Billing by Transaction</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('billing-by-tickets')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Billing by Tickets</x-slot>
                        </x-header-sub-link>
                    </x-header-absolute-link>
            </x-header-sub-link>
        </x-header-link>

        <toggle v-slot="{ display, toggled }">
            <div class="gap-1 grid grid-cols-5  mx-auto my-auto relative w-full">
                <div class="col-span-4 sm:col-span-4 text-right">
                    
                    <x-modal :hasFooter="false" maxWidth="max-w-4xl text-black">
                        <x-slot name="button">
                            <a href="#" @click="toggled" class="align-middle focus:outline-none focus:shadow-outline inline-flex w-5">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                            </a>
                        </x-slot>

                        <x-slot name="title">
                            Create Notification
                        </x-slot>

                        <x-slot name="body">
                            <form-data v-slot="{ actionHandler, payload, result }" url="{{ route('notify.users') }}" :for-notification="true">
                                <div>
                                    <loading></loading>
                                    <toggle-select v-slot="{ selectChanged, item, display }">
                                        <div class="grid grid-cols-6 gap-6 text-left">
                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="send_to" class="font-semibold">Send To</x-label>
                                                <x-select :lists="$senders" name="send_to" identifierValue="name" v-model="payload.send_to" @change="selectChanged({{$senders}}, $event.target.value, 'notification')" />
                                            </div>

                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="send_to" class="font-semibold"  v-if="item != 'All' && display">@{{ item }}</x-label>
                                                <multi-select v-if="item == 'User' && display" :items="{{ $users }}" label="fullname" name="users" name_2="user_ids"></multi-select>
                                                <multi-select v-if="item == 'Group' && display" :items="{{ $groups }}" label="name" name="group"></multi-select>
                                                <multi-select v-if="item == 'Office' && display" :items="{{ $offices }}" label="name" name="office"></multi-select>
                                                <multi-select v-if="item == 'City' && display" :items="{{ $cities }}" label="name" name="city"></multi-select>
                                            </div>

                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="subject" class="font-semibold">Subject</x-label>
                                                <x-form-input type="text" name="subject" id="subject" v-model="payload.subject" />
                                            </div>

                                            <div class="col-span-full sm:col-span-full">
                                                <x-label for="message" class="font-semibold">Message</x-label>
                                                <x-text-area name="message" id="message" v-model="payload.message"/>
                                            </div>
                                        </div>
                                    </toggle-select>
                                    <div class="mt-5 text-right">
                                        <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36" @click="actionHandler">
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </form-data>
                        </x-slot>

                    </x-modal>

                </div>

                <update-notification v-slot="{ updateNotificationHandler, unread }" url="{{ route('notification.read') }}" unread-count="{{ $notifications->whereNull('read_at')->count() }}">
                    <div class="bg-darkblue col-span-1 group sm:col-span-1 text-center">
                        <a href="#" @click="toggled(); updateNotificationHandler()">Notifications (@{{ unread }})</a>
                    </div>
                </update-notification>

                <div class="absolute bg-darkblue col-start-3 group-hover:block mt-10 w-full z-10" :class="display ? '' : 'hidden'">
                    <div class="bg-darkblue shadow-lg w-full">
                        <div class="relative flex w-full px-4 py-2 text-base font-normal group-account hover:bg-lightblue">
                            <div class="grid grid-cols-10 gap-2">
                            @foreach($notifications as $notification)
                                <div class="col-span-1 sm:col-span-1">
                                    <img src="{{ $notification->data['sender_image'] }}" class="h-10 rounded-full w-10">
                                </div>
                                <div class="col-span-4 sm:col-span-4 my-auto">
                                    {{ $notification->data['sender'] }}
                                </div>
                                <div class="col-span-5 sm:col-span-5 my-auto">
                                     {{ $notification->data['timestamp'] }}
                                </div>

                                <div class="col-span-full sm:col-span-full pl-5">
                                    <p><b> {{ !$notification->data['is_reply'] ? '' : 'Reply to' }} {{ $notification->data['title'] }}</b></p>
                                    {{ $notification->data['message'] }}
                                </div>
                                <div class="col-span-full sm:col-span-full">
                                    <x-modal :hasFooter="false" maxWidth="max-w-4xl text-black">
                                        <x-slot name="button">
                                            <a href="#" @click="toggled">Reply</a>
                                        </x-slot>

                                        <x-slot name="title">
                                            {{ $notification->data['is_reply'] ? '' : 'Reply to' }}  {{ $notification->data['title'] }}
                                        </x-slot>

                                        <x-slot name="body">
                                            <form-data v-slot="{ actionHandler, payload, result }" url="{{ route('reply-to-notification', $notification->id) }}" :for-reply="true">
                                                <div>
                                                    <loading></loading>
                                                    <toggle-select v-slot="{ selectChanged, item, display }">
                                                        <div class="grid grid-cols-6 gap-6 text-left">
                                                            <div class="col-span-full sm:col-span-full">
                                                                <x-label for="message" class="font-semibold">Message</x-label>
                                                                <x-text-area name="message" id="message" v-model="payload.message"/>
                                                            </div>
                                                        </div>
                                                    </toggle-select>
                                                    <div class="mt-5 text-right">
                                                        <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36" @click="actionHandler">
                                                            Send
                                                        </button>
                                                    </div>
                                                </div>
                                            </form-data>
                                        </x-slot>

                                    </x-modal>
                                </div>
                            @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </toggle>

      </nav>
</header>