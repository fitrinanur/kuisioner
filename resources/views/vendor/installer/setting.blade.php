@extends('vendor.installer.layouts.master')

@section('template_title')
    {{ trans('installer_messages.permissions.templateTitle') }}
@endsection

@section('title')
    <i class="fa fa-key fa-fw" aria-hidden="true"></i>
    {{ trans('installer_messages.setting.title') }}

@endsection

@section('container')

<form method="POST" action="{{ route('LaravelInstaller::setting') }}"  enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <input id="main_title" type="text" placeholder="Home Title" class="form-control{{ $errors->has('main_title') ? ' is-invalid' : '' }}" name="main_title" value="{{ old('main_title') }}" required autocomplete="Home Title" autofocus>

      </div>

        @if ($errors->has('main_title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('main_title') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group textareaCustom">
      <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
        </div>
        <textarea id="sort_desc" placeholder="Short description" class="form-control {{ $errors->has('sort_desc') ? ' is-invalid' : '' }}" name="sort_desc" value="{{ old('sort_desc') }}" ></textarea>
      </div>

        @if ($errors->has('sort_desc'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('sort_desc') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group file">
      <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
          Select Logo for Light theme
        </div>
        <input id="light_logo" type="file" placeholder="light_logo" class="form-control{{ $errors->has('light_logo') ? ' is-invalid' : '' }}" name="light_logo" value="{{ old('light_logo') }}" required autocomplete="light_logo" placeholder="Logo for light theme">
      </div>

        @if ($errors->has('light_logo'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('light_logo') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group file">
      <div class="input-group input-group-alternative mb-3">
        <div class="input-group-prepend">
          Select Logo for Dark theme
        </div>
        <input id="dark_logo" type="file" placeholder="dark_logo" class="form-control {{ $errors->has('dark_logo') ? ' is-invalid' : '' }}" name="dark_logo" value="{{ old('dark_logo') }}" required autocomplete="dark_logo" placeholder="Logo for light theme">
      </div>

        @if ($errors->has('dark_logo'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('dark_logo') }}</strong>
            </span>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label>Active Theme Style</label>
                <div class="checkboxWrap d-flex">
                    <div class="custom-control custom-radio mb-3 mr-4">
                        <input id="customRadio5" name="theme_style" value="2" type="radio" checked class="custom-control-input">
                        <label for="customRadio5" class="custom-control-label">Light</label>
                    </div>
                    <div class="custom-control custom-radio mb-3">
                        <input id="customRadio6" name="theme_style" value="1" type="radio" class="custom-control-input">
                        <label for="customRadio6" class="custom-control-label">Dark</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="buttons">
      <button class="button" type="submit">
        {{ trans('installer_messages.setting.next') }}
          <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
      </button>
    </div>

  </form>

@endsection
