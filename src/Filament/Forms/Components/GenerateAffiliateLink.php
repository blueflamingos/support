<?php

declare(strict_types=1);

namespace Blueflamingos\Support\Filament\Forms\Components;

use Blueflamingos\Support\Actions\QennerDealToDeal\GetAffiliateLinkTask;
use Blueflamingos\Support\Actions\QennerDealToDeal\GetQennerBooklinkTask;
use Blueflamingos\Support\Services\AffiliateLink\DealInformation;
use Blueflamingos\Support\Services\Qenner\QennerService;
use Blueflamingos\Support\Services\Qenner\Query\Builder;
use Filament\Forms\Components\Field;

class GenerateAffiliateLink extends Field
{
    protected string $view = 'forms.components.generate-affiliate-link';

    protected function setUp(): void
    {
        parent::setUp();

        $this->disableLabel();

        $this->afterStateHydrated(static function (self $component): void {
            // Reset the state after the page is loaded
            $component->state(null);
        });

        $this->registerListeners([
            'generate-affiliate-link::generateLink' => [
                function (self $component, string $statePath): void {
                    if ($statePath !== $component->getStatePath()) {
                        return;
                    }
                    /** @var \Blueflamingos\Support\Models\DealConcept $deal */
                    $deal = $component->getRecord();

                    $service = app(QennerService::class);
                    $qennerDeal = $service->getSearchResults(1, 1, (new Builder())->where('OsiCode', $deal->osi_code))->first();
                    if (empty($qennerDeal)) {
                        $this->state('Deal niet gevonden bij Qenner');
                    }
                    $booklink = app(GetQennerBooklinkTask::class)->handle($qennerDeal);

                    $affiliateUrl = app(GetAffiliateLinkTask::class)->handle(DealInformation::fromQennerDealDto($qennerDeal), $booklink, "Q-{$deal->slug}");

                    $this->state($affiliateUrl);
                },
            ],
        ]);
    }
}
