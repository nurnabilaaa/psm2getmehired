<?php

namespace App\Libs;

use Illuminate\Support\Facades\Http;

class ToyyibPay
{
    private $secretKey;
    private $categoryCode;

    private $billName;
    private $billDescription;
    private $amount;
    private $returnUrl;
    private $billTo;
    private $billEmail;
    private $billPhone;

    /**
     * @return mixed
     */
    public function getBillName()
    {
        return $this->billName;
    }

    /**
     * @param mixed $billName
     */
    public function setBillName($billName): void
    {
        $this->billName = $billName;
    }

    /**
     * @return mixed
     */
    public function getBillDescription()
    {
        return $this->billDescription;
    }

    /**
     * @param mixed $billDescription
     */
    public function setBillDescription($billDescription): void
    {
        $this->billDescription = $billDescription;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @param mixed $returnUrl
     */
    public function setReturnUrl($returnUrl): void
    {
        $this->returnUrl = $returnUrl;
    }

    /**
     * @return mixed
     */
    public function getBillTo()
    {
        return $this->billTo;
    }

    /**
     * @param mixed $billTo
     */
    public function setBillTo($billTo): void
    {
        $this->billTo = $billTo;
    }

    /**
     * @return mixed
     */
    public function getBillEmail()
    {
        return $this->billEmail;
    }

    /**
     * @param mixed $billEmail
     */
    public function setBillEmail($billEmail): void
    {
        $this->billEmail = $billEmail;
    }

    /**
     * @return mixed
     */
    public function getBillPhone()
    {
        return $this->billPhone;
    }

    /**
     * @param mixed $billPhone
     */
    public function setBillPhone($billPhone): void
    {
        $this->billPhone = $billPhone;
    }


    public function __construct()
    {
        $this->secretKey    = env('TOYYIBPAY_SECRET_KEY');
        $this->categoryCode = env('TOYYIBPAY_CATEGORY_CODE');
    }

    public function createBill()
    {
        $bill = array(
            'userSecretKey'           => $this->secretKey,
            'categoryCode'            => $this->categoryCode,
            'billName'                => $this->getBillName(), // Your bill name. Bill Name will be displayed as bill title. Max 30 alphanumeric characters, space and '_' only
            'billDescription'         => $this->getBillDescription(), //Your bill description. Max 100 alphanumeric characters, space and '_' only
            'billPriceSetting'        => 1, //For fixed amount bill, set it to 1 and insert bill amount. For dynamic bill (user can insert the amount to pay), set it to 0.
            'billPayorInfo'           => 0, //If you want to create open bill without require payer information, set it to 0. If you need payer information, set it to 1
            'billAmount'              => $this->getAmount() * 100,
            'billReturnUrl'           => $this->getReturnUrl(),
            'billExternalReferenceNo' => '',
            'billTo'                  => $this->getBillTo(), // If you intend to provide the bill to specific person, you may fill the person nam in this field. If not, please leave it blank.
            'billEmail'               => $this->getBillEmail(), //Provide your customer email here
            'billPhone'               => $this->getBillPhone(), //Provide your customer phone number here.
            'billSplitPayment'        => 0, //[OPTIONAL] Set 1 if the you need the payment to be splitted to other toyyibPay users.
            'billSplitPaymentArgs'    => '', // [OPTIONAL] Provide JSON for split payment. e.g. [{"id":"johndoe","amount":"200"}]
            'billPaymentChannel'      => '0', //Set 0 for FPX, 1 Credit Card and 2 for both FPX & Credit Card.
            'billContentEmail'        => 'Thank you for purchasing our product!',
            //Leave blank to set charges for both FPX and Credit Card on bill owner.
            //Set "0" to charge FPX to customer, Credit Card to bill owner.
            //Set "1" to charge FPX bill owner, Credit Card to customer.
            //Set "2" to charge both FPX and Credit Card to customer.
            'billChargeToCustomer'    => ''
        );

        if (env('TOYYIBPAY_DEV') == 'yes') {
            $res = Http::asForm()->post('https://dev.toyyibpay.com/index.php/api/createBill', $bill);
        } else {
            $res = Http::asForm()->post('https://toyyibpay.com/index.php/api/createBill', $bill);
        }

        $decode = json_decode($res->body());
        return $decode[0]->BillCode;
    }
}
