<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="mt-12 mx-auto w-5/6">
            <div class="bg-white shadow shadow-2xl">
                <div class="px-4 py-5 sm:p-6">
                    <div class="text-center">
                        <h2 class="font-bold text-3xl text-lightblue">Open Cash</h2>
                    </div>

                    <open-cash v-slot="{ cash, cash_entry, addCash, enterCash }">

                        <form action="{{ route('open-cash.store') }}" method="POST">
                            @csrf

                            <div class="gap-6 grid grid-cols-4 mt-12">

                                <div class="col-span-3 sm:col-span-3">
                                    <div class="grid grid-cols-6 gap-1 ">
                                        <div class="col-span-full sm:col-span-full">
                                            <p class="border-b-2 border-lighterblue font-semibold text-lighterblue w-36">User Information</p>
                                        </div>
                                        <div class="col-span-3 sm:col-span-3 mt-4">
                                            <x-label for="name" class="text-lg">Name : {{ auth()->user()->firstname }}</x-label>
                                        </div>
                                        <div class="col-span-3 sm:col-span-3 mt-4">
                                            <x-label for="name" class="text-lg">Username : {{ auth()->user()->username }}</x-label>
                                        </div>
                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="name" class="text-lg">Last Name : {{ auth()->user()->lastname }}</x-label>
                                        </div>
                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="name" class="text-lg">Group : {{ auth()->user()->group->name }}</x-label>
                                        </div>
                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="name" class="text-lg">Email : {{ auth()->user()->email }}</x-label>
                                        </div>
                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="name" class="text-lg">Office : {{ auth()->user()->office->name }}</x-label>
                                        </div>

                                        <div class="col-span-full sm:col-span-full mt-4">
                                            <p class="border-b-2 border-lighterblue font-semibold text-lighterblue width-29-percent">Information on Opening Cash</p>
                                        </div>

                                        <div class="col-span-full sm:col-span-full mt-3">
                                            <x-label for="name" class="text-lg">You are opening cash in office <b>{{ auth()->user()->office->name }}</b></x-label>
                                        </div>

                                        <div class="col-span-2 mt-3 pl-5 sm:col-span-2">
                                            <x-form-input type="number" min="0" step="any" name="amount_added" id="amount_added" @change="enterCash($event.target.value)" classAttrib="bg-gray-200 border-transparent duration-150 ease-in-out focus:border-blue-300 focus:outline-none focus:shadow-outline-blue form-input leading-none px-3 py-2 rounded shadow-sm transition w-full" />
                                            <input type="hidden" name="cash" v-model="cash">
                                        </div>
                                        <div class="col-span-2 sm:col-span-2 mt-3">
                                            <button tabindex="3" type="button" class="active:bg-lighterblue bg-lightblue border border-transparent duration-150 ease-in-out flex focus:border-blue-700 focus:border-lighterblue focus:outline-none focus:shadow-outline-blue focus:shadow-outline-lighterblue font-medium hover:bg-lighterblue justify-center px-4 py-0.5 rounded sm:leading-8 text-sm text-white transition" @click="addCash">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-start-4 sm:col-start-4">
                                    <div class="bg-gradient-to-r col-span-1 from-darkblue h-4/6 rounded-lg sm:col-span-1 text-center to-darkblue via-lightblue">
                                        <div class="">
                                            <p class="font-medium mx-auto text-2xl text-white">Initial Cash</p>
                                            <p class="font-bold mt-4 text-5xl text-white">$ @{{ cash }}</p>
                                        </div>
                                        
                                        <div class="mt-10 mx-auto">
                                            <button tabindex="3" type="submit" class="active:bg-white bg-white border border-transparent flex focus:shadow-outline-white font-bold h-5/6 h-9 hover:bg-white justify-center mt-0.5 mx-auto my-auto px-4 py-2 rounded text-lighterblue text-sm w-5/12">
                                                Apply
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                        
                    </open-cash>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>