<?php

namespace App\Http\Controllers;

use App\Gallary;
use App\Photo;
use Auth;
use DB;
use Illuminate\Http\Request;

class GallaryController extends Controller
{
    public function gallaryCreate()
    {
        return view('gallaries.create');
    }

    public function gallaryStore(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'cover' => 'required',
            'description' => 'required',
        ]);

        $gallary = new Gallary;
        // Put Tilte And description into Database
        $gallary->title = $request->title;
        $gallary->description = $request->description;
        $gallary->user_id = Auth::user()->id;

        // Our cover image
        $cover = $request->file('cover');
        // Get our Cover extention
        $cover_ext = $cover->getClientOriginalExtension();
        // Rename our cover
        $cover_name = rand(123456, 999999) . '.' . $cover_ext;
        // Declare our cover path
        $cover_path = public_path('gallaries/');
        // Move our file into the gallaries folder
        $cover->move($cover_path, $cover_name);
        $gallary->cover = $cover_name;
        // Save all the database into database
        $gallary->save();

        return redirect()->route('home');
    }

    public function gallaryShow($id)
    {
        $gallary = Gallary::find($id);
        $photos = Photo::where('gallary_id', $gallary->id)->get();
        return view('gallaries.show', compact('gallary', 'photos'));
    }

    public function gallaryEdit($id)
    {
        $gallary = Gallary::find($id);
        return view('gallaries.edit', compact('gallary'));
    }

    public function gallaryUpdate(Request $request, $id)
    {
        $gallary = Gallary::find($id);

        $gallary->title = $request->title;
        $gallary->description = $request->description;

        // Update Cover Nd delete from Path and renew Pic
        $gallary_cover = $gallary->cover;
        if ($request->hasFile('cover')) {
            unlink(public_path('gallaries/' . $gallary_cover));
            $cover = $request->file('cover');
            $cover_ext = $cover->getClientOriginalExtension();
            $cover_name = rand(123456, 999999) . '.' . $cover_ext;
            $cover_path = public_path('gallaries/');
            $cover->move($cover_path, $cover_name);
            $gallary->cover = $cover_name;
        } else {
            $gallary_cover = $request->old_cover;
        }
        $gallary->save();
        return redirect()->route('gallaryShow', $id);
    }

    public function gallaryDelete($id)
    {
        $photos = Photo::where('gallary_id', $id)->get();
        foreach ($photos as $photo) {
            $photo_name = $photo->photo;
            unlink(public_path('gallaries/photos/' . $photo_name));
        }

        DB::table('photos')->where('gallary_id', $id)->delete();

        $gallary = Gallary::find($id);
        $gallary_cover = $gallary->cover;
        unlink(public_path('gallaries/' . $gallary_cover));
        $gallary->delete();
        toast('Gallary deleted successfully!', 'success')->timerProgressBar();
        // return redirect()->route('home');
    }

    public function photoCreate($id)
    {
        $gallary = Gallary::find($id);
        return view('gallaries.photos.create', compact('gallary'));
    }

    public function photoStore(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'photo' => 'required',
            'description' => 'required',
        ]);

        $photos = new Photo;
        $gallary_id = $request->gallary_id;

        $photos->title = $request->title;
        $photos->description = $request->description;
        $photos->gallary_id = $gallary_id;

        $photo = $request->file('photo');
        $photo_ext = $photo->getClientOriginalExtension();
        $photo_name = rand(123456, 999999) . '.' . $photo_ext;
        $photo_path = public_path('gallaries/photos/');
        $photo->move($photo_path, $photo_name);
        $photos->photo = $photo_name;

        $photos->save();

        return redirect()->route('gallaryShow', $gallary_id);
    }

    public function photoShow($id)
    {
        $photo = photo::find($id);
        return view('gallaries.photos.show', compact('photo'));
    }

    public function photoEdit($id)
    {
        $photo = photo::find($id);
        return view('gallaries.photos.edit', compact('photo'));
    }

    public function photoUpdate(Request $request, $id)
    {
        $photo = Photo::find($id);

        $photo->title = $request->title;
        $photo->description = $request->description;

        // Update Cover Nd delete from Path and renew Pic
        $photo_name = $photo->photo;
        if ($request->hasFile('photo')) {
            unlink(public_path('gallaries/photos/' . $photo_name));

            $new_photo = $request->file('photo');
            $new_photo_ext = $new_photo->getClientOriginalExtension();
            $new_photo_name = rand(123456, 999999) . '.' . $new_photo_ext;
            $new_photo_path = public_path('gallaries/photos/');
            $new_photo->move($new_photo_path, $new_photo_name);

            $photo->photo = $new_photo_name;
        } else {
            $photo->photo = $request->old_photo;
        }
        $photo->save();
        return redirect()->route('photoShow', $id);
    }

    public function photoDelete($id)
    {
        $photo = Photo::find($id);
        $photo_name = $photo->photo;
        $gallary_id = $photo->gallary_id;
        unlink(public_path('gallaries/photos/' . $photo_name));
        $photo->delete();
        // return redirect()->route('gallaryShow', $gallary_id);
        toast('Photo deleted successfully!', 'success')->timerProgressBar();
    }
}
