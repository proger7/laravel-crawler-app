<div class="col-md-12">
    <hr/>
    {!! Form::open(['route' => 'category.download']) !!}
        {!! Form::button("<i class='fas fa-download'></i> Download Data in CSV",["type" => "submit","class"=>"btn btn-primary pull-left form-group", 'name' => 'submitbutton', 'value' => 'download'])!!}
    {!! Form::close() !!}
    {!! Form::open(['class' => 'js-category-refresh']) !!}
        {!! Form::button("<i class='fas fa-eraser'></i> Clear Data",["type" => "submit","class"=>"btn btn-danger pull-right form-group", 'name' => 'submitbutton', 'value' => 'clear'])!!}
    {!! Form::close() !!}
    <table class="table table-bordered bg-light">
        <thead class="bg-dark">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Category name</th>
            <th>Price</th>
            <th>Product URL</th>
        </tr>
        </thead>
        <tbody>

        @php
            $i=1;
        @endphp
        @foreach($a as $aa)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $aa['name'] }}</td>
                <td>{{ $aa['category_name'] }}</td>
                <td>{{ $aa['price'] }}</td>
                <td>{{ $aa['url'] }}</td>
            </tr>
        @endforeach
        
        </tbody>
    </table>
</div>

