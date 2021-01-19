<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller
{

    public function upload(Request $request)
    {

        $urls = [];

        $disk = Storage::disk(config('admin.upload.disk'));


        foreach ($request->file() as $file) {
            $urls[] = $disk->url($disk->put('images', $file));
        }

        return [
            "errno" => 0,
            "data"  => $urls,
        ];
    }
}
