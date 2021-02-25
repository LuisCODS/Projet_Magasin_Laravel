<!-- <main class="container">
<div class="nav-scroller py-1 mb-2">
<nav class="nav d-flex justify-content-between">
<form action="{{ route('list-all') }}" method="GET">
    @csrf
        {{-- <input type="text" name="search" id="search" class="form-control"> --}}
        <a class="p-2 text-muted" href="{{ route('create-categorie') }}"><b>Home</b></a>
        <a class="p-2 text-muted" href="#"><b>Femme</b></a>
        <a class="p-2 text-muted" href="#"><b>Garçon</b></a>
        <a class="p-2 text-muted" href="#"><b>Fille</b></a>
</form>
</nav>
</div>
</main> -->

    <main class="container">
        <div class="nav-scroller py-1 mb-1">
            <nav class="nav d-flex justify-content-center">
                <form action="{{ route('list-all') }}" method="GET">
                    @csrf
                    {{-- <input type="text" name="search" id="search" class="form-control"> --}}
                    <a class="p-2 text-muted"
                        href="{{ route('create-categorie') }}"><b>Home</b></a>
                    <a class="p-2 text-muted" href="#"><b>Femme</b></a>
                    <a class="p-2 text-muted" href="#"><b>Garçon</b></a>
                    <a class="p-2 text-muted" href="#"><b>Fille</b></a>
                </form>
            </nav>
        </div>
    </main> 
