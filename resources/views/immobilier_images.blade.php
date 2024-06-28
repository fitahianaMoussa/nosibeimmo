@foreach($images as $image)
    <img src="{{ asset($image->image_path) }}" style="max-width: 100px; max-height: 100px; margin-right: 10px;" />
@endforeach