<?php

namespace App\Traits;

trait HttpResponses
{
    protected function success($data, ?string $message = null, int $code = 200)
    {
        return response()->json(['data' => $data, 'message' => $message], $code);
    }

    protected function error($data, ?string $message, int $code)
    {
        return response()->json(['data' => $data, 'message' => $message], $code);
    }
}
