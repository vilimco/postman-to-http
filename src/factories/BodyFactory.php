<?php
/**
 * Created by PHPSTorm.
 * Date: 22/04/2018
 * Time: 21:21
 */

namespace P2H\factories;


use P2H\models\Body;
use P2H\models\body\EmptyBody;
use P2H\models\body\FormDataBody;
use P2H\models\body\RawBody;
use P2H\models\body\UrlEncodedBody;

class BodyFactory
{
    /**
     * @param $requestBody
     * @return Body
     */
    public function create($requestBody)
    {
        if (!$requestBody || !isset($requestBody->mode)) {
            return new EmptyBody();
        }

        switch ($requestBody->mode) {
            case 'formdata':
                return new FormDataBody($requestBody->formdata);
            case 'urlencoded':
                return new UrlEncodedBody($requestBody->urlencoded);
            case 'raw':
                return new RawBody($requestBody->raw);
            default:
                return new EmptyBody();
        }
    }

}
