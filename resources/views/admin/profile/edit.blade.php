<!DOCTYPE html>
<html>
    <head>
        <meta charset=”utf-8”>
        <meta http-equiv="X-UA-Compatible" contet="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Mynews</title>
    </head>
    <body>
        <h1>Myプロフィール編集画面</h1>
        
          @extends('layouts.admin')
          @section('title', 'Myプロフィール編集')
          @section('content')
         <div class="container">
           <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Myプロフィール編集</h2>
                <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="name" >氏名</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name" value="{{ old('name',$profile_form->name) }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="gender" >性別</label>
                        <div class="col-md-4">
                            <input type="radio"  name="gender" value="{{ old('gender',$profile_form->gender) }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="hobby">趣味</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ old('hobby',$profile_form->hobby) }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="introduction" >自己紹介</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ old('intorduction', $profile_form->introduction) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-10">
                             <input type="hidden" name="id" value="{{ $profile_form->id }}">
                             {{ csrf_field() }}
                             <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                    
                </form>
                
                <div class="row mt-5">
                    <div class="col-md-4 mx-auto">
                        <h2>編集履歴</h2>
                        <ul class="list-group">
                            @if ($profile_form->profhistories != NULL)
                                @foreach ($profile_form->profhistories as $profhistory)
                                    <li class="list-group-item">{{ $profhistory->edited_at }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
    
            </div>
           </div>
         </div>
         @endsection
        
        
    </body>
</html>
