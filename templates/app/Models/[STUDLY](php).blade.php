{!! '<' !!}?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class {{ $model['STUDLY'] }} extends Model
{
    protected $fillable = [
@foreach($fields as $field => $item)
        '{{ $field }}',
@endforeach
    ];
}