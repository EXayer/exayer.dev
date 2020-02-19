<?php

namespace App\Controller\Admin;

use App\Repository\PostRepository;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("admin/post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="post_index")
     */
    public function index(PostRepository $postRepository, Request $request, PaginatorInterface $paginator)
    {
        $postsBuilder = $postRepository->getAllQuery();

        $postPaginated = $paginator->paginate(
            $postsBuilder,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/post/index.html.twig', [
            'postPaginated' => $postPaginated
        ]);
    }

    /**
     * @Route("/new", name="post_new")
     */
    public function new()
    {
        return $this->render('admin/post/index.html.twig', [
        ]);
    }
}
