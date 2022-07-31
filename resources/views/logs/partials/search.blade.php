<tbody>

    @php
        $i=1;
    @endphp

        @forelse($customers as $customer)
            <tr>
                <td><input type="checkbox" class="sub_chk" data-id="{{$customer->id}}"></td>
                <td>{{ $customer->v_status }}</td>
                <td>{{ $customer->n_parsed_qua }}</td>
                <td>{{ $customer->v_url }}</td>
                <td>{{ $customer->v_command }}</td>
                <td align="center">
                    <input type="hidden" name="_method" value="delete"/>

                    <a href="javascript:;" data-toggle="modal" onclick="deleteData('{{$customer->id}}')" data-target="#DeleteModal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>

                </td>
            </tr>
        @empty
            <p>No data found!</p>
        @endforelse

</tbody>
 