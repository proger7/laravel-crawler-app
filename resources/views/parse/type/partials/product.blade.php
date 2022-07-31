<div class="col-md-8 offset-md-2">
    <h1>Parse Products</h1>
    <hr/>

    {!! Form::open(['class'=>'js-product-update']) !!}
    <div class="form-group row required">
        {!! Form::label("product_from","From",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
        <div class="col-md-8">
            {!! Form::text("product_from",null,["class"=>"form-control".($errors->has('product_from')?" is-invalid":""),"autofocus",'placeholder'=>'Enter from']) !!}
            <span id="error-name" class="invalid-feedback"></span>
        </div>
    </div>
    <div class="form-group row required">
        {!! Form::label("product_count","Count",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
        <div class="col-md-8">
            {!! Form::text("product_count",null,["class"=>"form-control".($errors->has('product_count')?" is-invalid":""),"autofocus",'placeholder'=>'Enter count']) !!}
            <span id="error-name" class="invalid-feedback"></span>
        </div>
    </div>
    <div class="form-group row required">
        {!! Form::label("product_url","Product URL",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
        <div class="col-md-8">
            {!! Form::text("product_url",null,["class"=>"form-control".($errors->has('product_url')?" is-invalid":""),"autofocus",'placeholder'=>'Enter product URL']) !!}
            <span id="error-name" class="invalid-feedback"></span>
        </div>
    </div>
    <div class="form-group row required">
        {!! Form::label("category_type","Category type",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
        <div class="col-md-8">
            {!! Form::text("category_type",null,["class"=>"form-control".($errors->has('category_type')?" is-invalid":""),"autofocus",'placeholder'=>'Enter category type']) !!}
            <span id="error-name" class="invalid-feedback"></span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-3 col-lg-2"></div>
        @if(env('GOOGLE_RECAPTCHA_KEY'))
             <div class="g-recaptcha"
                  data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}">
             </div>
        @endif
        <div class="col-md-4">
            <a href="{{ url('/parse') }}" class="btn btn-danger">
                <i class="fas fa-backward"></i>&nbsp; Back
            </a>
            {!! Form::button("<i class='fas fa-play'></i>&nbsp; Parse",["type" => "submit","class"=>"btn
        btn-primary"])!!}
        </div>
    </div>
    {!! Form::close() !!}
</div>