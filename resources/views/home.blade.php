@extends('layouts.app')

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

                    <table class="table table-striped table-hover table-bordered" >
                        <thead>
                            <tr>
                                <th>
                                    <a href="addCategory"> Create Category </a>                                    
                                </th>
                            </tr>
                            <tr>
                                <th> 
                                    <a href="listCategory"> List Category </a>
                                </th>

                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
