{{ Breadcrumbs::render('configurations') }}

<div class="container">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops! Something went wrong!</strong>
            <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="input-group-btn form-group d-flex justify-content-between">
        <div class="float-right">
            <a href="javascript:ajaxLoad('{{ url('configurations/create') }}')" class="btn btn-primary">
                <i class="fas fa-plus"></i>&nbsp; New
            </a>
        </div>

        <form action="/configurations/search" method="POST" class="js-search-update form-inline ml-auto">
            @csrf
            <div class="md-form my-0">
                <input class="form-control" name="search" type="search" id="search"/>
                <button type="submit" id="search_btn" class="btn btn-outline-white btn-md my-0 ml-sm-2">Search</button>
            </div>
        </form>
    </div>
    <hr/>

    <div class="input-group-btn form-group d-flex justify-content-between">
        <button class="btn btn-danger delete-all" data-url="">
            <i class="fas fa-trash"></i>&nbsp; Delete All
        </button>
        <a href="{{ route('home') }}" type="submit" class="btn btn-primary" id="go-home">
            <i class="fas fa-forward"></i>&nbsp; Prev
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered bg-light">
            <thead class="bg-primary">
                <tr>
                    <th scope="col" width="60px">
                        <input type="checkbox" id="check_all">
                        <label for="check_all"></label>
                    </th>
                    <th scope="col">@sortablelink('v_site_url', 'Domain URL')</th>
                    <th scope="col">@sortablelink('v_content_type', 'CSS Filter')</th>
                    <th scope="col">@sortablelink('v_function', 'Filter Function')</th>
                    <th scope="col" width="130px">Action</th>
                </tr>
            </thead>
            <tbody>
            @if($customers->count() > 0)
                @forelse($customers as $customer)
                    <tr id="info{{$customer->id}}">
                        <td scope="row" width="60px">
                            <input type="checkbox" id="master_{{$customer->id}}" class="checkbox" data-id="{{$customer->id}}">
                            <label for="master_{{$customer->id}}"></label>
                        </td>
                        <td>{{ $customer->v_site_url }}</td>
                        <td>{{ $customer->v_content_type }}</td>
                        <td>{{ $customer->v_function }}</td>
                        <td align="center">
                            <a class="btn btn-primary btn-sm vcenter" title="Edit"
                               href="javascript:ajaxLoad('{{url('configurations/update/'.$customer->id)}}')">
                                <i class="fa fa-edit"></i></a>   
                            <button class="btn btn-danger btn-sm vcenter deleteRecord" data-id="{{ $customer->id }}" ><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @empty
                    <p>No items found!</p>
                @endforelse
            @endif
            </tbody>
        </table>
    </div>

    @if($customers)
        <div class="text-right form-group"><b>Total amount:</b> <span id="total">{{ $customers->total() }}</span> items</div>
        <nav>
            <ul class="pagination justify-content-end">
                {!! $customers->appends(\Request::except('page'))->render() !!}       
            </ul>
        </nav>
    @endif
</div>

<div id="DeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog ">
         <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <p class="text-center">Are You Sure Want To Delete ?</p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="{{ asset('js/notify.js') }}"></script>

<script type="text/javascript">
$(document).ready(function () {
    $('#check_all').on('click', function(e) {
     if($(this).is(':checked',true))  
     {
        $(".checkbox").prop('checked', true);  
     } else {  
        $(".checkbox").prop('checked',false);  
     }  
    });
     $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#check_all').prop('checked',true);
        }else{
            $('#check_all').prop('checked',false);
        }
     });
    $('.delete-all').on('click', function(e) {
        var idsArr = [];  
        $(".checkbox:checked").each(function() {  
            idsArr.push($(this).attr('data-id'));
        });  
        if(idsArr.length <=0)  
        {  
            alert("Please select at least one record to delete.");  
        }  else {  
            if(confirm("Are you sure, you want to delete the selected configurations?")){  
                var strIds = idsArr.join(","); 
                $.ajax({
                    url: "{{ route('delete.all') }}",
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'ids='+strIds,
                    beforeSend: function() {
                        $('.loading').show();
                    },
                    complete: function() {
                        $('.loading').hide();
                    },
                    success: function (data) {
                        if (data['status']==true) {
                            $(".checkbox:checked").each(function() {  
                                $(this).parents("tr").remove();
                            });
                            alert(data['message']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
            }  
        }  
    });

    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        onConfirm: function (event, element) {
            element.closest('form').submit();
        }
    });   
});

$(".deleteRecord").click(function() {
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
    if(confirm("Are you sure, you want to delete the selected configuration?")) {
        $.ajax({
            url: '/configurations/delete/' + id,
            type: 'DELETE',
            data: {
                "id": id,
                "_token": token,
            },
            beforeSend: function() {
                $('.loading').show();
            },
            complete: function() {
                $('.loading').hide();
            },
            success: function (data){
                alert(data['success']);
                $("#info" + id).remove();
            },
            error: function (data) {
                alert(data.responseText);
            }
        });
    }
});
</script>
