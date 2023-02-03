@props(['disabled'=>'0','val'=>'om','title'=>''])

    <input value='{{$val}}' {{$disabled=='1' ? 'disabled' :''}} {!!$attributes->merge(['class'=>
    'border-gray-300 focus:border-indigo-500
    focus:ring-indigo-500 rounded-md shadow-sm btn-danger']) !!}>

    <div><span class="alert-title">{{$title}}</span><div>
        <div>----</div>
            <div>{{$slot}}</div>
   
