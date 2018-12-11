<?php

namespace App\Http\Controllers;

use App\Device;
use App\PayloadData;
use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //$this->middleware('auth:index');
    }

    public function index()
    {

        $posts = Post::orderBy('id', 'desc')->with('device', 'payload')->get();
        //posts is an array because you return an database querry
        return view('posts.index')->with(
            [
                'posts' => $posts
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(Request $request)
    {
        if ($request->app_id != ENV("TTN_APP_ID")) {
            return 'Not allowed with this app id';
        }

        $payloadFields = $request->payload_fields;
        $deviceId = $request->dev_id;
        $latitude = $request->payload_fields['latitude'];
        $longitude = $request->payload_fields['longitude'];
        $altitude = $request->payload_fields['altitude'];

        $device = Device::firstOrCreate(
            [
                'device_id' => $deviceId
            ]
        );

        $post = Post::create(
            [
                'latitude'  => $latitude,
                'longitude' => $longitude,
                'altitude'  => $altitude,
                'device_id' => $device->id,
            ]
        );

        foreach($payloadFields as $name => $field) {
            PayloadData::create([
                'post_id'       => $post->id,
                'field_name'    => $name,
                'field_value'   => $field
            ]);
        }

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('device', 'payload')->find($id);
        return view('posts.show')->with
        ([
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function apiPosts()
    {
        return Post::with('device', 'payload')->get();
    }
}
