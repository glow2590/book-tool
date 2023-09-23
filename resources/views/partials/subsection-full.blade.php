<ul>
    @foreach($subsections as $subsection)
    <li>
        <h5> {{ $subsection->title }} @if (auth()->user()->id == $book->author_id)
            <a class="btn  btn-success btn-sm"
                href="{{ route('subsections.edit',[$book,$section,$subsection]) }}">Edit</a>
            <a class="btn btn-sm btn-danger"
                href="{{ route('subsections.destroy',[$book,$section,$subsection]) }}">Delete</a>
            @endif
        </h5>
        <br>
        <article>
            {!! $subsection->content !!}
        </article>
        <br>
        @if($subsection->subsections->count() > 0)
        @include('partials.subsection-full', ['subsections' => $subsection->subsections])
        @endif


    </li>
    @endforeach
</ul>