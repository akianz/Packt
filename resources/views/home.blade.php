@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="success_popup">
                </div>
                <div class="card-header">{{ __('Dashboard') }}</div>
            
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Book Lists
                    <hr>
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <table class="table data-table">
                        <thead>
                            <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Autor Name</th>
                            <th scope="col">Genre</th>
                            <th scope="col">Description</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">published Date</th>
                            <th scope="col">Puublisher name</th>
                            <th scope="col">Image</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    setTimeout(function() {
        $('.alert-success').hide(); // or use .fadeOut() for a smooth fade-out effect
    }, 5000);
    $(function () {
             $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('book_list') }}",
                method: "GET",
                columns: [
                    {data: 'title', name: 'title'},
                    {data: 'author_name', name: 'author_name'},
                    {data: 'genre', name: 'genre'},
                    {data: 'description', name: 'description'},
                    {data: 'isbn', name: 'isbn'},
                    {data: 'published', name: 'published'},
                    {data: 'publisher_name', name: 'publisher_name'},
                    {data: 'image', name: 'image',searchable:false,orderable:false},
                ],order: [],
            });
    });
</script>
