<?php

namespace Core;

use App\Exceptions\ValidationException;
use Laminas\Diactoros\ServerRequest;
use Somnambulist\Components\Validation\Factory;

abstract class Controller
{
    /**
     * @param ServerRequest $request
     * @param array $rules
     * @return Factory
     * @throws ValidationException
     */
    public function validate(ServerRequest $request, array $rules): Factory
    {
        $validator = (new Factory)->make(
            $request->getParsedBody() + $request->getUploadedFiles(),
            $rules
        );

        if (!$validator->validate()){
            throw new ValidationException($request, $validator->errors()->firstOfAll());
        }

        return $validator;
    }
}