<?php
/**
 * Represents detailed information for Card payment types.
 *
 * Copyright (C) 2019 heidelpay GmbH
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @link  https://docs.heidelpay.com/
 *
 * @author  Simon Gabriel <development@heidelpay.com>
 *
 * @package  heidelpayPHP/resources/embedded_resources
 */
namespace heidelpayPHP\Resources\EmbeddedResources;

use heidelpayPHP\Resources\AbstractHeidelpayResource;

class CardDetails extends AbstractHeidelpayResource
{
    /** @var string|null $cardType */
    protected $cardType;

    /** @var string|null $account */
    protected $account;

    /** @var string|null $account */
    protected $countryIsoA2;

    /** @var string|null $countryName */
    protected $countryName;

    /** @var string|null $issuerName */
    protected $issuerName;

    /** @var string|null $issuerUrl */
    protected $issuerUrl;

    /** @var string|null $issuerPhoneNumber */
    protected $issuerPhoneNumber;

    //<editor-fold desc="Getters/Setters">

    /**
     * @return string|null
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * @param string|null $cardType
     *
     * @return CardDetails
     */
    protected function setCardType($cardType): CardDetails
    {
        $this->cardType = $cardType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param string|null $account
     *
     * @return CardDetails
     */
    protected function setAccount($account): CardDetails
    {
        $this->account = $account;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryIsoA2()
    {
        return $this->countryIsoA2;
    }

    /**
     * @param string|null $countryIsoA2
     *
     * @return CardDetails
     */
    protected function setCountryIsoA2($countryIsoA2): CardDetails
    {
        $this->countryIsoA2 = $countryIsoA2;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * @param string|null $countryName
     *
     * @return CardDetails
     */
    protected function setCountryName($countryName): CardDetails
    {
        $this->countryName = $countryName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIssuerName()
    {
        return $this->issuerName;
    }

    /**
     * @param string|null $issuerName
     *
     * @return CardDetails
     */
    protected function setIssuerName($issuerName): CardDetails
    {
        $this->issuerName = $issuerName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIssuerUrl()
    {
        return $this->issuerUrl;
    }

    /**
     * @param string|null $issuerUrl
     *
     * @return CardDetails
     */
    protected function setIssuerUrl($issuerUrl): CardDetails
    {
        $this->issuerUrl = $issuerUrl;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getIssuerPhoneNumber()
    {
        return $this->issuerPhoneNumber;
    }

    /**
     * @param string|null $issuerPhoneNumber
     *
     * @return CardDetails
     */
    protected function setIssuerPhoneNumber($issuerPhoneNumber): CardDetails
    {
        $this->issuerPhoneNumber = $issuerPhoneNumber;
        return $this;
    }

    //</editor-fold>
}
