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
                    Book
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
                            <th scope="col">Action</th>
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
                ajax: "{{ route('book.data') }}",
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
                    {data: 'action', name: 'action',searchable:false,orderable:false},
                ],order: [],
            });
    });
    $(document).on("click",".delete_book",function(){
        var dataUrl = $(this).attr("data-url");
        var confirmation = window.confirm("Are you sure you want to delete this book?");
        if (confirmation) {
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            url: dataUrl,
            type: "DELETE",
            dataType: 'json',
            success: function(data) {
                if(data.success){
                    $(document).find(".success_popup").after(`<div class="alert alert-success">${data.message}</div>`);
                    $('.data-table').DataTable().ajax.reload();
                }else{
                    $(document).find(".success_popup").append(`<div class="alert alert-danger">${data.message}</div>`);
                }
            },
            error: function(xhr) {
                alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText +' ' + xhr.responseText);
            },
        });
        }else{
            return false;
        }
    })
</script>