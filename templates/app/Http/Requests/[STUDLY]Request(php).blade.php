{!! '<' !!}?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {{ $model['STUDLY'] }}Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
@foreach($fields as $field => $item)
            '{{ $field }}' => 'required',
@endforeach
        ];
    }
}