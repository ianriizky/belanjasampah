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

    'accepted'             => 'Kolom :attribute harus bisa diterima.',
    'active_url'           => 'Kolom :attribute bukan merupakan URL yang valid.',
    'after'                => 'Kolom :attribute tidak boleh kurang dari :date.',
    'after_or_equal'       => 'Kolom :attribute tidak boleh kuran atau sama dengan :date.',
    'alpha'                => 'Kolom :attribute hanya boleh berisi kata.',
    'alpha_dash'           => 'Kolom :attribute hanya boleh berisi kata, angka, dan simbol dash (-).',
    'alpha_num'            => 'Kolom :attribute hanya boleh berisi kata dan angka.',
    'array'                => 'Kolom :attribute harus berupa array.',
    'before'               => 'Kolom :attribute tidak boleh lebih dari :date.',
    'before_or_equal'      => 'Kolom :attribute tidak boleh lebih atau sama dengan :date.',
    'between'              => [
        'numeric' => 'Kolom :attribute harus ada di antara :min dan :max.',
        'file'    => 'Kolom :attribute harus ada di antara :min dan :max kilobytes.',
        'string'  => 'Kolom :attribute harus ada di antara :min dan :max karakter.',
        'array'   => 'Kolom :attribute harus ada di antara :min dan :max item.',
    ],
    'boolean'              => 'Kolom :attribute harus berupa benar atau salah.',
    'confirmed'            => 'Konfirmasi dari :attribute tidak cocok.',
    'date'                 => 'Kolom :attribute bukan tanggal yang valid.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'Kolom :attribute dan :other harus berbeda.',
    'digits'               => 'Kolom :attribute harus memiliki :digits digit.',
    'digits_between'       => 'Kolom :attribute harus berada di antara :min dan :max digit.',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'Kolom :attribute harus beruap alamat email yang valid.',
    'exists'               => 'The selected :attribute is invalid.',
    'file'                 => 'Kolom :attribute harus berupa file.',
    'filled'               => 'Kolom :attribute harus memiliki nilai.',
    'image'                => 'Kolom :attribute harus berupa gambar.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'Kolom :attribute harus berupa integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'ipv4'                 => 'The :attribute must be a valid IPv4 address.',
    'ipv6'                 => 'The :attribute must be a valid IPv6 address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'Kolom :attribute tidak boleh lebih dari :max.',
        'file'    => 'Kolom :attribute tidak boleh lebih dari :max kilobytes.',
        'string'  => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
        'array'   => 'Kolom :attribute tidak boleh lebih dari :max item.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'Kolom :attribute tidak boleh kurang dari :min.',
        'file'    => 'Kolom :attribute tidak boleh kurang dari :min kilobytes.',
        'string'  => 'Kolom :attribute tidak boleh kurang dari :min karakter.',
        'array'   => 'Kolom :attribute tidak boleh kurang dari :min item.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'Kolom :attribute harus berupa angka.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'Format dari kolom :attribute tidak valid.',
    'required'             => 'Kolom :attribute harus diisi.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'Kolom :attribute harus berupa karakter (string).',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'Kolom :attribute sudah ada sebelumnya.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

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
    'image64' => 'Kolom :attribute harus berupa file dengan tipe :values.',
    
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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
