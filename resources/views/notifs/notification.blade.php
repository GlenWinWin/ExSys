@for($i = 0; $i < count($messages); $i++)
<li>
  <a>
    <span class="image">
                      <img src="{{$prof_pics[$i]}}" />
                  </span>
    <span class="message">
                      {{$messages[$i]}}
                  </span>
  </a>
</li>
@endfor
