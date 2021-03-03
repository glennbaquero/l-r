@props(['divClass' => 'col-span-full sm:col-span-full'])

<div class="{{$divClass}}" slot-scope="{ image, fileChanged, display }">
    <x-label for="file_path" class="font-semibold">Upload Photo</x-label>
    <img :src="image" class="w-1/4" v-if="display">
    <input type="file" name="file_path" ref="file" accept="image/*" id="file" @change="fileChanged()" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
</div>