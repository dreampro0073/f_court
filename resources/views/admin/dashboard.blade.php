@extends('admin.layout')

@section('main')

<div class="main">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h3 text-gray-800">Dashboard</h1>
        </div>
        @if(Auth::user()->privilege == 1)
        <div class="col-md-6 text-right">
            <a href="javascript:;" class="btn btn-primary" id="addTask">Add Message</a>
        </div>
        @endif
    </div>	
    @if(isset($show_message) && Auth::user()->privilege == 2)
    <div class="mb-4">
        <div class="alert alert-success" role="alert">
            {{$show_message->message}}
        </div>
    </div>
    @endif
   	<div class="row">
        @foreach($data as $item)
   		<div class="col-md-3">
            <a class="no-dec" href="{{$item['url']}}">
                <div class="card p-3 shadow mb-4" style="background:#ffff33;">
                    <p style="font-size: 30px;">{{$item['count']}} <span style="font-size:12px;">Under Process</span></p>
                    <p>
                        {{$item['label']}}
                    </p>
                </div>
            </a>	
   		</div>
        @endforeach
   	
   	</div>
</div>

<div class="modal" id="messageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="message-form"> 
                    <div class="form-group">
                        <label>Message</label>
                        <input type="text" name="message" id="message" class="form-control">
                        
                    </div>
                    <div class="mt-3">
                        
                    </div>
                    <button type="submit" id="sub-btn" class="btn btn-primary">Submit</button>
                </form>
            </div>
        
        </div>
    </div>
</div>
@endsection