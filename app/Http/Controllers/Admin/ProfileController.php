<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

use App\Profhistory;
use Carbon\Carbon;


class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
        
    }
    
    public function create(Request $request)
    {
      $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();
      
      
      unset($form['_token']);
     
        // データベースに保存する
        $profile->fill($form);
        $profile->save();
      
      return redirect('admin/profile/');
    
    }
    
    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)){
            abort(404);
        }
        return view('admin.profile.edit',['profile_form'=> $profile]);
    }
    
    public function update(Request $request)
    {
        $this->validate($request,Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        unset($profile_form['_token']);
        $profile->fill($profile_form)->save();
        
        $profhistory = new Profhistory;
        $profhistory->profile_id = $profile->id;
        $profhistory->edited_at = Carbon::now();
        $profhistory->save();
        
        
        
        return redirect('admin/profile/edit');
        
    }
    
     public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $profiles = Profile::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $profiles = Profile::all();
      }
      return view('admin.profile.index', ['profiles' => $profiles, 'cond_title' => $cond_title]);
  }
    
    
    
    
}
