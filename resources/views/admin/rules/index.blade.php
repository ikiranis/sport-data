@extends('layouts.admin')

@section('content')
    <h1>{{trans_choice('messages.rules',2)}}</h1>

    <div class="col-lg-6 col-12 ml-auto mr-auto my-2">
        <a href="{{route('rules.create')}}">
            <button class="btn btn-info w-100">{{__('messages.insert rule')}}</button>
        </a>
    </div>

    @if(count($rules)>0)
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{trans_choice('messages.rules',1)}}</th>
                <th scope="col">{{__('messages.action')}}</th>
            </tr>
            </thead>
            <tbody>

            @foreach($rules as $rule)
                <tr>
                    <th scope="row">{{$rule->id}}</th>
                    <td><a href="{{route('rules.edit', $rule->id)}}">{{$rule->name}}</a></td>
                    <td>
                        <form method="POST" action="{{route('rules.destroy', $rule->id)}}">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf

                            <button type="submit" class="btn btn-danger">
                                {{__('messages.delete')}}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

        <div class="row">
            <div class="ml-auto mr-auto">
                {{ $rules->links() }}
            </div>
        </div>


    @else
        <h1>{{__('messages.rules not exist')}}</h1>
    @endif
@endsection
