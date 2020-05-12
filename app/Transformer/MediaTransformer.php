<?php
namespace App\Transformer;

use Spatie\MediaLibrary\Models\Media;
use League\Fractal\TransformerAbstract;

class MediaTransformer extends TransformerAbstract
{
    public function transform(Media $media)
    {
      
      return [
            'name' => $media->name,
            'collection_name' => $media->collection_name,
            'file_name' => $media->file_name,
            'mime_type' => $media->mime_type,
            'size' => $media->size,
            'url' => $media->getFullUrl()
        ];
    }
}