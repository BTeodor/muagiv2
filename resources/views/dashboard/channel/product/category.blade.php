<option value="0">All</option>
@foreach($categories as $category)
<option value="{{$category->id}}">{{$category->name_en}}</option>
@endforeach