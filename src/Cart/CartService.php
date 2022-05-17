<?php

namespace App\Cart;

use App\Cart\CartItem;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    protected $session;
    protected $productRepository;

    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }

    protected function getCart(): array
    {
        return $this->session->get('cart', []);
    }

    protected function saveCart(array $cart)
    {
        $this->session->set('cart', $cart);
    }

    public function empty()
    {
        $this->saveCart([]);
    }

    public function add(int $id)
    {

        // Si il n'existe pas encore, alors prendre un tableau vide
        $cart = $this->getCart();

        // Voir si le produit est déjà dans le tableau
        if (!array_key_exists($id, $cart)) {
            $cart[$id] = 0;
        }

        // Si c'est le cas augmenter la quantité
        $cart[$id]++;

        // Mettre à jour la session
        $this->saveCart($cart);
    }

    public function remove(int $id)
    {
        $cart = $this->getCart();

        unset($cart[$id]);

        $this->saveCart($cart);
    }

    public function decrement(int $id)
    {
        $cart = $this->getCart();

        if (!array_key_exists($id, $cart)) {
            return;
        }

        // Soit le produit est à 1 alors il faut simplement le supprimer
        if ($cart[$id] === 1) {
            $this->remove($id);
            return;
        }

        // Soit le produit est à plus de 1, alors il faut le décrémenter
        $cart[$id]--;

        $this->saveCart($cart);
    }

    public function getTotal(): int
    {
        $total = 0;

        foreach ($this->getCart() as $id => $qty) {

            $product = $this->productRepository->find($id);

            if (!$product) {
                continue;
            }

            $total += $product->getPrice() * $qty;
        }

        return $total;
    }

    /**
     * @return array CartItem[]
     */
    public function getDetailedCartItems(): array
    {
        $detailedCart = [];

        foreach ($this->getCart() as $id => $qty) {

            $product = $this->productRepository->find($id);

            if (!$product) {
                continue;
            }

            $detailedCart[] = new CartItem($product, $qty);
        }

        return $detailedCart;
    }
}
