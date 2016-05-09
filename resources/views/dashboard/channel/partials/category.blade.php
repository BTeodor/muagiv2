<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="category">Category (Hold Ctrl to select multiple choices)</label>
            <select multiple class="form-control" id="category" name="category[]" required>
                @for($i = 0; $i < count($categories); $i++)
                    @if(isset($chosen_categories))
                        @for($j = 0; $j < count($chosen_categories); $j++)
                        @if($categories[$i]->name_en == $chosen_categories[$j]->name_en) 
                        <option value="{{$categories[$i]->id}}" selected>{{$categories[$i]->name_en}}</option>
                            {{$i++}}
                            {{$j++}}
                        @endif
                        @endfor
                    @endif
                    <option value="{{$categories[$i]->id}}">{{$categories[$i]->name_en}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="event">Events</label>
            <select multiple class="form-control" id="event" name="event[]">
                @foreach($events as $event)
                <option value="{{$event->id}}">{{$event->title}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>