<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/12/16
 * Time: 12:10
 */

namespace Training\Seller\Controller\Seller;


use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Response\Http;
use Magento\Framework\App\ResponseInterface;
use Training\Seller\Api\SellerRepositoryInterface;

/**
 * Class Index
 * @package Training\Seller\Controller\Seller
 * @method Http getResponse()
 */
class Index extends Action
{

    /**
     * @var SellerRepositoryInterface
     */
    protected $sellerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    public function __construct(
        Context $context,
        SellerRepositoryInterface $sellerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        parent::__construct($context);
        $this->sellerRepository = $sellerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $sellers = $this->sellerRepository->getList($this->searchCriteriaBuilder->create())->getItems();
        $this->getResponse()->appendBody('<ul>');
        foreach ($sellers as $seller) {
            $this->getResponse()->appendBody('<li>' . $seller->getName() . '</li>');
        }
        $this->getResponse()->appendBody('</ul>');
    }
}