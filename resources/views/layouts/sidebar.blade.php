
<sidebar-action v-slot="{ open, updateOpen, showDropdown, updateShowDropdown, showMobileResponsive, updateMobileResponsive }">
	<div @click="updateOpen" class="bg-darkblue flex flex-col flex-shrink-0 md:w-64 shadow w-full">
	  <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
	    <a href="#" class="font-semibold text-lg text-white tracking-widest uppercase">Fronteras Del Norte</a>
	    <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="updateMobileResponsive">
	      <svg fill="white" viewBox="0 0 20 20" class="w-6 h-6">
	        <path v-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
	        <path v-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
	      </svg>
	    </button>
	  </div>
	  <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">
	    <p class="block px-4 py-2 text-sm font-semibold text-white rounded-lg dark-mode:bg-gray-700 mb-4" href="#">Hi, {{ auth()->user()->fullname }}</p>
	    <a class="block dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 focus:outline-none focus:shadow-outline focus:text-white font-semibold hover:bg-white hover:text-darkblue mt-2 px-4 py-2 rounded-lg text-sm text-white" href="{{ route('driver-dashboard') }}" >
	    	Dashboard
	    </a>
	    <a class="block dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 focus:outline-none focus:shadow-outline focus:text-white font-semibold hover:bg-white hover:text-darkblue mt-2 px-4 py-2 rounded-lg text-sm text-white" href="{{ route('scanner') }}" >
	    	Scan QR
	    </a>
	    <a class="block dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 focus:outline-none focus:shadow-outline focus:text-white font-semibold hover:bg-white hover:text-darkblue mt-2 px-4 py-2 rounded-lg text-sm text-white" href="{{ route('driver.transaction-number') }}" >
	    	Enter Transaction/Reference Number
	    </a>

	    <form method="POST" action="{{ route('logout') }}">
	        @csrf

            <a class="block px-4 py-2 mt-2 text-sm font-semibold text-white bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-darkblue dark-mode:text-gray-200 hover:text-darkblue focus:text-white hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
	    </form>
	  </nav>
	</div>
</sidebar-action>
