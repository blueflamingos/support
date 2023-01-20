<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Components\Concerns;

use Closure;

trait InteractsWithShortCodes
{
    protected bool $insertShortCodesAsHTML = false;

    public function shortCodes(array | Closure $shortCodes): static
    {
        if (is_array($shortCodes)) {
            $this->shortCodes += $shortCodes;

            return $this;
        }

        $this->shortCodes = $shortCodes;

        return $this;
    }

    public function getShortCodes(): array
    {
        return $this->evaluate($this->shortCodes);
    }

    public function hasShortCodes(): bool
    {
        return empty($this->shortCodes) === false;
    }

    public function shortCodesAsHTML(bool $insertShortCodesAsHTML = true): static
    {
        $this->insertShortCodesAsHTML = $insertShortCodesAsHTML;

        return $this;
    }

    public function insertShortCodesAsHtml(): bool
    {
        return $this->insertShortCodesAsHTML;
    }
}
