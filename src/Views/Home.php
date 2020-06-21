<?php

declare(strict_types=1);

namespace Views;

use Controllers\Controller;
use Templates\Nav;
use Templates\Footer;
use Templates\Image;
use Templates\InlinedCss;

/**
 * 
 */
class Home extends View
{
    /**
     * Define defaults, take arguments
     */
    // public function __construct(array $args = [])
    public function __construct(Controller $controller)
    {
        parent::__construct($controller);
        $defaults = [
            'row_count' => 12,
            'col_count' => 12,
        ];
        $this->args = $this->args + $defaults;
    }
    /**
     * todo
     *   - [ ] Build from data
     */
    public function compose(): self
    {

        $this->components['css'] = [
            // new InlinedCss([ROOT.'resources/css/style.min.css']),
            new InlinedCss(['css/style.css'])
        ];

        $this->components['nav'] = [
            new Nav(
                new Image('images/icons/logo.png', 'ComparOperator', 30, 30),
                [
                    'Home' => 'index.php?controller=Home',
                    'Admin' => '?controller=Dashboard&action=Admin',
                    'Operator' => '?controller=Dashboard&action=Admin',
                ],
                0,
                /**
                 * @todo Check how stacking a query like that with a GET form
                 *       works.
                 */
                'index.php',
                'Sign up',
                'index.php?controller=Home&action=Signup',
            )
        ];

        $this->components['content'] = [
            new Image('images/icons/cross.svg', 'a red cross'),
            new Image('images/icons/cross.svg', 'a red cross', 64, 64),
            new Image('images/icons/cross.svg', 'a red cross', 128, 128),
        ];

        $this->components['ads'] = [
            new Image('images/icons/cross.svg', 'a red cross'),
            new Image('images/icons/cross.svg', 'a red cross', 64, 64),
            new Image('images/icons/cross.svg', 'a red cross', 128, 128),
        ];


        $this->components['footer'] = [
            new Footer([
                'Minichat' => '?controller=MinichatAPI',
                '1x1' => '?controller=Home&action=value&row_count=1&col_count=1',
                '3x3' => '?controller=Home&action=value&row_count=3&col_count=3',
                '6x6' => '?controller=Home&action=value&row_count=6&col_count=6',
                '12x12' => '?controller=Home&action=value&row_count=12&col_count=12',
            ])
        ];
        return $this;
    }
}
