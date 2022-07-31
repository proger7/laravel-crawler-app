<script src="{{ asset('js/app.js') }}" defer></script>
<div class="container">
    <div class="col-md-8 offset-md-2">
        <h1>{{isset($customer)?'Edit':'New'}} Filter</h1>
        <hr/>
        @if(isset($customer))
            {!! Form::model($customer,['method'=>'put','id'=>'frm', 'class' => 'js-configurations-update']) !!}
        @else
            {!! Form::open(['id'=>'frm', 'class' => 'js-configurations-update']) !!}
        @endif
        <div class="form-group row required">
            {!! Form::label("siteurl","Domain URL",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
            <div class="col-md-8">
                @php $siteurl = isset($customer) ? $customer->v_site_url : null @endphp
                {!! Form::text("siteurl",$siteurl,["class"=>"form-control".($errors->has('siteurl')?" is-invalid":""),"autofocus",'placeholder'=>'Enter domain URL']) !!}
                <span id="error-name" class="invalid-feedback"></span>
            </div>
        </div>
        <div class="form-group row required">
            {!! Form::label("contenttype","CSS Filter",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
            <div class="col-md-8">
                @php $contenttype = isset($customer) ? $customer->v_content_type : null @endphp
                {!! Form::text("contenttype",$contenttype,["class"=>"form-control".($errors->has('contenttype')?" is-invalid":""),'placeholder'=>'Enter css filter']) !!}
                <span id="error-email" class="invalid-feedback"></span>
            </div>
        </div>
        <div class="form-group row required">
            {!! Form::label("filterfunction","Filter Function",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
            <div class="col-md-8">
                {!! Form::select("filterfunction",$items,null,["class"=>"form-control"]) !!}
                <span id="error-email" class="invalid-feedback"></span>
            </div>
        </div>
        <div class="form-group row required">
            {!! Form::label("filtertype","Filter Type",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
            <div class="col-md-8">
                @php $filtertype = isset($customer) ? $customer->v_filter_type : null @endphp
                {!! Form::text("filtertype",$filtertype,["class"=>"form-control".($errors->has('filtertype')?" is-invalid":""),'placeholder'=>'Enter filter type']) !!}
                <span id="error-email" class="invalid-feedback"></span>
            </div>
        </div>
        <div class="form-group row required">
            {!! Form::label("itemUrl","Item's URL",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
            <div class="col-md-8">
                @php $itemUrl = isset($customer) ? $customer->v_url : null @endphp
                {!! Form::text("itemUrl",$itemUrl,["class"=>"form-control".($errors->has('itemUrl')?" is-invalid":""),'placeholder'=>'Enter item\'s URL']) !!}
                <span id="error-email" class="invalid-feedback"></span>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3 col-lg-2"></div>
            <div class="col-md-4">
                <a href="javascript:ajaxLoad('{{url('configurations')}}')" class="btn btn-danger">
                    Back</a>
                {!! Form::button("Save",["type" => "submit","class"=>"btn btn-primary"])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>