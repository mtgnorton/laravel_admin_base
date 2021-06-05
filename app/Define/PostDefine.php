<?php

namespace App\Define;

class PostDefine
{

    const TYPE = [
        'MILITARY'   => 'military',//军事
        'SCIENCE'    => 'science',//科学
        'LITERATURE' => 'literature',//文学
    ];

    static public function typeText()
    {
        return [
            'military'   => ll('military'),
            'science'    => ll('science'),
            'literature' => ll('literature'),
        ];
    }


}





