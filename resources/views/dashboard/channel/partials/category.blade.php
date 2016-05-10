<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="category">Category (Hold Ctrl to select multiple choices)</label>
            <select multiple class="form-control" id="category" name="category[]" required>
                @foreach($categories as $category)
                    {{$mark = 0}}
                    {{$flag = 0}}
                    {{$num = 0}}
                    @if(isset($chosen_categories))
                        @foreach($chosen_categories as $chosen_category)
                            {{$num += 1}}
                            @if($category->id != $chosen_category->id) 
                            {{$mark += 1}}
                            @endif
                        @endforeach
                    @endif
                    @if($mark == $num) {{$flag = 0}}
                    @else {{$flag = 1}}
                    @endif
                    @if($flag == 1)
                        <option value="{{$category->id}}" selected>{{$category->name_en}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name_en}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="event">Events</label>
            <select multiple class="form-control" id="event" name="event[]">
                @foreach($events as $event)
                    {{$mark = 0}}
                    {{$flag = 0}}
                    {{$num = 0}}
                    @if(isset($chosen_events))
                        @foreach($chosen_events as $chosen_event)
                            {{$num += 1}}
                            @if($event->id != $chosen_event->id) 
                            {{$mark += 1}}
                            @endif
                        @endforeach
                    @endif
                    @if($mark == $num) {{$flag = 0}}
                    @else {{$flag = 1}}
                    @endif
                    @if($flag == 1)
                        <option value="{{$event->id}}" selected>{{$event->title}}</option>
                    @else
                        <option value="{{$event->id}}">{{$event->title}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>