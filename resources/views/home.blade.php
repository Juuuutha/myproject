
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
                @if ($shortLinks != null)
                    <div class="ibox-content">
                        <div class="ibox-title">
                            <h1> Hello {{$shortLinks->name}}</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm dataTables">
                                <thead>
                                    <tr>
                                        <th ></th>
                                        <th>Short Url</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shortLinks->urls as $key => $row)
                                        <tr>
                                            <td class="text-center"style="width:10%" >{{$key+1}}</td>
                                            <td style="width:25%"><a href="{{ route('shorten.link', $row->short_url) }}" target="_blank">{{ route('shorten.link', $row->short_url) }}</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
    </div>
    <script  type="text/javascript">
        $('.dataTables').DataTable({
            pageLength: 25,
            responsive: true,
        });

    </script>
</body>
</html>

