<?php

declare(strict_types=1);

namespace PayonePayment\Payone\Request\CreditCardCheck;

use PayonePayment\Payone\Request\AbstractRequestFactory;
use PayonePayment\Payone\Request\System\SystemRequest;
use Shopware\Core\System\SalesChannel\SalesChannelContext;

class CreditCardCheckRequestFactory extends AbstractRequestFactory
{
    /** @var CreditCardCheckRequest */
    private $creditCardRequest;

    /** @var SystemRequest */
    private $systemRequest;

    public function __construct(CreditCardCheckRequest $creditCardCheckRequest, SystemRequest $systemRequest)
    {
        $this->creditCardRequest = $creditCardCheckRequest;
        $this->systemRequest     = $systemRequest;
    }

    public function getRequestParameters(SalesChannelContext $context): array
    {
        $this->requests[] = $this->creditCardRequest->getRequestParameters();

        $this->requests[] = $this->systemRequest->getRequestParameters(
            $context->getSalesChannel()->getId(),
            SystemRequest::CONFIGURATION_PREFIX_CREDITCARD
        );

        return $this->createRequest();
    }
}
