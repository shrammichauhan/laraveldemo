@extends('layouts.app')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Category Management</h2></div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('storeCategory') }}">
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('category_name') ? ' has-error' : '' }}">
                            <label for="category_name" class="col-md-4 control-label">Category Name</label>

                            <div class="col-md-5">
                                <input id="category_name" type="category_name" class="form-control" name="category_name" value="{{ old('category_name') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#subCategoryModal">
                                Add Sub Category
                            </a>
                        </div>

                        <div class="form-group{{ $errors->has('category_image') ? ' has-error' : '' }}">
                            <label for="category_image" class="col-md-4 control-label">Image </label>

                            <div class="col-md-5">
                                <input id="category_image" type="file" class="form-control" name="category_image" required>
                                <img src="#" id="category_image_tag" width="200px" onchange="readURL(this);" alt="image">

                                @if ($errors->has('category_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                                <a class="btn btn-default" href="{{ route('home') }}">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="modal fade" id="subCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Add Sub-Category</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group{{ $errors->has('parent_category') ? ' has-error' : '' }}">
                                        <label for="parent_category" class="col-md-4 control-label">Category Name</label>

                                        <div class="col-md-5">
                                            <select id="parent_category" class="form-control" name="parent_category" value="{{ old('parent_category') }}" required autofocus>
                                                <option value=""> Select Category Name </option>
                                                @foreach ($data as $key => $value)
                                                    <option value="{{$value['id']}}"> {{$value['category_name']}} </option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('parent_category') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group{{ $errors->has('sub_category_name') ? ' has-error' : '' }}">
                                        <label for="sub_category_name" class="col-md-4 control-label">Sub-Category Name</label>

                                        <div class="col-md-5">
                                            <input id="sub_category_name" class="form-control" name="sub_category_name" value="{{ old('sub_category_name') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('sub_category_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: 30px;">
                                    <button type="button" class="btn btn-primary" id="save" >Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



<script>
    $( document ).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('#category_image_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#category_image").change(function(){
            readURL(this);
        });
        
        $('#save').click(function() {
            // console.log('i m here');
            // alert('msbdjds');
            var parentCategory = $('#parent_category option:selected').val();
            var subCategory = $('#sub_category_name').val();
            var token = $('#_token').val();
            alert(subCategory);

            $.ajax({
                url:"{{ route('addSubCategory') }}",
                data : {'parentCategory':parentCategory, 'subCategory':subCategory, '_token':token},
                type: "POST",
                cache:false,
                clearForm: false,
                success:function(response) {
                    window.location.reload();
                }
            });
        });
    });
</script>
