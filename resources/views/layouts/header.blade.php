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
                                <x-header-sub-link link="{{route('voucher.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Voucher Management</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('coupon.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Coupon Management</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('discount.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Promotions and Discounts</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('discount-option.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Promotion Option</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('promotion.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Frequent Traveler Management</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('open-cash.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Open / Close Till</x-slot>
                                </x-header-sub-link>
                                <x-header-sub-link link="{{route('office.open-close')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Open / Close Office</x-slot>
                                </x-header-sub-link>
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
                                <x-header-sub-link link="{{route('route-main-driver.index')}}" :caret="false" class="hover:bg-lighterblue">
                                    <x-slot name="name">Route & Main Driver</x-slot>
                                </x-header-sub-link>
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
            <x-header-sub-link link="#" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Accounts Receivable</x-slot>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="false" class="hover:bg-lightblue">
                <x-slot name="name">Accounts Payable</x-slot>
            </x-header-sub-link>
            <x-header-sub-link link="#" :caret="false" class="hover:bg-lightblue">
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
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
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
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Credit Card</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Web & Mobile</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Agency</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Travel</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Ticket</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by State</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="{{route('sales-by-departure-arrival')}}" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Sales by Departure - Arrival</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
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
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
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
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Billing by Transaction</x-slot>
                        </x-header-sub-link>
                        <x-header-sub-link link="#" :caret="false" class="hover:bg-lighterblue">
                            <x-slot name="name">Billing by Tickets</x-slot>
                        </x-header-sub-link>
                    </x-header-absolute-link>
            </x-header-sub-link>
        </x-header-link>

      </nav>
</header>