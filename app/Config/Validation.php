<?php

namespace Config;

use App\Validation\PasswordValidation;
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
        PasswordValidation::class,
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
        'user_name' => 'required|max_length[30]|is_unique[users.user_name]',
        'email'            => 'required|valid_email',
        'password'         => 'required|max_length[32]|password',
        'password_confirm' => 'required|matches[password]',
        'sex'              => 'required|in_list[1,2]'
    ];

    public array $login = [
        'user_name' => 'required|max_length[30]|is_not_unique[users.user_name]',
        'password'  => 'required|max_length[30]|password'
    ];
}
