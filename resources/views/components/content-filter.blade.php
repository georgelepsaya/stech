@props(['types'])

<label for="page_type" class="block mt-2 mb-2 text-lg text-bold">{{__('general.search_question')}}</label>
<select class="cursor-pointer block dark:bg-gray-700 shadow-sm rounded-md border dark:border-gray-600 border-gray-300 focus:ring-0 focus:outline-none focus:border-gray-600" id="page_type" name="page_type">
    @foreach($types as $type => $name)
        <option value="{{$type}}" @if(request()->page_type == $type) selected @endif>{{$name}}</option>
    @endforeach
</select>