<ul>
    @foreach($subsections as $subsection)
    <li>
        {{ $subsection->title }}
        <a class="btn btn-primary btn-sm rounded-lg"
            href="{{ route('subsections.child.create',['book'=>$book,'section'=>$section,'subsection'=>$subsection]) }}">+</a>
        @if($subsection->subsections->count() > 0)
        @include('partials.subsection', ['subsections' => $subsection->subsections])
        @endif


    </li>
    @endforeach
</ul>