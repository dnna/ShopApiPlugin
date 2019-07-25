<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\Request\AddressBook;

use Sylius\Component\Core\Model\ShopUserInterface;
use Sylius\ShopApiPlugin\Command\AddressBook\SetDefaultAddress;
use Sylius\ShopApiPlugin\Command\CommandInterface;
use Sylius\ShopApiPlugin\Request\ShopUserBasedRequestInterface;
use Symfony\Component\HttpFoundation\Request;

class SetDefaultAddressRequest implements ShopUserBasedRequestInterface
{
    /** @var mixed */
    protected $id;

    /** @var string */
    protected $userEmail;

    private function __construct(Request $request, string $userEmail)
    {
        $this->id = $request->attributes->get('id');
        $this->userEmail = $userEmail;
    }

    public static function fromHttpRequestAndShopUser(Request $request, ShopUserInterface $user): ShopUserBasedRequestInterface
    {
        return new self($request, $user->getEmail());
    }

    public function getCommand(): CommandInterface
    {
        return new SetDefaultAddress($this->id, $this->userEmail);
    }
}
