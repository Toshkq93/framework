<?php

namespace Core;

use Core\Exceptions\ValidationException;
use Laminas\Diactoros\ServerRequest;
use Somnambulist\Components\Validation\Factory;

abstract class Controller
{
    public function validate(ServerRequest $request, array $rules)
    {
        $validator = (new Factory)->make(
            $request->getParsedBody() + $request->getUploadedFiles(),
            $rules
        );
        $validator->validate();

        if ($validator->fails()){
            throw new ValidationException($request, $validator->errors()->firstOfAll());
        }

        return $validator->getValidData();
    }
}