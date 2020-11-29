<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    // /**
    //  * @return Blog[] Returns an array of Blog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Blog
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return Blog[]
     */
    public function findBlogByUsers($user_id): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p.id,q.username,p.title,p.content,p.postedDate,p.category,p.userId
            FROM App\Entity\Blog p JOIN App\Entity\User q
            WHERE q.id=p.userId AND p.userId=:userId'
            )->setParameter('userId',$user_id);
        // returns an array of Product objects
        return $query->getResult();
    }
    /**
     * @return Blog[]
     */
    public function findBlogByPostedDate($postedDate): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p.id,q.username,p.title,p.content,p.postedDate,p.category,p.userId
            FROM App\Entity\Blog p JOIN App\Entity\User q
            WHERE p.status=1 AND q.id=p.userId AND p.postedDate=:postedDate'
            )->setParameter('postedDate',$postedDate);
        // returns an array of Product objects
        return $query->getResult();
    }
    /**
     * @return Blog[]
     */
    public function findBlogByCategory($category): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p.id,q.username,p.title,p.content,p.postedDate,p.category,p.userId
            FROM App\Entity\Blog p JOIN App\Entity\User q
            WHERE p.status=1 AND q.id=p.userId AND p.category=:category'
            )->setParameter('category',$category);
        // returns an array of Product objects
        return $query->getResult();
    }
    /**
     * @return Blog[]
     */
    public function findAllBlogPosts(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p.id,q.username,p.title,p.content,p.postedDate,p.category,p.userId
            FROM App\Entity\Blog p JOIN App\Entity\User q
            WHERE p.status=1 AND q.id=p.userId'
            );
        // returns an array of Product objects
        return $query->getResult();
    }
    /**
     * @return Blog[]
     */
    public function findAllBlogs(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c.id,c.blogId,q.username,c.commentTitle,c.commentDiscription,c.createdDate
            FROM App\Entity\Blog p JOIN App\Entity\Comment c JOIN App\Entity\User q
            WHERE p.id=c.blogId AND q.id=c.userId'
            );
        // returns an array of Product objects
        return $query->getResult();
    }
    
    /**
     * @return Comment[]
     */
    public function findByComment($id): array
    {
        $entityManager = $this->getEntityManager();
//select (select username from user where user.id=blog.user_id) As username from blog join comment join user where blog.id=comment.blog_id and user.id=comment.user_id and comment.user_id=2

        $query = $entityManager->createQuery(
            'SELECT p.id,(select user.username from App\Entity\User user where user.id=p.userId) As username,p.title,p.category,p.content,p.postedDate FROM App\Entity\Blog p JOIN App\Entity\Comment c JOIN App\Entity\User q where p.id=c.blogId And q.id=c.userId And c.userId=:userId'
            )->setParameter('userId',$id);
        // returns an array of Product objects
        return $query->getResult();
    }

}
