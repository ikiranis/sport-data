<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Tag;
use Illuminate\Http\Request;

class AdminTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Api call to store tag
     *
     * @param Request $request
     * @return TagResource|\Illuminate\Http\JsonResponse
     */
    public function storeTag(Request $request)
    {
        $input = $request->all();

        if(!$findTag = Tag::whereName($input['name'])->first()) {

            if ($tag = Tag::create($input)) {
                return new TagResource($tag);
            } else {
                return response()->json([
                    'message' => 'Cant create tag'
                ], 403);
            }

        } else {
            return new TagResource($findTag);
        }

    }
}
