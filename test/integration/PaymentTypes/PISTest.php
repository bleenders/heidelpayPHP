<?php
/**
 * This class defines integration tests to verify interface and
 * functionality of the payment method PIS.
 *
 * Copyright (C) 2018 heidelpay GmbH
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
 * @package  heidelpayPHP\tests/integration/payment_types
 */
namespace heidelpayPHP\test\integration\PaymentTypes;

use heidelpayPHP\Constants\ApiResponseCodes;
use heidelpayPHP\Exceptions\HeidelpayApiException;
use heidelpayPHP\Resources\PaymentTypes\PIS;
use heidelpayPHP\test\BasePaymentTest;
use RuntimeException;

class PISTest extends BasePaymentTest
{
    /**
     * Verify pis can be created.
     *
     * @test
     *
     * @throws HeidelpayApiException A HeidelpayApiException is thrown if there is an error returned on API-request.
     * @throws RuntimeException      A RuntimeException is thrown when there is an error while using the SDK.
     */
    public function pisShouldBeCreatableAndFetchable()
    {
        /** @var PIS $pis */
        $pis = $this->heidelpay->createPaymentType(new PIS());
        $this->assertInstanceOf(PIS::class, $pis);
        $this->assertNotNull($pis->getId());

        /** @var PIS $fetchedPIS */
        $fetchedPIS = $this->heidelpay->fetchPaymentType($pis->getId());
        $this->assertInstanceOf(PIS::class, $fetchedPIS);
        $this->assertEquals($pis->expose(), $fetchedPIS->expose());
    }

    /**
     * Verify pis is chargeable.
     *
     * @test
     *
     * @throws HeidelpayApiException A HeidelpayApiException is thrown if there is an error returned on API-request.
     * @throws RuntimeException      A RuntimeException is thrown when there is an error while using the SDK.
     */
    public function pisShouldBeAbleToCharge()
    {
        /** @var PIS $pis */
        $pis = $this->heidelpay->createPaymentType(new PIS());
        $charge = $pis->charge(100.0, 'EUR', self::RETURN_URL);
        $this->assertNotNull($charge);
        $this->assertNotEmpty($charge->getId());
        $this->assertNotEmpty($charge->getRedirectUrl());
    }

    /**
     * Verify pis is not authorizable.
     *
     * @test
     *
     * @throws HeidelpayApiException A HeidelpayApiException is thrown if there is an error returned on API-request.
     * @throws RuntimeException      A RuntimeException is thrown when there is an error while using the SDK.
     *
     * @group robustness
     */
    public function pisShouldNotBeAuthorizable()
    {
        $pis = $this->heidelpay->createPaymentType(new PIS());
        $this->assertInstanceOf(PIS::class, $pis);
        $this->assertNotNull($pis->getId());

        $this->expectException(HeidelpayApiException::class);
        $this->expectExceptionCode(ApiResponseCodes::API_ERROR_TRANSACTION_AUTHORIZE_NOT_ALLOWED);

        $this->heidelpay->authorize(100.0, 'EUR', $pis, self::RETURN_URL);
    }
}
