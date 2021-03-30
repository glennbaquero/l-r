@props(['disabled' => false, 
		'lists' => [], 
		'identifierValue' => 'id', 
		'display' => 'name',
		'selected' => null,
		'oldValue' => null,
		'readonly' => false
		])

<select {{ $disabled ? 'disabled' : '' }} {{ $readonly ? 'readonly' : '' }} {!! $attributes->merge(['class' => 'form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent']) !!} >
    	<option disabled selected>Select your option</option>
    @foreach($lists as $list)
        <option value="{{ $list[$identifierValue] }}" {{ $selected === $list[$identifierValue] ? 'selected' : '' }} {{ $oldValue == $list[$identifierValue] ? 'selected' : '' }}>{{ $list[$display] }}</option>
    @endforeach
</select>