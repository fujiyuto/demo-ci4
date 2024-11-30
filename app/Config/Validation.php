<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public array $create_user = [
        'user_name' => 'required|max_length[30]|is_unique',
        'email'     => 'required|email',
        'password'  => 'required|max_length[30]|password',
        'sex'       => 'required|in_list[1,2]'
    ];

    public array $login = [
        'user_name' => 'required|max_length[30]|is_unique',
        'password'  => 'required|max_length[30]|password'
    ];

    // --------------------------------------------------------------------
    // Error Messages
    // --------------------------------------------------------------------
    public array $create_user_errors = [
        'user_name' => [
            'required'   => '{field}は必須です',
            'max_length' => '{field}は30文字までです',
            'is_unique'  => '{field}は一意である必要があります'
        ],
        'email' => [
            'required' => '{field}は必須です',
            'email'    => 'メールアドレスの形式が正しくありません'
        ],
        'password' => [
            'required'   => '{field}は必須です',
            'max_length' => '{field}は30文字までです',
            'password'   => 'パスワードの形式が正しくありません'
        ],
        'sex' => [
            'required' => '{field}は必須です',
            'in_list'  => '{field}が正しくありません'
        ]
    ];

    public array $login_errors = [
        'user_name' => [
            'required'   => '{field}は必須です',
            'max_length' => '{field}は30文字までです',
            'is_unique'  => '{field}は一意である必要があります'
        ],
        'password' => [
            'required'   => '{field}は必須です',
            'max_length' => '{field}は30文字までです',
            'password'   => 'パスワードの形式が正しくありません'
        ]
    ];
}
