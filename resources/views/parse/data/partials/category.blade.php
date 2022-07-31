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
                <th>Site URL</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i=1;
        @endphp
        
        @foreach($categories as $category)  
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $category['name'] }}</td>
                <td>{{ $category['v_site_url'] }}</td>
                <td>{{ $category['link'] }}</td>
            </tr>
        @endforeach
        
        </tbody>
    </table>
</div>


