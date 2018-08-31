<?php 

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Parameter;

class ParameterTransformer extends TransformerAbstract
{
    public function transform(Parameter $parameter)
    {
        return [
            'id'            => (int) $parameter->id,
            'name'          => (string) $parameter->name,
            'weight'        => (string) $parameter->weight,
            'type'          => (string) $parameter->type,
        ];
    }
}
