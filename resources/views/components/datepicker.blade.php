@props(['disabled' => false, 'name' => 'date', 'item' => auth()->user(), 'type' => 'date', 'format' => 'YYYY-MM-DD'])

<date-picker name="{{ $name }}" :item="{{$item}}" type="{{ $type }}" format="{{ $format }}"></date-picker>