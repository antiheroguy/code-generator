{!! '<' !!}?php

namespace App\Services;

use App\Models\{{ $model['STUDLY'] }};
use ThomasDeLuck\CodeGenerator\Services\BaseService;

class {{ $model['STUDLY'] }}Service extends BaseService
{
    /**
     * @return {{ $model['STUDLY'] }}
     */
    public function getModel()
    {
        return {{ $model['STUDLY'] }}::class;
    }
}