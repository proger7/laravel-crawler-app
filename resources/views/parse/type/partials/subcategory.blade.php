<div class="col-md-8 offset-md-2">
    <h1>Parse Subcategories</h1>
    <hr/>

    {!! Form::open(['class'=>'js-subcategory-update']) !!}
    <div class="form-group row required">
        {!! Form::label("subcategory_url","Subcategory URL",["class"=>"col-form-label col-md-3 col-lg-3"]) !!}
        <div class="col-md-8">
            {!! Form::text("subcategory_url",null,["class"=>"form-control".($errors->has('subcategory_url')?" is-invalid":""),"autofocus",'placeholder'=>'Enter subcategory URL']) !!}
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