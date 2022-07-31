<tbody>
    
    @php
        $i=1;
    @endphp

        @forelse($customers as $customer)
            <tr>
                <td><input type="checkbox" class="sub_chk" data-id="{{$customer->id}}"></td>
                <td>{{ $customer->v_site_url }}</td>
                <td>{{ $customer->v_content_type }}</td>
                <td>{{ $customer->v_function }}</td>
                <td align="center">
                    <a class="btn btn-primary btn-sm vcenter" title="Edit"
                       href="javascript:ajaxLoad('{{url('configurations/update/'.$customer->id)}}')">
                        <i class="fa fa-edit"></i></a>   
                    <input type="hidden" name="_method" value="delete"/>
                    <a href="javascript:;" data-toggle="modal" onclick="deleteData('{{$customer->id}}')" data-target="#DeleteModal" class="btn btn-sm btn-danger vcenter"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @empty
            <p>No data found!</p>
        @endforelse

</tbody>