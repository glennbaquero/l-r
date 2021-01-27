<!-- Page Heading -->
<header class="bg-darkblue shadow text-white">
    <nav aria-label="primary" class="flex flex-grow max-w-full space-x-16 mx-8 relative z-20">
        <div class="relative group">
            <button class="flex flex-row items-center w-full py-4 text-base font-semibold text-sm focus:outline-none">
                <span>Dashboard</span>
            </button>
        </div>  
        
        <div class="relative group">
            <!--First level nav-->
            <button class="flex flex-row items-center w-full py-4 text-base font-semibold text-sm focus:outline-none">
                <span>Management</span>
            </button>
            <div class="absolute hidden z-10 bg-darkblue group-hover:block">
                <div class="-mx-4 bg-darkblue shadow-lg">
                    <div class="relative flex w-72 px-8 py-2 group-management hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Management</a>
                        <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                        </svg>

                        <!--Second level nav-->
                        <div class="absolute hidden top-0 left-72 z-10 bg-lightblue group-management-hover:block">
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue group-sales text-base font-normal">
                                <a href="#">Sales Management</a>
                                <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                                </svg>
                                <div class="absolute hidden top-0 left-72 z-10 bg-lighterblue group-sales group-sales-hover:block">
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Expenses & Income</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Coupon Management</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Promotions and Discounts</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Promotion Option</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Open / Close Till</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Open / Close Office</a>
                                    </div>
                                </div>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue group-route text-base font-normal">
                                <a href="#">Route Management</a>
                                <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                                </svg>
                                <div class="absolute hidden top-0 left-72 z-10 bg-lighterblue group-route group-route-hover:block">
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Route</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Multiple Route</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Prices</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Interline Price</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Iteneraries</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Passenger Boarding</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Daily Iteneraries</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Iteneraries, Logs & Notification</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Travel Expense</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Route & Main Driver</a>
                                    </div>
                                </div>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue group-bus text-base font-normal">
                                <a href="#">Bus Management</a>
                                <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                                </svg>
                                <div class="absolute hidden top-0 left-72 z-10 bg-lighterblue group-bus group-bus-hover:block">
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Type of Cell</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Bus Model</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Bus</a>
                                    </div>
                                </div>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">User</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue group-groups text-base font-normal">
                                <a href="#">Groups</a>
                                <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                                </svg>
                                <div class="absolute hidden top-0 left-72 z-10 bg-lighterblue group-groups group-groups-hover:block">
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Group Management</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Grant or Restrict Previleges</a>
                                    </div>
                                    <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                        <a href="#">Group Message</a>
                                    </div>
                                </div>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Options</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Cities</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Offices</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Ticket Type</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Base Fares Administration</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Agency Management</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Services</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Driver Management</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Training Videos</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Tracking Messages</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Group Email Management</a>
                            </div>
                        </div>
                    </div>
                    <div class="relative flex w-72 px-8 py-2 group-configuration hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Configuration</a>
                        <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                        </svg>

                        <!--Second level nav-->
                        <div class="absolute hidden top-0 left-72 z-10 bg-lightblue group-configuration group-configuration-hover:block">
                            <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Terminal Management</a>
                            </div>
                            <div class="w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Printer Management</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative group">
            <!--First level nav-->
            <button class="flex flex-row items-center w-full py-4 text-base font-semibold text-sm focus:outline-none">
                <span>Billings</span>
            </button>

            <div class="absolute hidden z-10 bg-darkblue group-hover:block">
                <div class="-mx-4 bg-darkblue shadow-lg">
                    <div class="relative flex w-72 px-8 py-2 hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Accounts Receivable</a>
                    </div>
                    <div class="relative flex w-72 px-8 py-2 hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Accounts Payable</a>
                    </div>
                    <div class="relative flex w-72 px-8 py-2 hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Payment Document</a>
                    </div>
                    <div class="relative flex w-72 px-8 py-2 hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Authorize.net Transactions</a>
                    </div>
                    <div class="relative flex w-72 px-8 py-2 hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Credit Sales</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative group">
            <!--First level nav-->
            <button class="flex flex-row items-center w-full py-4 text-base font-semibold text-sm focus:outline-none">
                <span>Support</span>
            </button>

            <div class="absolute hidden z-10 bg-darkblue group-hover:block">
                <div class="-mx-4 bg-darkblue shadow-lg">
                    <div class="relative flex w-72 px-8 py-2 hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Information</a>
                    </div>
                    <div class="relative flex w-72 px-8 py-2 hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Tickets Support</a>
                    </div>
                    <div class="relative flex w-72 px-8 py-2 hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Baggage Support</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative group">
            <!--First level nav-->
            <button class="flex flex-row items-center w-full py-4 text-base font-semibold text-sm focus:outline-none">
                <span>Report</span>
            </button>
            <div class="absolute hidden z-10 bg-darkblue group-hover:block">
                <div class="-mx-4 bg-darkblue shadow-lg">
                    <div class="relative flex w-72 px-8 py-2 group-accounts hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Accounts</a>
                        <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                        </svg>

                        <!--Second level nav-->
                        <div class="absolute hidden top-0 left-72 z-10 bg-lightblue group-accounts-hover:block">
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">User</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Receivables</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex w-72 px-8 py-2 group-closure hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Closure of Till</a>
                        <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                        </svg>

                        <!--Second level nav-->
                        <div class="absolute hidden top-0 left-72 z-10 bg-lightblue group-closure-hover:block">
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">My Daily Closure</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Daily Till Closure Reports</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Daily Till Report Terminal</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex w-72 px-8 py-2 group-closure hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Sales</a>
                        <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                        </svg>

                        <!--Second level nav-->
                        <div class="absolute hidden top-0 left-72 z-10 bg-lightblue group-closure-hover:block">
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Users</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Credit Card</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Web and Mobile</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Agency</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Travel</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Ticket</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by State</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Departure - Arrival</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Voucher</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Coupons</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Sales by Trip Type</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Unified Sales</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Unified Sales Grouped</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Unified Sales Simplified</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Total Sales</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex w-72 px-8 py-2 group-closure hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Passengers</a>
                        <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                        </svg>

                        <!--Second level nav-->
                        <div class="absolute hidden top-0 left-72 z-10 bg-lightblue group-closure-hover:block">
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Passengers</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Passengers Transferred</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex w-72 px-8 py-2 group-closure hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Routes</a>
                        <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                        </svg>

                        <!--Second level nav-->
                        <div class="absolute hidden top-0 left-72 z-10 bg-lightblue group-closure-hover:block">
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Reservations per Route</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Price per Route</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Income by Route</a>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex w-72 px-8 py-2 group-closure hover:bg-lightblue text-base font-normal">
                        <a href="#" class="mr-auto">Billing</a>
                        <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
                        </svg>

                        <!--Second level nav-->
                        <div class="absolute hidden top-0 left-72 z-10 bg-lightblue group-closure-hover:block">
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Billing by Transaction</a>
                            </div>
                            <div class="relative flex w-72 px-8 py-2 hover:bg-lighterblue text-base font-normal">
                                <a href="#">Billing by Tickets</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
      </nav>
</header>