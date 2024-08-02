
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.app')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.4/sweetalert2.min.css">
    <script src="assets/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.4/sweetalert2.min.js" integrity="sha512-w4LAuDSf1hC+8OvGX+CKTcXpW4rQdfmdD8prHuprvKv3MPhXH9LonXX9N2y1WEl2u3ZuUSumlNYHOlxkS/XEHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
    <div class="col-lg-12">
            <div class="ibox float-e-margins center">
                <div class="ibox-content">
                    <div class="card">
                        <div class="card-header">URL</div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="card-body">
                                    <form method="POST" action="{{ route('url-store') }}">
                                        @csrf
                                        <div class="row col-md-2-8-2 ">
                                            <label class="col-md-3 col-form-label text-md-end">Url</label>
                                                <div class="col-md-6">
                                                    <input id="original_url" type="text" class="form-control " name="original_url" required >
                                                </div>
                                                <div class="col-md-3">
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
                <hr>
                <div class="ibox-title">
                    <h1> ข้อมูลลูกค้า</h1>
                </div>
                    <div class="card col-2 pull-right">
                        <div class="card-body">
                            <div class="card-header">จำนวนลูกค้า</div>
                        <h2 ><i class="fa fa-user "></i>&nbsp;{{$user}} คน</h2>
                        </div>
                    </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm dataTables">
                            <thead>
                                <tr>
                                    <th >user</th>
                                    <th>Short Url</th>
                                    <th>Original Url</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($shortLinks) > 0)
                                    @foreach($shortLinks as $key => $row)
                                        <tr>
                                            <td style="width:20%" >{{ $row->user->name }}</td>
                                            <td style="width:25%"><a href="{{ route('shorten.link', $row->short_url) }}" target="_blank">{{ route('shorten.link', $row->short_url) }}</a></td>
                                            <td style="width:45%"><a href="{{$row->original_url}}" target="_blank">{{$row->original_url}}</a></td>
                                            <td class="text-center" style="width:20%"><button type="button" class="btn btn-danger" id="deleteBt" onclick="btn('{{$row->id}}')" ><i class=" fa fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning" id="updateBtn" onclick="updateBtn('{{$row->id}}')" ><i class=" fa fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>

<div class="modal inmodal fade" id="modal-show" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Url</h4>
            </div>

            <form action="{{ route('url.editUrl') }}" id="formSubmitEditUrl" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row" id="show-url">

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary "> Save </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script  type="text/javascript">
        $('.dataTables').DataTable({
            pageLength: 25,
            responsive: true,
        });

        function updateBtn(url_id){
            $('#show-url').append(`
            <input id="original_url" type="text" class="form-control " name="original_url" placeholder="url" required>
                <input type="hidden" name="url_id" id="url_id" value="${url_id}">
            `);
            $('#modal-show').modal('show');
        }

        function btn(url_id){
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want be delete this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                                    type: 'post',
                                    url: "{{ route('url.deleteUrl') }}",
                                    data: {
                                        '_token': "{{ csrf_token() }}",
                                        'url_id': url_id
                                    },
                                    success: function(data) {
                                        if(data == 'success') {
                                            Swal.fire({
                                            title: "Deleted!",
                                            text: "Your url has been deleted.",
                                            icon: "success"
                                            });
                                            setTimeout(function() {
                                            window.location.reload();
                                        }, 1000);
                                        }else{
                                            swal("Your url hasn't been delete.", "", "error");
                                        }
                                    }
                                });
                    }
                });
        }


    </script>
</body>
</html>

