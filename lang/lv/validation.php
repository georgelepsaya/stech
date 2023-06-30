<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Lauks :attribute jābūt apstiprinātam.',
    'accepted_if' => 'Lauks :attribute jābūt apstiprinātam, ja :other ir :value.',
    'active_url' => 'Laukā :attribute ir jābūt derīgai URL.',
    'after' => 'Laukā :attribute jābūt datumam pēc :date.',
    'after_or_equal' => 'Laukā :attribute jābūt datumam pēc vai vienādam ar :date.',
    'alpha' => 'Laukā :attribute drīkst būt tikai burti.',
    'alpha_dash' => 'Laukā :attribute drīkst būt tikai burti, cipari, domuzīmes un pasvītras.',
    'alpha_num' => 'Laukā :attribute drīkst būt tikai burti un cipari.',
    'array' => 'Laukam :attribute jābūt masīvam.',
    'ascii' => 'Laukā :attribute drīkst būt tikai vienbaitu alfa-ciparu rakstzīmes un simboli.',
    'before' => 'Laukā :attribute jābūt datumam pirms :date.',
    'before_or_equal' => 'Laukā :attribute jābūt datumam pirms vai vienādam ar :date.',
    'between' => [
    'array' => 'Laukam :attribute jābūt no :min līdz :max vienumiem.',
    'file' => 'Laukam :attribute jābūt no :min līdz :max kilobaitiem.',
    'numeric' => 'Laukam :attribute jābūt no :min līdz :max.',
    'string' => 'Laukam :attribute jābūt no :min līdz :max rakstzīmēm.',
    ],
    'boolean' => 'Laukam :attribute jābūt patiesam vai nepatiesam.',
    'confirmed' => 'Lauka :attribute apstiprinājums nesakrīt.',
    'current_password' => 'Nepareiza parole.',
    'date' => 'Laukā :attribute ir jābūt derīgam datumam.',
    'date_equals' => 'Laukam :attribute jābūt datumam, kas vienāds ar :date.',
    'date_format' => 'Lauks :attribute neatbilst formātam :format.',
    'decimal' => 'Laukā :attribute jābūt :decimal decimālo vietu.',
    'declined' => 'Laukam :attribute jābūt noraidītam.',
    'declined_if' => 'Laukam :attribute jābūt noraidītam, ja :other ir :value.',
    'different' => 'Laukam :attribute un :other jābūt atšķirīgiem.',
    'digits' => 'Laukam :attribute jābūt :digits cipariem.',
    'digits_between' => 'Laukam :attribute jābūt no :min līdz :max cipariem.',
    'dimensions' => 'Laukā :attribute ir nederīgi attēla izmēri.',
    'distinct' => 'Laukam :attribute ir dublikāta vērtība.',
    'doesnt_end_with' => 'Laukam :attribute nedrīkst beigties ar vienu no šiem: :values.',
    'doesnt_start_with' => 'Laukam :attribute nedrīkst sākties ar vienu no šiem: :values.',
    'email' => 'Laukam :attribute jābūt derīgai e-pasta adresei.',
    'ends_with' => 'Laukam :attribute jābeidzas ar vienu no šiem: :values.',
    'enum' => 'Izvēlētā :attribute ir nederīga.',
    'exists' => 'Izvēlētais :attribute ir nederīgs.',
    'file' => 'Laukam :attribute jābūt failam.',
    'filled' => 'Laukam :attribute ir jābūt aizpildītam.',
    'gt' => [
    'array' => 'Laukam :attribute jābūt vairāk nekā :value vienumiem.',
    'file' => 'Laukam :attribute jābūt lielākam par :value kilobaitiem.',
    'numeric' => 'Laukam :attribute jābūt lielākam par :value.',
    'string' => 'Laukam :attribute jābūt lielākam par :value rakstzīmēm.',
    ],
    'gte' => [
    'array' => 'Laukam :attribute jābūt :value vienumiem vai vairāk.',
    'file' => 'Laukam :attribute jābūt lielākam vai vienādam ar :value kilobaitiem.',
    'numeric' => 'Laukam :attribute jābūt lielākam vai vienādam ar :value.',
    'string' => 'Laukam :attribute jābūt lielākam vai vienādam ar :value rakstzīmēm.',
    ],
    'image' => 'Laukam :attribute jābūt attēlam.',
    'in' => 'Izvēlētais :attribute ir nederīgs.',
    'in_array' => 'Laukam :attribute jāeksistē :other.',
    'integer' => 'Laukam :attribute jābūt veselam skaitlim.',
    'ip' => 'Laukam :attribute jābūt derīgai IP adresē.',
    'ipv4' => 'Laukam :attribute jābūt derīgai IPv4 adresē.',
    'ipv6' => 'Laukam :attribute jābūt derīgai IPv6 adresē.',
    'json' => 'Laukam :attribute jābūt derīgai JSON virknei.',
    'lowercase' => 'Laukam :attribute jābūt mazajiem burtiem.',
    'lt' => [
    'array' => 'Laukam :attribute jābūt mazāk par :value vienumiem.',
    'file' => 'Laukam :attribute jābūt mazākam par :value kilobaitiem.',
    'numeric' => 'Laukam :attribute jābūt mazākam par :value.',
    'string' => 'Laukam :attribute jābūt mazākam par :value rakstzīmēm.',
    ],
    'lte' => [
    'array' => 'Laukam :attribute nedrīkst būt vairāk par :value vienumiem.',
    'file' => 'Laukam :attribute jābūt mazākam vai vienādam ar :value kilobaitiem.',
    'numeric' => 'Laukam :attribute jābūt mazākam vai vienādam ar :value.',
    'string' => 'Laukam :attribute jābūt mazākam vai vienādam ar :value rakstzīmēm.',
    ],
    'mac_address' => 'Laukam :attribute jābūt derīgai MAC adresei.',
    'max' => [
    'array' => 'Laukam :attribute nedrīkst būt vairāk par :max vienumiem.',
    'file' => 'Laukam :attribute nedrīkst būt lielākam par :max kilobaitiem.',
    'numeric' => 'Laukam :attribute nedrīkst būt lielākam par :max.',
    'string' => 'Laukam :attribute nedrīkst būt lielākam par :max rakstzīmēm.',
    ],
    'max_digits' => 'Laukam :attribute nedrīkst būt vairāk par :max cipariem.',
    'mimes' => 'Laukam :attribute jābūt failam no šiem tipiem: :values.',
    'mimetypes' => 'Laukam :attribute jābūt failam no šiem tipiem: :values.',
    'min' => [
    'array' => 'Laukam :attribute jābūt vismaz :min vienumiem.',
    'file' => 'Laukam :attribute jābūt vismaz :min kilobaitiem.',
    'numeric' => 'Laukam :attribute jābūt vismaz :min.',
    'string' => 'Laukam :attribute jābūt vismaz :min rakstzīmēm.',
    ],
    'min_digits' => 'Laukam :attribute jābūt vismaz :min cipariem.',
    'missing' => 'Laukam :attribute jābūt pazudis.',
    'missing_if' => 'Laukam :attribute jābūt pazudis, kad :other ir :value.',
    'missing_unless' => 'Laukam :attribute jābūt pazudis, ja nav :other vērtības :value.',
    'missing_with' => 'Laukam :attribute jābūt pazudis, kad ir klāt :values.',
    'na' => 'Laukam :attribute jābūt nedostupam.',
    'name' => 'Laukam :attribute jābūt derīgam vārdam.',
    'not_in' => 'Izvēlētais :attribute ir nederīgs.',
    'not_regex' => 'Lauka :attribute formāts ir nederīgs.',
    'numeric' => 'Laukam :attribute jābūt skaitlim.',
    'password' => 'Nepareiza parole.',
    'passwords_compare' => 'Paroles nesakrīt.',
    'passwords_same' => 'Jauna parole nedrīkst sakrist ar esošo paroli.',
    'phone' => 'Laukam :attribute jābūt derīgam tālruņa numuram.',
    'present' => 'Laukam :attribute jābūt klāt.',
    'prohibited' => 'Laukam :attribute ir aizliegts.',
    'prohibited_if' => 'Laukam :attribute ir aizliegts, ja :other ir :value.',
    'prohibited_unless' => 'Laukam :attribute ir aizliegts, ja nav :other vērtības :values.',
    'prohibits' => 'Lauks :attribute aizliedz :other.',
    'regex' => 'Lauka :attribute formāts ir nederīgs.',
    'relatable' => 'Šis :attribute nevar tikt saistīts ar šo resursu.',
    'required' => 'Lauks :attribute ir obligāts.',
    'required_if' => 'Lauks :attribute ir obligāts, ja :other ir :value.',
    'required_unless' => 'Lauks :attribute ir obligāts, ja nav :other vērtības :values.',
    'required_with' => 'Lauks :attribute ir obligāts, kad ir klāt :values.',
    'required_with_all' => 'Lauks :attribute ir obligāts, kad ir klāt :values.',
    'required_without' => 'Lauks :attribute ir obligāts, kad nav :values.',
    'required_without_all' => 'Lauks :attribute ir obligāts, kad nav nevienas no :values.',
    'same' => 'Laukiem :attribute un :other jāsakrīt.',
    'size' => [
    'array' => 'Lauka :attribute jāsatur :size vienumi.',
    'file' => 'Lauka :attribute izmēram jābūt :size kilobaitiem.',
    'numeric' => 'Laukam :attribute jābūt :size.',
    'string' => 'Laukam :attribute jābūt :size rakstzīmēm.',
    ],
    'slug' => 'Laukam :attribute jābūt derīgam URL fragmentam.',
    'starts_with' => 'Laukam :attribute jāsākas ar vienu no šiem: :values.',
    'string' => 'Laukam :attribute jābūt virknei.',
    'timezone' => 'Laukam :attribute jābūt derīgai laika zonai.',
    'unique' => 'Lauka :attribute vērtība jau ir aizņemta.',
    'uploaded' => 'Lauku :attribute neizdevās augšupielādēt.',
    'url' => 'Lauka :attribute formāts ir nederīgs.',
    'uuid' => 'Laukam :attribute jābūt derīgam UUID identifikatoram.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
