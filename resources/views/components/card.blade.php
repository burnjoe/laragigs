{{-- this merge the passed attribute in the component call with the exisiting attribute value --}}
{{-- eg. if class="bg-gray-50 p-6" and <x-card class="p-10"> --}}
{{-- then: class would be class="bg-gray-50 p-6 p-10"    'p-10' here overrides the 'p-6' --}}
<div {{$attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6'])}}>

  {{-- $slot will hold the content passed in component call --}}
  {{-- this will not need @prop() directive as it is not a component property --}}
  {{$slot}}     

</div>