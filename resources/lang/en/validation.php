<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    |  following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ' :attribute musí být accepted.',
    'active_url' => ' :attribute is not a valid URL.',
    'after' => ' :attribute musí být a date after :date.',
    'after_or_equal' => ' :attribute musí být a date after or equal to :date.',
    'alpha' => ' :attribute may only contain letters.',
    'alpha_dash' => ' :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => ' :attribute may only contain letters and numbers.',
    'array' => ' :attribute musí být an array.',
    'before' => ' :attribute musí být a date before :date.',
    'before_or_equal' => ' :attribute musí být a date before or equal to :date.',
    'between' => [
        'numeric' => ' :attribute musí být alespoň :min a maximálně  :max.',
        'file' => ' :attribute musí být alespoň :min a maximálně  :max kilobytes.',
        'string' => ' :attribute musí být alespoň :min a maximálně :max znaků.',
        'array' => ' :attribute must have between :min and :max array.',
    ],
    'boolean' => ' :attribute field musí být true or false.',
    'confirmed' => ' :attribute se neshodují.',
    'date' => ' :attribute is not a valid date.',
    'date_equals' => ' :attribute musí být a date equal to :date.',
    'date_format' => ' :attribute does not match the format :format.',
    'different' => ' :attribute and :other musí být different.',
    'digits' => ' :attribute musí být :digits digits.',
    'digits_between' => ' :attribute musí být between :min and :max digits.',
    'dimensions' => ' :attribute has invalid image dimensions.',
    'distinct' => ' :attribute field has a duplicate value.',
    'email' => ' :attribute musí být platná emailová adresa.',
    'ends_with' => ' :attribute must end with one of the following: :values.',
    'exists' => '  :attribute již existuje.',
    'file' => ' :attribute musí být souor.',
    'filled' => ' :attribute field must have a value.',
    'gt' => [
        'numeric' => ' :attribute musí být greater than :value.',
        'file' => ' :attribute musí být greater than :value kilobytes.',
        'string' => ' :attribute musí být greater than :value znaků.',
        'array' => ' :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => ' :attribute musí být greater than or equal :value.',
        'file' => ' :attribute musí být greater than or equal :value kilobytes.',
        'string' => ' :attribute musí být greater than or equal :value znaků.',
        'array' => ' :attribute must have :value items or more.',
    ],
    'image' => ' :attribute musí být obrázek.',
    'in' => ' selected :attribute is invalid.',
    'in_array' => ' :attribute field does not exist in :other.',
    'integer' => ' :attribute musí být an integer.',
    'ip' => ' :attribute musí být a valid IP address.',
    'ipv4' => ' :attribute musí být a valid IPv4 address.',
    'ipv6' => ' :attribute musí být a valid IPv6 address.',
    'json' => ' :attribute musí být a valid JSON string.',
    'lt' => [
        'numeric' => ' :attribute musí být less than :value.',
        'file' => ' :attribute musí být less than :value kilobytes.',
        'string' => ' :attribute musí být více než :value znaků.',
        'array' => ' :attribute must mít více než :value znaků.',
    ],
    'lte' => [
        'numeric' => ' :attribute musí být less than or equal :value.',
        'file' => ' :attribute musí být less than or equal :value kilobytes.',
        'string' => ' :attribute musí být less than or equal :value characters.',
        'array' => ' :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ' :attribute may not be greater than :max.',
        'file' => ' :attribute may not be greater than :max kilobytes.',
        'string' => ' :attribute may not be greater than :max characters.',
        'array' => ' :attribute may not have more than :max items.',
    ],
    'mimes' => ' :attribute musí být a file of type: :values.',
    'mimetypes' => ' :attribute musí být a file of type: :values.',
    'min' => [
        'numeric' => ' :attribute musí být aspoń :min.',
        'file' => ' :attribute musí být být aspoń :min kilobytes.',
        'string' => ' :attribute musí být být aspoń :min znaků.',
        'array' => ' :attribute must have být aspoń :min items.',
    ],
    'not_in' => ' selected :attribute is invalid.',
    'not_regex' => ' :attribute format is invalid.',
    'numeric' => ' :attribute musí být číslo.',
    'password' => ' Heslo je nesprávné.',
    'present' => ' :attribute field musí být present.',
    'regex' => ' :attribute format is invalid.',
    'required' => ' :attribute je nutné vyplnit.',
    'required_if' => ' :attribute field is required when :other is :value.',
    'required_unless' => ' :attribute field is required unless :other is in :values.',
    'required_with' => ' :attribute field is required when :values is present.',
    'required_with_all' => ' :attribute field is required when :values are present.',
    'required_without' => ' :attribute field is required when :values is not present.',
    'required_without_all' => ' :attribute field is required when none of :values are present.',
    'same' => ' :attribute a :other se musí shodovat.',
    'size' => [
        'numeric' => ' :attribute musí být :size.',
        'file' => ' :attribute musí být :size kilobytes.',
        'string' => ' :attribute musí být :size znaků.',
        'array' => ' :attribute must contain :size items.',
    ],
    'starts_with' => ' :attribute must start with one of the following: :values.',
    'string' => ' :attribute musí obsahovat znaky.',
    'timezone' => ' :attribute musí být a valid zone.',
    'unique' => ' :attribute je už zabrané.',
    'uploaded' => ' :attribute failed to upload.',
    'url' => ' :attribute format is invalid.',
    'uuid' => ' :attribute musí být a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
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

    'attributes' => [
        'firstname' => 'Křestní jméno',
        'lastname' => 'Přijmení',
        'email' => 'Emailová adresa',
        'phone' => 'Telefonní číslo ',
        'username' => 'E-mailová adresa ',
        'password' => 'Heslo ',
        'old_password' => 'Staré heslo ',
        'confirm_password' => 'Heslo ',
        'name' => 'Název',
        'imagePath' => 'Obrázek',
        'nazev' => 'Název',
        'ulice' => 'Ulice',
        'zeme' => 'Země',
        'psc' => 'PSČ',
        'ic' => 'IČ',
        'dic' => 'DIČ',
        'ulice' => 'Ulice',
        'mnozstvi' => 'Množství',
        'status' => 'Status',
        'category_id' => 'Číslo kategorie',
        'status' => 'Status',
        'hmotnost' => 'Hmotnost',
        'dobatrvanlivosti' => 'Minimální trvanlivosti',
        'slozeni' => 'Složení',
        'popis' => 'Popis zboží',
        'reason' => 'Předmět zprávy',
        'number' => 'Telefonní číslo',
        'message' => 'Zpráva',
    ],

];
