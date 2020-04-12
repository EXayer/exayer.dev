<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/", name="post_index", methods={"GET"})
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
     * @Route("/create", name="post_create", methods={"GET"})
     */
    public function create(TagRepository $tagRepository)
    {
        $tags = $tagRepository->findAll();

        return $this->render('admin/post/create.html.twig', [
            'tags' => $tags
        ]);
    }

    /**
     * @Route("/store", name="post_store", methods={"POST"})
     */
    public function store(Request $request, EntityManagerInterface $entityManager)
    {
        $post_data = $request->get('post');
        $action = $request->get('action');

        $post = new Post();
        $post->setTitle($post_data['title']);
        $post->setDescription($post_data['description']);
        $post->setBody($post_data['body']);
        $post->setUser($this->getUser());

        if ($action === 'publish') {
            $post->setPublishedAt(new \DateTime());
        }

        $entityManager->persist($post);
        $entityManager->flush();

        $this->addFlash(
            'notice',
            'Post added!'
        );

        return $this->redirectToRoute('post_index');
    }
}
