@auth
    <h4> Share yours ideas </h4>
    <div class="row">
        <form action="{{route('ideas.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <textarea name="content" class="form-control" id="content" rows="3"></textarea>
                @error('content')
                    <span class="d-block fs-6 text-danger mt-2">{{$message}}</span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-dark"> Share </button>
            </div>
        </form>
    </div>
@endauth
@guest
    {{-- <h4>Please login and share your ideas</h4> --}}
    {{-- only underline works, accessing lang function directory, filename : ideas, login_to_share is the rule, by default search lang en --}}
    {{-- <h4>{{__('ideas.login_to_share')}}</h4> --}}
    {{-- this done exactly the same as underline function --}}
    <h4>{{trans('ideas.login_to_share')}}</h4>
    {{-- lang function not working, this done exactly the same as underline function --}}
    {{-- <h4>{{lang('ideas.login_to_share')}}</h4> --}}
@endguest
