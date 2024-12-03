<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    |  following language lines contain  default error messages used by
    |  validator class. Some of se rules have multiple versions such
    | as  size rules. Feel free to tweak each of se messages here.
    |
    */

    'accepted' => ' :attribute doit être accepté.',
    'active_url' => ' :attribute is not a valid URL.',
    'after' => ' :attribute doit être a date after :date.',
    'after_or_equal' => ' :attribute doit être a date after ou égal à to :date.',
    'alpha' => ' :attribute may only contain letters.',
    'alpha_dash' => ' :attribute may only contain letters, numbers, dashes et underscores.',
    'alpha_num' => ' :attribute may only contain letters et numbers.',
    'array' => ' :attribute doit être an array.',
    'before' => ' :attribute doit être a date before :date.',
    'before_or_equal' => ' :attribute doit être a date before ou égal à to :date.',
    'between' => [
        'numeric' => ' :attribute doit être between :min et :max.',
        'file' => ' :attribute doit être between :min et :max kilobytes.',
        'string' => ' :attribute doit être between :min et :max characters.',
        'array' => ' :attribute doit avoir between :min et :max items.',
    ],
    'boolean' => ' :attribute champ, doit être true or false.',
    'confirmed' => ' :attribute confirmation does not match.',
    'date' => ' :attribute is not a valid date.',
    'date_equals' => ' :attribute doit être a date equal to :date.',
    'date_format' => ' :attribute does not match  format :format.',
    'different' => ' :attribute et :or doit être different.',
    'digits' => ' :attribute doit être  :digits digits.',
    'digits_between' => ' :attribute doit être between :min et :max digits.',
    'dimensions' => ' :attribute has invalid image dimensions.',
    'distinct' => ' :attribute champ, has a duplicate value.',
    'email' => ' :attribute doit être un valide email address.',
    'ends_with' => ' :attribute must end with one of  following: :values.',
    'exists' => ' selected :attribute is invalid.',
    'file' => ' :attribute doit être un fichier.',
    'filled' => ' :attribute champ, doit avoir a value.',
    'gt' => [
        'numeric' => ' :attribute doit être plus grand que :value.',
        'file' => ' :attribute doit être plus grand que :value kilobytes.',
        'string' => ' :attribute doit être plus grand que :value characters.',
        'array' => ' :attribute doit avoir more than :value items.',
    ],
    'gte' => [
        'numeric' => ' :attribute doit être plus grand que ou égal à :value.',
        'file' => ' :attribute doit être plus grand que ou égal à :value kilobytes.',
        'string' => ' :attribute doit être plus grand que ou égal à :value characters.',
        'array' => ' :attribute doit avoir :value items or more.',
    ],
    'image' => ' :attribute doit être an image.',
    'in' => ' selected :attribute is invalid.',
    'in_array' => ' :attribute champ, does not exist in :or.',
    'integer' => ' :attribute doit être un entier.',
    'ip' => ' :attribute doit être un valid IP address.',
    'ipv4' => ' :attribute doit être un valid IPv4 address.',
    'ipv6' => ' :attribute doit être un valid IPv6 address.',
    'json' => ' :attribute doit être un valid JSON string.',
    'lt' => [
        'numeric' => ' :attribute doit être plus petit(e) que :value.',
        'file' => ' :attribute doit être plus petit(e) que :value kilobytes.',
        'string' => ' :attribute doit être plus petit(e) que :value characters.',
        'array' => ' :attribute doit avoir plus petit(e) que :value items.',
    ],
    'lte' => [
        'numeric' => ' :attribute doit être plus petit(e) que ou égal à :value.',
        'file' => ' :attribute doit être plus petit(e) que ou égal à :value kilobytes.',
        'string' => ' :attribute doit être plus petit(e) que ou égal à :value characters.',
        'array' => ' :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ' :attribute may not beplus grand que :max.',
        'file' => ' :attribute may not beplus grand que :max kilobytes.',
        'string' => ' :attribute may not beplus grand que :max characters.',
        'array' => ' :attribute may not have more than :max items.',
    ],
    'mimes' => ' :attribute doit être a file of type: :values.',
    'mimetypes' => ' :attribute doit être a file of type: :values.',
    'min' => [
        'numeric' => ' :attribute doit être au moins :min.',
        'file' => ' :attribute doit être au moins :min kilobytes.',
        'string' => ' :attribute doit être au moins :min characters.',
        'array' => ' :attribute doit avoir au moins :min items.',
    ],
    'not_in' => ' selected :attribute is invalid.',
    'not_regex' => ' :attribute format is invalid.',
    'numeric' => ' :attribute doit être de type numerique(entier).',
    'password' => ' mot de passe n\'est pas correcte.',
    'present' => ' :attribute champ, doit être present.',
    'regex' => ' :attribute format is invalid.',
    'required' => ' :attribute champ, est obligatoire.',
    'required_if' => ' :attribute champ, est obligatoire when :or is :value.',
    'required_unless' => ' :attribute champ, est obligatoire unless :or is in :values.',
    'required_with' => ' :attribute champ, est obligatoire when :values is present.',
    'required_with_all' => ' :attribute champ, est obligatoire when :values are present.',
    'required_without' => ' :attribute champ, est obligatoire when :values is not present.',
    'required_without_all' => ' :attribute champ, est obligatoire when none of :values are present.',
    'same' => ' :attribute et :or must match.',
    'size' => [
        'numeric' => ' :attribute doit être :size.',
        'file' => ' :attribute doit être :size kilobytes.',
        'string' => ' :attribute doit être :size characters.',
        'array' => ' :attribute must contain :size items.',
    ],
    'starts_with' => ' :attribute must start with one of  following: :values.',
    'string' => ' :attribute doit être une chaine de caractère.',
    'timezone' => ' :attribute doit être a valid zone.',
    'unique' => ' :attribute est déjà pris (champs unique).',
    'uploaded' => ' :attribute failed to upload.',
    'url' => ' :attribute format is invalid.',
    'uuid' => ' :attribute doit être a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using 
    | convention "attribute.rule" to name  lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    |  following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
