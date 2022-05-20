<?php

namespace App\Doctrine\Listener;

use App\Entity\Category;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategorySlugListener
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Category $entity)
    {
        if (empty($entity->getSlug())) {

            $entity->setSlug(strtolower($this->slugger->slug($entity->getName())));
        }
    }
}
