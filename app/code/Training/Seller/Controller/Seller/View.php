<?php


namespace Training\Seller\Controller\Seller;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Message\PhraseFactory;
use Training\Seller\Api\SellerRepositoryInterface;

/**
 * Class View
 * @package Training\Seller\Controller\Seller
 * @method Http getResponse()
 */
class View extends Action
{

    /**
     * @var SellerRepositoryInterface
     */
    protected $sellerRepository;

    /**
     * @var PhraseFactory
     */
    protected $phraseFactory;

    /**
     * View constructor.
     * @param Context $context
     * @param SellerRepositoryInterface $sellerRepository
     */
    public function __construct(
        Context $context,
        SellerRepositoryInterface $sellerRepository
    ) {
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
            $seller = $this->sellerRepository->getByIdentifier($this->getRequest()->getParam('identifier'));
        } catch (NoSuchEntityException $e) {
            throw new NotFoundException(__('Page not found.'));
        }

        $this->getResponse()->appendBody($seller->getName());
    }
}