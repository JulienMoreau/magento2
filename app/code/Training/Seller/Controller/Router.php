<?php

namespace Training\Seller\Controller;


use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{

    protected $actionFactory;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    /**
     * Match application action by request
     *
     * @param RequestInterface $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        /** @var \Magento\Framework\App\Request\Http $request */
        $path = trim($request->getPathInfo(), '/');
        if ($path === 'sellers.html') {
            $request->setPathInfo('/seller/seller/index');

            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        } elseif (preg_match('#^seller/([a-zA-Z0-9\-_]*)\.html$#', $path, $matches) > 0) {
            $request->setPathInfo('/seller/seller/view/identifier/' . $matches[1]);

            return $this->actionFactory->create('Magento\Framework\App\Action\Forward');
        }
        return null;
    }
}