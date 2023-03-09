<?php

namespace App\Http\Repositories;

use App\Models\Photo;

class PhotoRepository
{
    public function getAllPhotos()
    {
        return Photo::orderBy("id", "desc")->get();
    }

    public function insertPhotoRow($data)
    {
        return Photo::create($data);
    }

    public function updatePhotoRow($photo, $data)
    {
        $photo->title = $data["title"];
        $photo->photo = $data["photo"];
        $photo->categoryId = $data["categoryId"];
        $photo->userId = $data["userId"];
        $photo->save();
        return $photo;
    }

    public function getPhotoById($id)
    {
        return Photo::find($id);
    }

    public function deletePhotoRow($photo)
    {
        return $photo->delete();
    }
}
