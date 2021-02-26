@props(['label' => null, 'name' => '', 'type' => 'default', 'rightLabel' => null, 'leftLabel' => null, 'item', 'hasParentToggle' => 0, 'toshowdata' => 0])

<x-label for="{{ $name }}" class="font-semibold">{{ $label }}</x-label>
<toggle :item="{{ $item ?? auth()->user() }}" toggleable-data="{{ $name }}" :hasParentToggle="{{ $hasParentToggle }}" :toshowdata="{{ $toshowdata }}" >
    <div slot-scope="{ display, toggled }" class="flex items-center space-x-3 mt-4">
        <span id="toggleLabel">
            <span class="text-sm leading-5 font-medium text-gray-900">{{ $type === 'default' ? 'No' : $rightLabel }} </span>
        </span>
        <!-- On: "bg-green-500", Off: "bg-red-500" -->
        <span  @click="toggled" role="checkbox" tabindex="0" aria-checked="false" aria-labelledby="toggleLabel" :class="display ? 'bg-green-500' : 'bg-red-500'" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline">
            <!-- On: "translate-x-5", Off: "translate-x-0" -->
            <span aria-hidden="true" :class="display ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
        </span>

        <span id="toggleLabel">
            <span class="text-sm leading-5 font-medium text-gray-900">{{ $type === 'default' ? 'Yes' : $leftLabel }}  </span>
        </span>
        <input type="checkbox" name="{{ $name }}" :checked="display" class="hidden">
    </div>

</toggle>