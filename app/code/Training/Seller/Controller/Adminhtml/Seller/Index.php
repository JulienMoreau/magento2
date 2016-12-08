<?php

namespace Training\Seller\Controller\Adminhtml\Seller;


use Magento\Framework\App\Response\Http;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\Seller\Api\SellerRepositoryInterface;

/**
 * Class Index
 * @package Training\Seller\Controller\Adminhtml\Seller
 * @method Http getResponse()
 */
class Index extends \Magento\Backend\App\Action
{

    protected $sellerRepository;

    public function __construct(\Magento\Backend\App\Action\Context $context, SellerRepositoryInterface $sellerRepository)
    {
        parent::__construct($context);
        $this->sellerRepository = $sellerRepository;
    }


    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        try {
            $seller = $this->sellerRepository->getById(1);
        } catch (NoSuchEntityException $e) {
            throw new NotFoundException(__('Page not found.'));
        }

        $this->getResponse()->appendBody($seller->getName());
    }

    /**
     * @return bool
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Training_Seller::manage');
    }
}