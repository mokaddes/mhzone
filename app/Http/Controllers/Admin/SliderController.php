<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\User;
use App\Traits\UploadAble;
use Illuminate\Http\Request;


class SliderController extends Controller
{
    use UploadAble;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::with('user')->get();

        return view('admin.settings.pages.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellers = User::all();
        return view('admin.settings.pages.slider.create', compact('sellers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            // 'seller'=>'required',
            'title' => 'required',
            'body' => 'required',
            'image' => 'required',
        ]);


        $slider = new Slider();
        if ($request->hasFile('image')) {
            $slider->path = uploadImage($request->image, 'slider');
        }
        $slider->seller_id = 0;
        $slider->content_title = $request->title;
        $slider->content_body = $request->body;
        $slider->status = true;
        $slider->save();

        $slider_title = $request->title;
        $slider_body = $request->body;
        // translations
        $data = file_get_contents(base_path('resources/lang/en.json'));
        $translations = json_decode($data, true);
        foreach ($translations as $key => $value) {
            if ($key == $slider_title) {
                //update
                $translations[$key] = $request->title;
            } else {
                //add
                $translations[$slider_title] = $request->title;
            }

            if($key == $slider_body) {

                $translations[$key] = $request->body;

            }else {

                $translations[$slider_body] = $request->body;

            }

        }

        file_put_contents(base_path('resources/lang/en.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));

        return redirect()->route('slider.index')->with('success', 'Slider Save successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $sellers = User::all();
        return view('admin.settings.pages.slider.edit', compact('sellers', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            // 'seller'=>'required',
            'title' => 'required',
            'body' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $slider->path = uploadImage($request->image, 'slider');
        } else {
            $slider->path = $slider->path;
        }

        // $slider->seller_id=$request->seller;
        $slider->content_title = $request->title;
        $slider->content_body = $request->body;
        $slider->status = true;
        $slider->save();

        $slider_title = $request->title;
        $slider_body = $request->body;
        // translations
        $data = file_get_contents(base_path('resources/lang/en.json'));
        $translations = json_decode($data, true);
        foreach ($translations as $key => $value) {
            if ($key == $slider_title) {
                //update
                $translations[$key] = $request->title;
            } else {
                //add
                $translations[$slider_title] = $request->title;
            }

            if($key == $slider_body) {

                $translations[$key] = $request->body;

            }else {

                $translations[$slider_body] = $request->body;

            }

        }

        file_put_contents(base_path('resources/lang/en.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));


        return redirect()->route('slider.index')->with('success', 'Slider Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Slider delete successfully!');
    }

    public function updateStatus(Request $request)
    {
        $slider = Slider::find($request->id);

        if ($slider->status == 1) {
            $slider->status = 0;
            $slider->update();

            return response()->json(['message' => 'Slider Inactivated Successfully']);
        } else {

            $slider->status = 1;
            $slider->update();
            return response()->json(['message' => 'Slider Activated Successfully']);
        }
    }
}
