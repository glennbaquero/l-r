@props(['disabled' => false, 'name' => 'date', 'item' => auth()->user()])

<date-picker name="{{ $name }}" :item="{{$item}}"></date-picker>