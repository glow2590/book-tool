@extends('layouts.app')

@section('content')
<style>
    /*
CSS for support pages.
*/
    .list-group-item-transparent {
        --bs-list-group-action-hover-color: var(--bs-emphasis-color);
        --bs-list-group-action-hover-bg: var(--bs-light-border-subtle);
        --bs-list-group-action-active-color: var(--bs-emphasis-color);
        --bs-list-group-action-active-bg: var(--bs-light-border-subtle);
        --bs-list-group-active-color: var(--bs-light-bg-subtle);
        --bs-list-group-active-bg: var(--bs-light-text-emphasis);
        --bs-list-group-active-border-color: var(--bs-light-text-emphasis);
    }


    #page-sidebar {
        --sp-sidebar-width: 250px;
    }


    .btn-invisible-bg {
        background-color: transparent;
    }


    .list-group-item a {
        color: inherit;
        text-decoration: none;
    }

    .list-group-item-transparent {
        background-color: transparent;
    }


    #page-content-wrapper {
        min-height: 100vh;
        width: 100%;
    }


    #page-sidebar {
        max-width: var(--sp-sidebar-width);
        min-height: 100vh;
        min-width: var(--sp-sidebar-width);
        transition: all .3s;
    }

    #page-sidebar {
        margin-left: calc(var(--sp-sidebar-width) * -1);
    }

    #page-sidebar.active {
        margin-left: 0;
    }

    @media (min-width: 992px) {

        #page-sidebar,
        #page-sidebar.active {
            margin-left: 0;
        }
    }


    #page-topbar,
    #sidebar-header {
        height: 50px;
    }
</style>

<main id="page-wrapper" class="d-flex">

    <nav id="page-sidebar" class="bg-light border-end">
        @if (auth()->user()->id == $book->author_id)
        <a href="{{ route('sections.create',$book) }}" class="btn btn-success btn-sm">Add A Section</a>

        @endif
        <div id="sidebar-header" class="bg-primary h3 my-0">
            <a class="d-block h-100 link-light link-underline-opacity-0 py-2 px-3" href="../index.html">Sections</a>
        </div><!-- #sidebar-header -->
        @php
        $currentSection = $section;
        @endphp
        <ul class="list-group list-group-flush">
            @foreach ($book->sections as $item)

            <li
                class="list-group-item list-group-item-transparent list-group-item-action  {{ $item->id == $currentSection->id?'active':'' }}">
                <a class="d-block" href="{{ route('sections.show',[$book,$item]) }}">{{ $item->title }}</a>
                @if ($item->subsections->count() > 0)
                @php
                $topLevelSubsections = $item->subsections->where('parent_id', null);

                @endphp
                <ul style="background: lightgray; color:black">
                    <h6>Subsections </h6>

                    <li style="">
                        @include('partials.subsection', ['subsections' => $topLevelSubsections])

                    </li>
                </ul>
            </li>

            @endif

            @endforeach

        </ul>

    </nav><!-- #page-sidebar -->
    <div id="page-content-wrapper">
        <div id="page-topbar" class="border-bottom">
            <button id="btn-toggle-sidebar"
                class="btn btn-light btn-invisible-bg border border-0 rounded-0 px-4 h-100 d-lg-none d-xl-none d-xxl-none"
                type="button" title="แสดง/ซ่อน บาร์ด้านข้าง">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                <span class="visually-hidden-focusable">แสดง/ซ่อน บาร์ด้านข้าง</span>
            </button>
        </div><!-- #page-topbar -->
        @if (auth()->user()->id == $book->author_id)

        <a href="{{ route('subsections.create',[$book,$section]) }}" class="btn btn-success btn-sm">Add A
            Sub-Section</a>
        @endif
        <a href="{{route('sections.edit',['book'=>$book,'section'=>$section]) }}" class="btn btn-light btn-sm">Edit
            Section</a>
        @if (auth()->user()->id == $book->author_id)

        <a href="{{route('sections.destroy',['book'=>$book,'section'=>$section]) }}"
            class="btn btn-danger btn-sm">Delete
            Section</a>
        @endif
        <div class="container-fluid">
            <h5 style="font-weight: bold"><a href="{{ route('books.show',$book) }}">{{ $book->title }}</a>/ <a
                    href="#">{{ $section->title }}</a></h5>
            <h2>Section:{{ $section->title }}</h2>

            <p>Author:{{ $book->author->name }}</p>
            <article>
                {!! $section->content !!}
                <br>
                @if ($item->subsections->count() > 0)
                @php
                $topLevelSubsections = $section->subsections->where('parent_id', null);

                @endphp

                <ul style="">
                    <li style="">
                        @include('partials.subsection-full', ['subsections' => $topLevelSubsections])

                    </li>
                </ul>
                @endif
            </article>
        </div><!-- .container-fluid -->
    </div><!-- #page-content-wrapper -->
</main><!-- #page-wrapper -->
<script>
    /**
 * Support pages JS.
 *
 * @author Vee W.
 */


class SupportScript {


/**
 * Listen on click side bar toggler button.
 */
#listenClickSidebarToggler() {
    const targetBtnId = 'btn-toggle-sidebar';

    document.addEventListener('click', (event) => {
        let thisTarget = event.target;
        if (thisTarget.closest('button')) {
            thisTarget = thisTarget.closest('button');
        }

        if (thisTarget.getAttribute('id') === targetBtnId) {
            event.preventDefault();
            thisTarget.classList.toggle('active');
            document.getElementById('page-sidebar')?.classList.toggle('active');
        }
    });
}// #listenClickSidebarToggler


/**
 * Initialize the script.
 */
run() {
    this.#listenClickSidebarToggler();
}// run


}// SupportScript


document.addEventListener('DOMContentLoaded', () => {
const supportScriptObj = new SupportScript();
supportScriptObj.run();
});
</script>
@endsection