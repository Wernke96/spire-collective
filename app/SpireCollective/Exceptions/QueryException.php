<?php


namespace App\SpireCollective\Exceptions;

use Illuminate\Http\Response;

class QueryException extends \Exception
{
    public function render($request)
    {
        return response()->json(["error" => $this->message ],Response::HTTP_CONFLICT);
    }
}
