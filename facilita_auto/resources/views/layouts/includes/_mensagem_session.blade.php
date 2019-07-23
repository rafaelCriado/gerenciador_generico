@if(Session::has('mensagem'))
        <div class="alert alert-{{ Session::get('mensagem')['class']}} fade in alert-dismissible show m-1" role="alert" id="msgAlert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button>
            {{Session::get('mensagem')['msg']}}
        </div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger fade in alert-dismissible show m-1" role="alert" id="msgAlert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button>
            {{ $error }}
        </div>
    @endforeach 
@endif