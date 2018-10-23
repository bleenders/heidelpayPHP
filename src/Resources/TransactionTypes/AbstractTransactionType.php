<?php
/**
 * This is the base class for all transaction types.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * @license http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * @copyright Copyright © 2016-present heidelpay GmbH. All rights reserved.
 *
 * @link  http://dev.heidelpay.com/
 *
 * @author  Simon Gabriel <development@heidelpay.com>
 *
 * @package  heidelpay/mgw_sdk/transaction_types
 */
namespace heidelpay\MgwPhpSdk\Resources\TransactionTypes;

use heidelpay\MgwPhpSdk\Exceptions\HeidelpayApiException;
use heidelpay\MgwPhpSdk\Exceptions\HeidelpaySdkException;
use heidelpay\MgwPhpSdk\Resources\AbstractHeidelpayResource;
use heidelpay\MgwPhpSdk\Resources\Payment;
use heidelpay\MgwPhpSdk\Adapter\HttpAdapterInterface;
use heidelpay\MgwPhpSdk\Traits\HasOrderId;

abstract class AbstractTransactionType extends AbstractHeidelpayResource
{
    use HasOrderId;

    //<editor-fold desc="Properties">
    /** @var Payment $payment */
    private $payment;

    /** @var string $date */
    private $date;

    /** @var string $uniqueId */
    private $uniqueId;

    /** @var string $shortId */
    private $shortId;

    //</editor-fold>

    //<editor-fold desc="Getters/Setters">

    /**
     * Return the payment property.
     *
     * @return Payment|null
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set the payment object property.
     *
     * @param Payment $payment
     *
     * @return $this
     */
    public function setPayment($payment): self
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * Return the Id of the referenced payment object.
     *
     * @return null|string The Id of the payment object or null if nothing is found.
     */
    public function getPaymentId()
    {
        if ($this->payment instanceof Payment) {
            return $this->payment->getId();
        }

        return null;
    }

    /**
     * Return the redirect url stored in the payment object.
     *
     * @return string
     */
    public function getRedirectUrl(): string
    {
        return $this->payment->getRedirectUrl();
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     *
     * @return $this
     */
    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    /**
     * @param string $uniqueId
     *
     * @return $this
     */
    public function setUniqueId(string $uniqueId): self
    {
        $this->uniqueId = $uniqueId;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortId(): string
    {
        return $this->shortId;
    }

    /**
     * @param string $shortId
     *
     * @return AbstractTransactionType
     */
    public function setShortId(string $shortId): AbstractTransactionType
    {
        $this->shortId = $shortId;
        return $this;
    }

    //</editor-fold>

    //<editor-fold desc="Overridable methods">

    /**
     * {@inheritDoc}
     *
     * @throws HeidelpayApiException
     * @throws HeidelpaySdkException
     * @throws \RuntimeException
     */
    public function handleResponse(\stdClass $response, $method = HttpAdapterInterface::REQUEST_GET)
    {
        parent::handleResponse($response, $method);

        /** @var Payment $payment */
        $payment = $this->getPayment();
        if (isset($response->resources->paymentId)) {
            $payment->setId($response->resources->paymentId);
        }

        if (isset($response->redirectUrl)) {
            $payment->setRedirectUrl($response->redirectUrl);
        }

        if ($method !== HttpAdapterInterface::REQUEST_GET) {
            $this->updatePayment();
        }
    }

    //</editor-fold>

    /**
     * Updates the referenced payment object if it exists and if this is not the payment object itself.
     * This is called from the crud methods to update the payments state whenever anything happens.
     *
     * @throws \RuntimeException
     * @throws HeidelpayApiException
     * @throws HeidelpaySdkException
     */
    private function updatePayment()
    {
        if (!$this instanceof Payment) {
            $payment = $this->getPayment();
            if ($payment instanceof AbstractHeidelpayResource) {
                $this->fetchResource($payment);
            }
        }
    }
}