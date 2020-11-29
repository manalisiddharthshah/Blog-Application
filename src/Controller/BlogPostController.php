<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Blog;
use App\Entity\Comment;
use App\Repository\BlogRepository;

class BlogPostController extends AbstractController
{
    /**
     * @Route("/Home", name="home_page")
     */
    public function index(BlogRepository $blogRepository)
    {
        $blog_post = $blogRepository->findAllBlogPosts();
        $comment_post = $blogRepository->findAllBlogs();
        return $this->render('blog_post/index.html.twig',['blog_post'=>$blog_post,'comment_post'=>$comment_post]);
    }
    /**
    * @Route("/", name="dashboard")
    */
    public function Dashboard(BlogRepository $blogRepository)
    {
        $id=$this->getUser()->getId();
        $blog_post = $blogRepository->findAllBlogPosts();        
        $comment_post = $blogRepository->findAllBlogs();
        
        return $this->render('blog_post/index.html.twig',['blog_post'=>$blog_post,'comment_post'=>$comment_post,'id'=>$id]);
    }
    /**
    * @Route("/category", name="blog_category")
    */
    public function categoryFilter(Request $request,BlogRepository $blogRepository)
    {
        $category = $request->request->get('category');
        if(empty($category))
        {
            return $this->render('blog_post/blogCategory.html.twig');
        }
        else{
            $blogs = $blogRepository->findBlogByCategory($category);  
            if(empty($blogs))
            {
                $error = "No Blogs Found Under This Category";
                return $this->render('blog_post/blogCategory.html.twig',['error'=>$error]);
            }      
            $comment_post = $blogRepository->findAllBlogs();
            return $this->render('blog_post/blogCategory.html.twig',['blog'=>$blogs,'comment_post'=>$comment_post]);

        }
    }
    /**
    * @Route("/posted", name="blog_date")
    */
    public function dateFilter(Request $request,BlogRepository $blogRepository)
    {
        $postedDate = $request->request->get('postedDate');
        if(empty($postedDate))
        {
            return $this->render('blog_post/blogPostedDate.html.twig');
        }
        else{
            $blogs = $blogRepository->findBlogByPostedDate($postedDate);  
            if(empty($blogs))
            {
                $error = "No Blogs Found Under This Posted Date";
                return $this->render('blog_post/blogPostedDate.html.twig',['error'=>$error]);
            }      
            $comment_post = $blogRepository->findAllBlogs();
            
            return $this->render('blog_post/blogPostedDate.html.twig',['blog'=>$blogs,'comment_post'=>$comment_post]);

        }
    }
    /**
    * @Route("/create-blogs", name="create_blog")
    */
    public function createBlog(Request $request)
    {
        $user_id=$this->getUser()->getId();

        $title = $request->request->get('title');
        $category = $request->request->get('category');
        $content = $request->request->get('content');
        if($request->request->get('status') == "on")
        {
            $status = 1;
            $posted_date = date('Y-m-d');
            $success = "Post Published Successdully";
        }
        else
        {
            $status = $request->request->get('status');
            $posted_date = $request->request->get('status');
            $success = "Post Created Successfully";
        }
        $created_date = date('Y-m-d');
        if(empty($title) || empty($category) || empty($content))
        {
            return $this->render('blog_post/addBlog.html.twig',['id'=>$user_id]);
        }
        else{
            $entityManager = $this->getDoctrine()->getManager();
            $blog = new Blog;
            $blog->setTitle($title);
            $blog->setCategory($category);
            $blog->setContent($content);
            $blog->setStatus($status);
            $blog->setUserId($user_id);
            $blog->setCreatedDate($created_date);
            $blog->setPostedDate($posted_date);
            $entityManager->persist($blog);
            $entityManager->flush();
            return $this->render('blog_post/addBlog.html.twig',['id'=>$user_id,'success'=>$success]);
        }
    }
    /**
    * @Route("/create-comment", name="create_comment")
    */
    public function createComment(Request $request,BlogRepository $blogRepository)
    {
        $user_id=$this->getUser()->getId();
        $blogId = $request->request->get('blogId');
        $commentTitle = $request->request->get('commentTitle');
        $commentDiscription = $request->request->get('commentDiscription');
        $createdDate = date('Y-m-d');
        if(empty($commentTitle) || empty($commentDiscription))
        {
            return $this->redirectToRoute("dashboard");        
        }
        else{
            $entityManager = $this->getDoctrine()->getManager();
            $comment = new Comment;
            $comment->setBlogId($blogId);
            $comment->setUserId($user_id);
            $comment->setCommentTitle($commentTitle);
            $comment->setCommentDiscription($commentDiscription);
            $comment->setCreatedDate($createdDate);
            $entityManager->persist($comment);
            $entityManager->flush();
            $id=$this->getUser()->getId();
        $blog_post = $blogRepository->findAllBlogPosts();        
        $comment_post = $blogRepository->findAllBlogs();
        $success = "Comment Created";
        
        return $this->render('blog_post/index.html.twig',['blog_post'=>$blog_post,'comment_post'=>$comment_post,'id'=>$id,'success'=>$success]);
        }
    }
    /**
    * @Route("/my-blogs", name="my_blog")
    */
    public function myBlogs(BlogRepository $blogRepository)
    {
        $user_id=$this->getUser()->getId();
        $blog_post = $blogRepository->findBlogByUsers($user_id);
        return $this->render('blog_post/myBlogs.html.twig',['blog_post'=>$blog_post,'id'=>$user_id]);
    }
    /**
    * @Route("/blog_post", name="blog_post")
    */
    public function publishBlog(Request $request)
    {
        $id = $request->request->get('id');
        $status = 1;
        $posted_date = date('Y-m-d');
        
        $entityManager = $this->getDoctrine()->getManager();
        $blog = $entityManager->getRepository(Blog::class)->find($id);

        $blog->setStatus($status);
        $blog->setPostedDate($posted_date);
        $entityManager->flush();

        return $this->redirectToRoute("my_blog");
    }
    /**
    * @Route("/show-comment/{blogId}", name="show_comment")
    */
    public function showComment($blogId,BlogRepository $blogRepository)
    {
        $user_id=$this->getUser()->getId();
        
        $blog_post = $blogRepository->findBlogByUsers($user_id);
        $comment_post = $this->getDoctrine()
        ->getRepository(Comment::class)
        ->findBy(['blogId'=>$blogId],['id'=>'DESC']);
        if(empty($comment_post))
        {
            $comment_post = "Null";
        }
        return $this->render('blog_post/myBlogs.html.twig',['comment_post'=>$comment_post,'blog_post'=>$blog_post,'id'=>$user_id,'blogId'=>$blogId]);
    }
   
    /**
     * @Route("/commented-post", name="commented_post")
     */
    public function commentedPost(BlogRepository $blogRepository)
    {
        $id=$this->getUser()->getId();

        $blog_post = $blogRepository->findByComment($id);
        $comment_post = $blogRepository->findAllBlogs();

        return $this->render('blog_post/commentedPosts.html.twig',['blog_post'=>$blog_post,'comment_post'=>$comment_post,'id'=>$id]);
    }
}
