<?php

return [
    'accepted'                       => ':attribute måste vara accepterat.',
    'active_url'                     => ':attribute är inte en giltig URL.',
    'after'                          => ':attribute måste vara ett datum efter :date.',
    'after_or_equal'                 => ':attribute måste vara ett datum efter :date eller lika med :date',
    'alpha'                          => ':attribute får bara innehålla bokstäver.',
    'alpha_dash'                     => ':attribute får bara innehålla bokstäver, nummer och bindestreck.',
    'alpha_num'                      => ':attribute får bara innehålla bokstäver och nummer.',
    'latin'                          => 'The :attribute may only contain ISO basic Latin alphabet letters.',
    'latin_dash_space'               => 'The :attribute may only contain ISO basic Latin alphabet letters, numbers, dashes, hyphens and spaces.',
    'array'                          => ':attribute måste vara en lista (array).',
    'before'                         => ':attribute måste vara ett datum före :date.',
    'before_or_equal'                => ':attribute måste vara ett datum före, eller lika med :date',
    'between'                        => [
        'numeric' => ':attribute måste vara mellan :min och :max.',
        'file'    => ':attribute måste vara mellan :min och :max kilobytes.',
        'string'  => ':attribute måste vara mellan :min och :max antal tecken.',
        'array'   => ':attribute måste ha mellan :min och :max saker.',
    ],
    'boolean'                        => ':attribute fältet måste vara sant eller falskt.',
    'confirmed'                      => ':attribute matchar inte.',
    'date'                           => ':attribute är inte ett giltigt datum.',
    'date_format'                    => ':attribute matchar inte formatet :format.',
    'different'                      => ':attribute och :other måste vara olika.',
    'digits'                         => ':attribute måste vara :digits siffror.',
    'digits_between'                 => ':attribute  måste vara mellan :min och :max antal siffror.',
    'dimensions'                     => ':attribute har ogiltiga bild dimensioner.',
    'distinct'                       => ':attribute fältet har ett duplicerat värde.',
    'email'                          => ':attribute måste vara en giltig email adress.',
    'exists'                         => 'Det valda :attribute är ogiltigt.',
    'file'                           => ':attribute måste vara en fil.',
    'filled'                         => ':attribute är obligatoriskt.',
    'gt'                             => [
        'numeric' => ':attribute måste vara större än :value.',
        'file'    => ':attribute måste vara större än :value kilobytes.',
        'string'  => ':attribute måste bestå av fler än :value tecken.',
        'array'   => ':attribute måste vara fler än :value',
    ],
    'gte'                            => [
        'numeric' => ':attribute måste vara större än eller lika med :value.',
        'file'    => ':attribute måste vara större än eller lika med :value kilobytes.',
        'string'  => ':attribute måste vara större än eller lika med :value tecken.',
        'array'   => ':attribute måste vara :value eller flera.',
    ],
    'image'                          => ':attribute  måste vara en bild.',
    'in'                             => 'Det valda :attribute är ogiltigt.',
    'in_array'                       => ':attribute finns ej i :other.',
    'integer'                        => ':attribute måste vara ett heltal.',
    'ip'                             => ':attribute måste vara en giltig IP adress.',
    'ipv4'                           => ':attribute måste vara en giltig IP4 adress.',
    'ipv6'                           => ':attribute måste vara en giltig IP4 adress.',
    'json'                           => ':attribute måste vara giltig JSON.',
    'lt'                             => [
        'numeric' => 'The :attribute must be less than :value.',
        'file'    => 'The :attribute must be less than :value kilobytes.',
        'string'  => 'The :attribute must be less than :value characters.',
        'array'   => 'The :attribute must have less than :value items.',
    ],
    'lte'                            => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file'    => 'The :attribute must be less than or equal :value kilobytes.',
        'string'  => 'The :attribute must be less than or equal :value characters.',
        'array'   => 'The :attribute must not have more than :value items.',
    ],
    'max'                            => [
        'numeric' => ':attribute får inte vara större än :max.',
        'file'    => ':attribute får inte vara större än :max kilobytes.',
        'string'  => ':attribute får inte vara större än :max tecken.',
        'array'   => ':attribute får inte ha mer än :max saker.',
    ],
    'mimes'                          => ':attribute måste vara en fil av typ :values.',
    'mimetypes'                      => ':attribute måste vara en fil av typ :values.',
    'min'                            => [
        'numeric' => ':attribute måste vara minst :min.',
        'file'    => ':attribute måste vara minst :min kilobytes.',
        'string'  => ':attribute måste vara minst :min tecken.',
        'array'   => ':attribute måste ha minst :min saker.',
    ],
    'not_in'                         => 'Det valda :attribute är ogiltigt.',
    'not_regex'                      => ':attribute har felaktigt format.',
    'numeric'                        => ':attribute måste vara ett nummer.',
    'password'                       => 'Lösenordet är felaktigt.',
    'present'                        => ':attribute fältet måste vara ifyllt.',
    'regex'                          => ':attribute formatet är ogiltigt.',
    'required'                       => ':attribute fältet är obligatoriskt.',
    'required_if'                    => ':attribute är obligatoriskt när :other är :value.',
    'required_unless'                => ':attribute fältet är obligatoriskt om inte :other är i :values.',
    'required_with'                  => ':attribute fältet är obligatoriskt när :values är angivet.',
    'required_with_all'              => ':attribute fältet är obligatoriskt när :values är angivet.',
    'required_without'               => ':attribute fältet är obligatoriskt när :values inte är angivet.',
    'required_without_all'           => ':attribute fältet är obligatoriskt när inga av :values är angivna.',
    'same'                           => ':attribute och :other måste matcha.',
    'size'                           => [
        'numeric' => ':attribute måste vara :size.',
        'file'    => ':attribute måste vara :size kilobytes.',
        'string'  => ':attribute måste vara :size tecken.',
        'array'   => ':attribute måste innehålla :size saker.',
    ],
    'string'                         => ':attribute måste vara :size text.',
    'timezone'                       => ':attribute måste vara en :size giltig zon.',
    'unique'                         => ':attribute är redan taget.',
    'uploaded'                       => 'Uppladdning av :attribute misslyckades.',
    'url'                            => ':attribute formatet är ogiltigt.',
    'custom'                         => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    'reserved_word'                  => ':attribute innehåller ett reserverat ord.',
    'dont_allow_first_letter_number' => ':input fältet kan inte ha en siffra som första bokstav',
    'exceeds_maximum_number'         => ':attribute överstiger maximal längd',
    'db_column'                      => 'The :attribute may only contain ISO basic Latin alphabet letters, numbers, dash and cannot start with number.',
    'attributes'                     => [],
];
