<?php

namespace Training\Helloworld\Plugin;

class Customer
{

    public function beforeSetFirstname(\Magento\Customer\Model\Data\Customer $customer, $firstname)
    {
        return [mb_convert_case($firstname, MB_CASE_TITLE)];
    }


}