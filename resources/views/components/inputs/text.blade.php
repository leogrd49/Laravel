@props(['property', 'label', 'default'])

<label for="{{ $property }}">{{ $label }}</label>
<input type="text" name="{{ $property }}" id="{{ $property }}" value="">
