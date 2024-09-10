<?php

namespace App\Services\Navbar;

readonly class NavbarItem 
{
    public function __construct(
        public string $name,
        public ?string $url,
        /**
         * @var NavbarItem[]
         */
        public array $children
    ) {}
}
