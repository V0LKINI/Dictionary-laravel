<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    use UploadTrait;

    public function add(Request $request)
    {
        $news = News::create([
            'title' => $request->title,
            'code' => $request->code,
            'description' => $request->description,
        ]);


        if ($request->has('image')) {
            $image = $request->file('image');
            $name = $news->id;
            $folder = '/news/';
            $filePath = '/storage'.$folder.$name.'.'.$image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $news->image = $filePath;
        }

        $news->save();
//        session()->flash('success', 'Настройки профиля сохранены');

        return redirect()->route('admin');
    }

}
