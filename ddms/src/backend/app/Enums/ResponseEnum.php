<?php

namespace App\Enums;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

enum ResponseEnum: string
{
    case NotFound = 'not-found';
    case Unauthorized = 'unauthorized';
    case Forbidden = 'forbidden';
    case Success = 'success';
    case Created = 'created';
    case Fatal = 'fatal-error';

    public function getCode(): int
    {
        return match ($this){
            self::NotFound => 404,
            self::Unauthorized => 401,
            self::Forbidden => 403,
            self::Success => 200,
            self::Created => 201,
            self::Fatal => 500,
        };
    }

    public function getLabel(): string
    {
        return match ($this){
            self::NotFound => 'Not Found',
            self::Unauthorized => 'Unauthorized',
            self::Forbidden => 'Forbidden',
            self::Success => 'Success',
            self::Created => 'Created',
            self::Fatal => 'Fatal Error',
        };
    }

    public function build(null|array|string|Model $data = [], ?string $message = null): JsonResponse
    {
        return match ($this){
            self::NotFound => response()->json(array_merge(['code' => self::NotFound->getCode(), 'status' => 'failed', 'data' => $data, 'message' => $message ?? self::NotFound->getLabel()]), self::NotFound->getCode()),
            self::Unauthorized => response()->json(array_merge(['code' => self::Unauthorized->getCode(), 'status' => 'failed', 'data' => $data, 'message' => $message ?? self::Unauthorized->getLabel()]), self::Unauthorized->getCode()),
            self::Forbidden => response()->json(array_merge(['code' => self::Forbidden->getCode(), 'status' => 'failed', 'data' => $data, 'message' => $message ?? self::Forbidden->getLabel()]), self::Forbidden->getCode()),
            self::Success => response()->json(array_merge(['code' => self::Success->getCode(), 'status' => 'success', 'data' => $data, 'message' => $message ?? self::Success->getLabel()]), self::Success->getCode()),
            self::Created => response()->json(array_merge(['code' => self::Created->getCode(), 'status' => 'success', 'data' => $data, 'message' => $message ?? self::Created->getLabel()]), self::Created->getCode()),
            self::Fatal => response()->json(array_merge(['code' => self::Fatal->getCode(), 'status' => 'failed', 'data' => $data, 'message' => $message ?? self::Fatal->getLabel()]), self::Fatal->getCode()),
        };
    }

}
