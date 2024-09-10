<?php

namespace App\Interfaces;


interface Pageable
{
    public function getPageName(): ?string;

    public function getSlug(): ?string;

}
