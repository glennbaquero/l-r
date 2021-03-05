@props(['label' => null, 'type' => 'default', 'singleBtnLabel' => 'Edit', 'rightBtnLabel' => 'Activated', 'leftBtnLabel' => 'Deactivated', 'divLabelClass'=>'mt-3 text-center sm:mt-5', 'textSize'=>'text-lg', 'buttonMarginWithLabel' => 'mt-11 sm:mt-12'])

<toggle>
	<div slot-scope="{ display, toggled, toggledState }" class="inset-x-0 px-4 pb-6 sm:inset-0 sm:p-0 sm:flex">
	    <div class="bg-white overflow-hidden shadow-xl sm:max-w-sm sm:w-full transform transition-all">
	        <div>
	            <div class="{{ $divLabelClass }}">
	                <h3 class="{{$textSize}} leading-6 font-medium text-gray-700">
	                    {{ $label }}
	                </h3>
	            </div>
	        </div>
	        <div class="{{$buttonMarginWithLabel}}">
	            <span class="flex w-full shadow-sm">
	            	@if($type === 'default')
	            		<div class="grid grid-cols-4 gap-0.5" v-if="display">
	            			<div class="col-span-2 sm:col-span-2">
			            		<x-form-input />
			            	</div>
	            			<div class="col-span-1 sm:col-span-1">
	            				<button type="button" @click="toggled" class="bg-gray-200 focus:outline-none font-lg justify-center leading-6 mx-auto my-3 py-2 shadow-sm px-3 w-full h-9">
	            					Cancel
	            				</button>
	            			</div>
	            			<div class="col-span-1 sm:col-span-1">
	            				<button type="button" @click="toggled" class="bg-gray-200 focus:outline-none font-lg justify-center leading-6 mx-auto my-3 py-2 shadow-sm px-3 w-full h-9">
	            					Save
	            				</button>
	            			</div>
	            		</div>

		                <button v-if="!display" type="button" @click="toggled" class="bg-gray-200 focus:outline-none font-lg justify-center leading-6 px-4 py-2 shadow-sm sm:leading-5 sm:text-md text-base transition w-full">
		                    {{ $singleBtnLabel }}
		                </button>
	                @else
		                <button type="button" @click="toggledState(true)" :class="display ? 'bg-green-500 text-white' : ''" class="focus:outline-none font-lg justify-center leading-6 px-4 py-2 shadow-sm sm:leading-5 sm:text-md text-base transition w-full">
		                    {{ $rightBtnLabel }}
		                </button>
		                {{-- <button type="button" class=" focus:outline-none font-lg justify-center leading-6 px-4 py-2 shadow-sm sm:leading-5 sm:text-md text-base transition w-full"> --}}
		                <button type="button" @click="toggledState(false)" :class="!display ? 'bg-red-500 text-white' : ''" class="focus:outline-none font-lg justify-center leading-6 px-4 py-2 shadow-sm sm:leading-5 sm:text-md text-base transition w-full">
		                    {{ $leftBtnLabel }}
		                </button>
	                @endif
	            </span>
	        </div>
	    </div>
	</div>
</toggle>
