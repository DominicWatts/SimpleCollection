<?php

/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace PixieMedia\SimpleCollection\Rewrite\Magento\Sales\Model\Order\Email\Sender;

use Magento\Sales\Model\Order;

class OrderSender extends \Magento\Sales\Model\Order\Email\Sender\OrderSender
{

    const XML_PATH_EMAIL_COLLECTION_TEMPLATE = 'sales_email/order/collection_template';

    /**
     * Prepare email template with variables
     * @param Order $order
     * @return void
     */
    protected function prepareTemplate(Order $order)
    {
        parent::prepareTemplate($order);

        $shippingMethod = $order->getShippingMethod();
        // $shippingDescription = $order->getShippingDescription();

        if ($shippingMethod == 'collection_collection') {
            $this->templateContainer->setTemplateId($this->getSimpleCollectionId());
        }

        /*
        $logger = $this->getLogger();
        $logger->info(__METHOD__);
        $logger->info($shippingMethod);
        // $logger->info($shippingDescription);
        $logger->info($this->getSimpleCollectionId());
        */
    }

    /**
     * Return collection template id
     * @return mixed
     */
    public function getSimpleCollectionId()
    {
        return $this->globalConfig->getValue(self::XML_PATH_EMAIL_COLLECTION_TEMPLATE);
    }

    /**
     * @return \Zend_Log
     */
    /*
    public function getLogger()
    {
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/pixie.collection.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        return $logger;
    }
    */
}
