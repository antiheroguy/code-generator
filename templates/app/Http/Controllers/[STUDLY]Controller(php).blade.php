{!! '<' !!}?php

namespace App\Http\Controllers;

use App\Http\Requests\{{ $model['STUDLY'] }}Request;
use App\Http\Resources\{{ $model['STUDLY'] }}Resource;
use App\Models\{{ $model['STUDLY'] }};
use App\Services\{{ $model['STUDLY'] }}Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 *  @OA\Tag(
 *      name="{{ $model['STUDLY'] }}",
 *      description="{{ $model['STUDLY'] }} Resource",
 * )
 *
 *  @OA\Schema(
 *      schema="{{ $model['CAMEL'] }}",
@foreach($fields as $field => $item)
 *      @OA\Property(
 *          property="{{ $field }}",
 *          type="number",
 *          example=1,
 *      ),
@endforeach
 *  )
 */
class {{ $model['STUDLY'] }}Controller extends Controller
{
    /**
     * @var {{ $model['CAMEL'] }}Service
     */
    protected ${{ $model['CAMEL'] }}Service;

    public function __construct({{ $model['STUDLY'] }}Service ${{ $model['CAMEL'] }}Service)
    {
        $this->{{ $model['CAMEL'] }}Service = ${{ $model['CAMEL'] }}Service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     *  @OA\Get(
     *      path="/api/{{ $model['CAMEL'] }}",
     *      tags={"{{ $model['STUDLY'] }}"},
     *      operationId="index{{ $model['STUDLY'] }}",
     *      summary="List {{ $model['STUDLY'] }}",
     *      @OA\Response(
     *          response=200,
     *          description="Listed",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/{{ $model['CAMEL'] }}")
     *              ),
     *          ),
     *      ),
     *  )
     */
    public function index(Request $request)
    {
        ${{ $model['PLURAL_CAMEL'] }} = $this->{{ $model['CAMEL'] }}Service->index($request->all());

        return {{ $model['STUDLY'] }}Resource::collection(${{ $model['PLURAL_CAMEL'] }});
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\{{ $model['STUDLY'] }}Request $request
     * @return \Illuminate\Http\Response
     *
     * @param Request $request
     * @return Response
     *
     *  @OA\Post(
     *      path="/api/{{ $model['CAMEL'] }}",
     *      tags={"{{ $model['STUDLY'] }}"},
     *      operationId="store{{ $model['STUDLY'] }}",
     *      summary="Create {{ $model['STUDLY'] }}",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/{{ $model['CAMEL'] }}"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Created",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/{{ $model['CAMEL'] }}",
     *              ),
     *          ),
     *      ),
     *  )
     */
    public function store({{ $model['STUDLY'] }}Request $request)
    {
        ${{ $model['CAMEL'] }} = $this->{{ $model['CAMEL'] }}Service->create($request->all());

        return new {{ $model['STUDLY'] }}Resource(${{ $model['CAMEL'] }});
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\{{ $model['STUDLY'] }}  ${{ $model['CAMEL'] }}
     * @return \Illuminate\Http\Response
     *
     *  @OA\Get(
     *      path="/api/{{ $model['CAMEL'] }}/{id}",
     *      tags={"{{ $model['STUDLY'] }}"},
     *      operationId="show{{ $model['STUDLY'] }}",
     *      summary="Get {{ $model['STUDLY'] }}",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Getted",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/{{ $model['CAMEL'] }}",
     *              ),
     *          ),
     *      ),
     *  )
     */
    public function show({{ $model['STUDLY'] }} ${{ $model['CAMEL'] }})
    {
        return new {{ $model['STUDLY'] }}Resource(${{ $model['CAMEL'] }});
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\{{ $model['STUDLY'] }}Request $request
     * @param \App\Models\{{ $model['STUDLY'] }}  ${{ $model['CAMEL'] }}
     * @return \Illuminate\Http\Response
     *
     *  @OA\Put(
     *      path="/api/{{ $model['CAMEL'] }}/{id}",
     *      tags={"{{ $model['STUDLY'] }}"},
     *      operationId="update{{ $model['STUDLY'] }}",
     *      summary="Update {{ $model['STUDLY'] }}",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          ),
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/{{ $model['CAMEL'] }}"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Updated",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/{{ $model['CAMEL'] }}",
     *              ),
     *          ),
     *      ),
     *  )
     */
    public function update({{ $model['STUDLY'] }}Request $request, {{ $model['STUDLY'] }} ${{ $model['CAMEL'] }})
    {
        ${{ $model['CAMEL'] }}->update($request->all());

        return new {{ $model['STUDLY'] }}Resource(${{ $model['CAMEL'] }});
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\{{ $model['STUDLY'] }}  ${{ $model['CAMEL'] }}
     * @return \Illuminate\Http\Response
     *
     *  @OA\Delete(
     *      path="/api/{{ $model['CAMEL'] }}/{id}",
     *      tags={"{{ $model['STUDLY'] }}"},
     *      operationId="delete{{ $model['STUDLY'] }}",
     *      summary="Delete {{ $model['STUDLY'] }}",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer",
     *              format="int64",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Deleted",
     *      ),
     *  )
     */
    public function destroy({{ $model['STUDLY'] }} ${{ $model['CAMEL'] }})
    {
        ${{ $model['CAMEL'] }}->delete(${{ $model['CAMEL'] }});

        return response()->json(null, 204);
    }
}